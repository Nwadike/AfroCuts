<?php

namespace App\Http\Controllers;

use App\Models\Barbershop;
// Removed: use App\Models\Service; // No longer needed
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str; // Added for Str::limit in views

class BarbershopController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'search']);
         // Apply middleware to the new createInitial and editBusiness methods
        $this->middleware('auth')->only(['createInitial', 'editBusiness']);
    }

    

    /**
     * Display a listing of the barbershops.
     * Handles initial load and AJAX requests for infinite scroll (if implemented).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Start building the query
        $query = Barbershop::where('is_approved', true); // Only approved barbershops
        // Removed: ->with('services'); // No longer eager loading relationship

        // Add search filters if present (from search form)
        if ($request->filled('query')) {
            $searchQuery = $request->input('query');
            $query->where(function ($q) use ($searchQuery) {
                $q->where('name', 'like', "%{$searchQuery}%")
                  ->orWhere('description', 'like', "%{$searchQuery}%")
                   // Searching within the JSON services column (requires database support for JSON queries)
                  ->orWhereJsonContains('services', ['name' => $searchQuery]); // Basic JSON search example
            });
        }

        if ($request->filled('location')) {
            $locationQuery = $request->input('location');
             $query->where(function ($q) use ($locationQuery) {
                $q->where('city', 'like', "%{$locationQuery}%")
                  ->orWhere('state', 'like', "%{$locationQuery}%")
                  ->orWhere('zip_code', 'like', "%{$locationQuery}%")
                  ->orWhere('address', 'like', "%{$locationQuery}%"); // Added address search
             });
        }


        // Paginate the results
        $barbershops = $query->paginate(10); // Adjust items per page as needed

        // If it's an AJAX request, return JSON data (for infinite scroll if you re-implement it)
        if ($request->ajax()) {
            return response()->json([
                'data' => $barbershops->items(), // Get the items for the current page
                'next_page_url' => $barbershops->nextPageUrl(), // Get the URL for the next page
                'has_more_pages' => $barbershops->hasMorePages(), // Check if there are more pages
            ]);
        }

        // Otherwise, return the view for the initial page load
        return view('barbershops.index', compact('barbershops'));
    }

    /**
     * Show the form for creating a new barbershop (full form).
     * This might be used for editing or by an admin.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Ensure only authenticated users can access this
        // $this->authorize('create', Barbershop::class); // Uncomment if using Laravel policies
        return view('barbershops.create'); // This would be your full create/edit form
    }

     /**
      * Show the initial form for creating a barbershop after business registration.
      *
      * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
      */
     public function createInitial()
     {
         // Ensure the user is a business user and doesn't already have a barbershop
         if (!Auth::user()->isBusiness()) {
             return redirect()->route('home')->with('error', 'Only business accounts can create a barbershop.');
         }

         // Check if the user already has a barbershop
         if (Auth::user()->barbershop) {
             return redirect()->route('dashboard')->with('info', 'You have already created a barbershop.'); // Redirect to dashboard or barbershop management page
         }

         return view('barbershops.create-initial');
     }

     /**
      * Show the form for a business user to edit their barbershop details.
      *
      * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
      */
     public function editBusiness()
     {
         $user = Auth::user();

         // Ensure the user is a business user
         if (!$user->isBusiness()) {
             return redirect()->route('home')->with('error', 'Access denied.');
         }

         // Fetch the barbershop owned by the user
         $barbershop = $user->barbershop;

         // Ensure the user has a barbershop
         if (!$barbershop) {
             return redirect()->route('barbershops.create.initial')->with('info', 'Please create your barbershop first.');
         }

         // Pass the barbershop data to the edit view
         return view('barbershops.edit-business', compact('barbershop'));
     }


    /**
     * Store a newly created barbershop in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Ensure only authenticated users can access this
        // $this->authorize('create', Barbershop::class); // Uncomment if using Laravel policies

        // Validation for the initial creation form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'phone' => 'nullable|string|max:20', // Phone is optional initially
            // Email is not in the initial form, but we will use the authenticated user's email
        ]);

        // Handle logo upload (optional for initial form)
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        } else {
             $validated['logo'] = null; // Ensure logo is null if not uploaded
        }

        $user = Auth::user(); // Get the authenticated user
        $validated['user_id'] = $user->id; // Assign the user's ID
        $validated['is_approved'] = false; // Set approval status to false by default

        // Use the authenticated user's email for the barbershop email
        $validated['email'] = $user->email; // <--- FIX: Use the authenticated user's email

        // Set default/empty values for fields not in the initial form
        $validated['description'] = '';
        $validated['website'] = null;
        $validated['instagram'] = null;
        $validated['facebook'] = null;
        $validated['working_hours'] = null;
        $validated['rating'] = null;
        $validated['google_maps_url'] = null;
        $validated['gallery'] = null;
        $validated['services'] = null; // Services JSON will be added later

        // Create the barbershop
        $barbershop = Barbershop::create($validated);

        // Services are stored directly, no need to create related Service models

        // Redirect the user after initial creation
        // You might redirect them to a page to fill in more details or their dashboard
        return redirect()->route('dashboard')->with('success', 'Barbershop created successfully! You can add more details from your dashboard.');
    }

    /**
     * Display the specified barbershop.
     *
     * @param  \App\Models\Barbershop  $barbershop // Laravel automatically injects the Barbershop model based on the route ID
     * @return \Illuminate\View\View
     */
    public function show(Barbershop $barbershop)
    {
        // You might want to add a check here if you only want to show approved barbershops to the public
        // if (!$barbershop->is_approved && (!Auth::check() || Auth::id() !== $barbershop->user_id)) {
        //     abort(404); // Or redirect with an error
        // }

        // Return the show view, passing the fetched barbershop model
        return view('barbershops.show', compact('barbershop'));
    }

    /**
     * Show the form for editing the specified barbershop (full form).
     * This might be used by an admin or for a full business profile edit.
     *
     * @param  \App\Models\Barbershop  $barbershop
     * @return \Illuminate\View\View
     */
    public function edit(Barbershop $barbershop)
    {
         // This method might be for a full edit or admin view.
         // Ensure user is authorized to update if used by non-admin.
         // $this->authorize('update', $barbershop); // Uncomment if using Laravel policies
        // Removed: $barbershop->load('services'); // No longer eager loading relationship
        return view('barbershops.edit', compact('barbershop')); // This would be your full create/edit form
    }

    /**
     * Update the specified barbershop in storage.
     * This method handles updates from both the initial form and the business edit form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barbershop  $barbershop
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Barbershop $barbershop)
    {
         // Ensure the user is authorized to update this barbershop (e.g., they own it)
         $this->authorize('update', $barbershop); // Ensure user is authorized to update

         // Validation rules - adjust based on which fields are editable
         $validated = $request->validate([
             // Name is not editable via the business edit form, but keep validation for other forms if they exist
             // 'name' => 'required|string|max:255', // Name is read-only for business users

             'description' => 'nullable|string',
             'address' => 'required|string|max:255',
             'city' => 'required|string|max:255',
             'state' => 'required|string|max:255',
             'zip_code' => 'required|string|max:20',
             'phone' => 'nullable|string|max:20',
             'email' => 'nullable|email|max:255', // Allow email to be updated (nullable)
             'website' => 'nullable|url|max:255',
             'instagram' => 'nullable|string|max:255',
             'facebook' => 'nullable|string|max:255',
             'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'working_hours' => 'nullable|array', // Assuming these are updated elsewhere or later
             'working_hours.*' => 'nullable|string',

             'services' => 'nullable|array', // Assuming these are updated elsewhere or later
             'services.*.name' => 'required|string|max:255',
             'services.*.price' => 'required|numeric|min:0',
             'services.*.staff_name' => 'nullable|string|max:255',

             // Removed: deleted_services validation as services are in JSON
         ]);

         // Handle logo upload
         if ($request->hasFile('logo')) {
             // Delete old logo if it exists
             if ($barbershop->logo) {
                 Storage::disk('public')->delete($barbershop->logo);
             }
             $validated['logo'] = $request->file('logo')->store('logos', 'public');
         }

         // Services and Working Hours are assumed to be updated via a more complex form/process,
         // so we won't update them directly from this basic edit form unless they are included.
         // If your edit-business form includes these, ensure they are validated above.

         // Update barbershop details
         $barbershop->update($validated);

         // No need to sync related Service models

         // Redirect back to the business edit page with a success message
         return redirect()->route('barbershops.edit.business')->with('success', 'Barbershop details updated successfully.');
    }


    /**
     * Remove the specified barbershop from storage.
     *
     * @param  \App\Models\Barbershop  $barbershop
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Barbershop $barbershop)
    {
        $this->authorize('delete', $barbershop); // Ensure user is authorized to delete

        // Delete logo if it exists
        if ($barbershop->logo) {
            Storage::disk('public')->delete($barbershop->logo);
        }

        $barbershop->delete();

        return redirect()->route('barbershops.index')->with('success', 'Barbershop deleted successfully.');
    }


    /**
     * Search for barbershops.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $location = $request->input('location');

        $barbershopsQuery = Barbershop::where('is_approved', true); // Only approved barbershops
                            // Removed: ->with('services'); // No longer eager loading relationship

        // Search by name, description, OR service name within JSON
        if ($query) {
            $barbershopsQuery->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  // Searching within the JSON services column (requires database support for JSON queries)
                  ->orWhereJsonContains('services', ['name' => $query]); // Basic JSON search example
            });
        }

        // Search by location fields
        if ($location) {
            $barbershopsQuery->where(function ($q) use ($location) {
                $q->where('city', 'like', "%{$location}%")
                  ->orWhere('state', 'like', "%{$location}%")
                  ->orWhere('zip_code', 'like', "%{$location}%")
                  ->orWhere('address', 'like', "%{$location}%"); // Added address search
            });
        }


        // Paginate the results
        $barbershops = $barbershopsQuery->paginate(10); // Adjust items per page as needed

         // If it's an AJAX request, return JSON data (for infinite scroll if you re-implement it)
        if ($request->ajax()) {
            return response()->json([
                'data' => $barbershops->items(), // Get the items for the current page
                'next_page_url' => $barbershops->nextPageUrl(), // Get the URL for the next page
                'has_more_pages' => $barbershops->hasMorePages(), // Check if there are more pages
            ]);
        }


        return view('barbershops.index', compact('barbershops', 'query', 'location'));
    }

    // You would add edit, update, and destroy methods here if needed
}

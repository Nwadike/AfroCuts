AfroCuts

AfroCuts is a web application designed to serve as a comprehensive directory for black barbershops. It aims to connect users with barbershops specializing in diverse hair types and styles within the black community, making it easier to discover, locate, and potentially book services.

Features

* Search and browse barbershops.
* View barbershop details (location, contact, services, etc.).
* (Mention any other key features your app has, e.g., user reviews, ratings, booking integration, etc.)

Technologies Used

* Laravel (PHP Framework)
* MySQL (Database)
* (List any other significant technologies, e.g., Blade Templating, Alpine.js, Livewire, specific frontend libraries like React/Vue if used, etc.)

Getting Started

Follow these steps to get AfroCuts running on your local machine for development and testing purposes.

Prerequisites

Before you begin, ensure you have the following installed:

* PHP: Version 8.1 or higher (check php -v)
* Composer: (check composer -v) - https://getcomposer.org/
* Node.js & npm (or Yarn): (check node -v and npm -v or yarn -v) - https://nodejs.org/
* Database Server: MySQL is used by default in the .env.example, but you can configure it for PostgreSQL or SQLite if preferred. Ensure your chosen database server is running.

Local Development Setup

1. Clone the Repository:
   Clone the project from GitHub to your local machine using Git:

   git clone https://github.com/Nwadike/AfroCuts.git

2. Navigate to the Project Directory:
   Change into the newly created project directory:

   cd AfroCuts

3. Install PHP Dependencies:
   Install the backend dependencies using Composer:

   composer install

4. Copy Environment File:
   Create a copy of the example environment file:

   cp .env.example .env

5. Configure Environment Variables:
   Open the .env file in a text editor and update the following sections:

   * App Key: Generate a unique application key if it's not already present:
     php artisan key:generate
     This command automatically updates the APP_KEY in your .env file.

   * Database Configuration: Configure your database connection details. If using MySQL locally, ensure your server is running and replace the placeholder values:
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=afrocuts_db  # Choose a name for your database
     DB_USERNAME=your_db_username
     DB_PASSWORD=your_db_password

6. Create the Database:
   Log in to your database server (e.g., using phpMyAdmin, MySQL Workbench, or the command line) and create a new database with the name you specified in the DB_DATABASE variable in your .env file (e.g., afrocuts_db).

7. Run Database Migrations:
   Apply the database schema using Artisan migrations:

   php artisan migrate

8. Seed the Database (Optional):
   If the project includes seeders to populate the database with initial or test data, run them:

   php artisan db:seed

9. Install Frontend Dependencies:
   Install the frontend dependencies using npm or Yarn:

   npm install
   # or
   # yarn install

10. Compile Frontend Assets:
    Compile your project's frontend assets (CSS, JavaScript). For local development with hot-reloading:

    npm run dev
    # or
    # yarn dev

    For a production-ready build (often done before deployment, but can be tested locally):

    npm run build
    # or
    # yarn build

11. Start the Local Development Server:
    Start the Laravel development server using Artisan:

    php artisan serve

    This will typically start the server at http://127.0.0.1:8000.

12. Access the Application:
    Open your web browser and visit the URL shown in your terminal (usually http://127.0.0.1:8000).

You should now see the AfroCuts application running locally.

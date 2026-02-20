Laravel Project

Overview

This Laravel project includes:

- API with Swagger documentation via L5-Swagger.
- Admin Panel UI built with Tailwind CSS.
- Sample data generation using factories and database seeders.

This setup allows you to run both the API and the admin panel locally, with pre-populated dummy data for testing.

Requirements

- PHP >= 8.x
- Composer
- Laravel >= 10.x
- MySQL or PostgreSQL database
- Node.js & npm/yarn (for frontend build with Tailwind)

Installation

1. Clone the repository
   git clone <your-repo-url>
   cd <project-folder>

2. Install PHP dependencies
   composer install

3. Install Node dependencies
   npm install

    # or

    yarn install

4. Copy .env file
   cp .env.example .env

5. Configure .env

    Update database credentials:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_user
    DB_PASSWORD=your_password

Database Setup

1. Run migrations
   php artisan migrate

2. Seed the database with dummy data
   php artisan db:seed

Swagger API Documentation

1. Generate Swagger docs
   php artisan l5-swagger:generate

2. Access Swagger UI
   http://127.0.0.1:8000/api/documentation

Frontend (Admin Panel)

1. Compile assets
   npm run dev

    # or for production

    npm run build

2. Serve the project
   php artisan serve

Visit:
http://127.0.0.1:8000/

API Usage

- Base URL: http://127.0.0.1:8000/api/v1/
- Swagger docs available at: /api/documentation
- Dummy data is populated via factories and seeders, so you can test endpoints immediately.

Optional: Factories & Custom Seeders

- Factories: Located in database/factories/
- Seeders: Located in database/seeders/

Create additional factory data for testing by adding new seeders and running:
php artisan db:seed --class=YourSeederClass

Notes

- Ensure storage and bootstrap/cache directories are writable.
- Run php artisan config:cache and php artisan route:cache for production optimization.
- Tailwind classes are purged automatically in production builds.

# Shop Management API

This is a Laravel-based API for a shop listing system in Greece. It supports user management (shop owners), shop management, and email notifications when a new offer is created.

## Table of Contents

1. [Setup](#setup)
2. [Running the Application](#running-the-application)
3. [Database Seeding](#database-seeding)
4. [Testing API Endpoints](#testing-api-endpoints)

## Database Management

### Importing the Database Dump

If you want to import the database structure and initial data:

1. Create a new MySQL database for the project (if not already created).

2. Import the SQL dump:
   ```bash
   mysql -u your_username -p your_database_name < database_dump.sql
   ```
   Replace `your_username` with your MySQL username and `your_database_name` with the name of your database.

3. Update your `.env` file with the correct database credentials.

## Setup

To set up this project from scratch, follow these steps:

1. Clone the repository:
   ```
   git clone https://github.com/your-username/shop-listing-api.git
   cd shop-listing-api
   ```

2. Install PHP dependencies:
   ```
   composer install
   ```

3. Create a copy of the `.env.example` file and rename it to `.env`:
   ```
   cp .env.example .env
   ```

4. Generate an application key:
   ```
   php artisan key:generate
   ```

5. Configure your database in the `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

6. Run database migrations:
   ```
   php artisan migrate
   ```

## Running the Application

1. Start your MySQL server.

2. Run the Laravel development server:
   ```
   php artisan serve
   ```
   This will start the server, typically at `http://127.0.0.1:8000` or `http://localhost:8000`.

## Database Seeding

To populate your database with initial data (like shop categories), run:
```
php artisan db:seed
```
This will run all seeders defined in `database/seeders/DatabaseSeeder.php`.

## Testing API Endpoints

To test the API endpoints of this application, you can use various tools and methods. Here's a guide:

### Prerequisites

1. Ensure the Laravel development server is running (`php artisan serve`).
2. Have a tool ready for making HTTP requests.
   - [Postman](https://www.postman.com/downloads/) (recommended)
   - [Insomnia](https://insomnia.rest/download)
   - cURL (command-line tool)

### IMPORTANT

#### Inside the `postman-requests` folder you can find a collection of requests that you can import in postman to test the api.

### Available Endpoints

#### Authentication

1. Register a new shop owner:
   - Method: POST
   - URL: `http://127.0.0.1:8000/api/register`
   - Body (JSON):
     ```json
     {
       "name": "John Doe",
       "email": "john@example.com",
       "password": "password123"
     }
     ```

2. Login:
   - Method: POST
   - URL: `http://127.0.0.1:8000/api/login`
   - Body (JSON):
     ```json
     {
       "email": "john@example.com",
       "password": "password123"
     }
     ```

#### Shops (Requires Authentication)

3. Create a new shop:
   - Method: POST
   - URL: `http://127.0.0.1:8000/api/shops`
   - Headers: 
     - `Authorization: Bearer {your_access_token}`
   - Body (JSON):
     ```json
     {
       "name": "My Shop",
       "shop_owner_id": 1,
       "shop_category_id": 1,
       "description": "A great shop",
       "open_hours": "9-5",
       "city": "Athens",
       "address": "123 Main St"
     }
     ```

4. Get all shops:
   - Method: GET
   - URL: `http://127.0.0.1:8000/api/shops`

5. Get a specific shop:
   - Method: GET
   - URL: `http://127.0.0.1:8000/api/shops/{shop_id}`

6. Update a shop:
   - Method: PUT
   - URL: `http://127.0.0.1:8000/api/shops/{shop_id}`
   - Headers: 
     - `Authorization: Bearer {your_access_token}`
   - Body (JSON): Include the fields you want to update

7. Delete a shop:
   - Method: DELETE
   - URL: `http://127.0.0.1:8000/api/shops/{shop_id}`
   - Headers: 
     - `Authorization: Bearer {your_access_token}`

#### Offers (Requires Authentication)

8. Create a new offer:
   - Method: POST
   - URL: `http://127.0.0.1:8000/api/offers`
   - Headers: 
     - `Authorization: Bearer {your_access_token}`
   - Body (JSON):
     ```json
     {
       "name": "Summer Sale",
       "description": "50% off on all items",
       "shop_id": 1
     }
     ```

9. Get all offers:
   - Method: GET
   - URL: `http://127.0.0.1:8000/api/offers`
   - Headers: 
     - `Authorization: Bearer {your_access_token}`

10. Get a specific offer:
    - Method: GET
    - URL: `http://127.0.0.1:8000/api/offers/{offer_id}`
    - Headers: 
      - `Authorization: Bearer {your_access_token}`

11. Update an offer:
    - Method: PUT
    - URL: `http://127.0.0.1:8000/api/offers/{offer_id}`
    - Headers: 
      - `Authorization: Bearer {your_access_token}`
    - Body (JSON): Include the fields you want to update

12. Delete an offer:
    - Method: DELETE
    - URL: `http://127.0.0.1:8000/api/offers/{offer_id}`
    - Headers: 
      - `Authorization: Bearer {your_access_token}`

### Testing Process

1. First register a new shop owner using the register endpoint.
2. Log in using the login endpoint to obtain an access token.
3. Use this access token in the `Authorization` header for requests that require authentication.
4. Test each endpoint by sending requests with the appropriate method, URL, headers, and body data in JSON format.
5. Verify the responses to ensure they match the expected format and data.

### Notes

- Replace `{your_access_token}` with the actual token received from the login response.
- Replace `{shop_id}` and `{offer_id}` with actual IDs when testing specific shop or offer endpoints.
- Ensure you have the necessary permissions (i.e., you're the owner of the shop) when modifying shop or offer data.
- The API uses JSON for request and response bodies. Set the `Content-Type: application/json` header when sending data in the request body.

For any issues or unexpected behaviors, check the Laravel log file located at `storage/logs/laravel.log` for detailed error messages.
# DineReserve

Web application for managing table reservations for restaurants, built with Laravel and TailwindCSS. DineReserve offers a complete solution for both clients and administrators (restaurant managers) to optimize table and reservation management.

## Features

### Client Side
- **Authentication and Profile Management**: Registration, login, and personal information updates.
- **Reservation Booking**: Search for available tables by date and time, and create new reservations.
- **Reservation Management**: View, modify, and cancel existing reservations.
- **Notifications**: Reservation confirmation by email.

### Administrator Side (Restaurant Manager)
- **Dashboard**: Overview of key statistics (total reservations, pending, confirmed, available tables, etc.).
- **Table Management**: Add, modify, and delete tables (name, capacity, location, availability).
- **Reservation Management**: View, confirm, cancel, and delete all reservations.
- **Notifications**: Alerts for new reservations.

## Technologies Used

- **Backend**: Laravel (PHP Framework)
- **Frontend**: HTML, CSS (TailwindCSS), JavaScript
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **Asset Management**: Vite
- **Testing**: PHPUnit
- **Emails**: Mailpit (for development), SMTP service (for production)

## Prerequisites

Ensure you have the following installed on your development machine:

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- npm or Yarn
- MySQL >= 8.0
- Git

## Local Installation

Follow these steps to set up the project locally:

1.  **Clone the repository**:
    ```bash
    git clone [https://github.com/fhermas22/dinereserve.git](https://github.com/fhermas22/dinereserve.git)
    cd dinereserve
    ```

2.  **Install Composer dependencies**:
    ```bash
    composer install
    ```

3.  **Configure the `.env` file**:
    Copy the `.env.example` file and rename it to `.env`.
    ```bash
    cp .env.example .env
    ```
    Generate an application key:
    ```bash
    php artisan key:generate
    ```
    Update your database connection information in the `.env` file:
    ```env
    DB_DATABASE=dinereserve
    DB_USERNAME=dinereserve_user
    DB_PASSWORD=your_strong_password
    ```

4.  **Create the MySQL database**:
    ```bash
    # Connect to MySQL as root or a user with necessary privileges
    mysql -u root -p
    # In the MySQL shell:
    CREATE DATABASE dinereserve CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    CREATE USER 'dinereserve_user'@'localhost' IDENTIFIED BY 'your_strong_password';
    GRANT ALL PRIVILEGES ON dinereserve.* TO 'dinereserve_user'@'localhost';
    FLUSH PRIVILEGES;
    EXIT;
    ```

5.  **Run database migrations**:
    ```bash
    php artisan migrate
    ```

6.  **Run seeders (test data and admin user)**:
    ```bash
    php artisan db:seed
    ```
    An administrator user will be created with the credentials:
    - Email: `admin@dinereserve.com`
    - Password: `password`
    
    A client user will be created with the credentials:
    - Email: `client@dinereserve.com`
    - Password: `password`

7.  **Install Node.js dependencies and compile assets**:
    ```bash
    npm install
    npm run dev
    # or for production:
    # npm run build
    ```

8.  **Start the Laravel development server**:
    ```bash
    php artisan serve
    ```
    The application will be accessible at `http://127.0.0.1:8000`.

## Additionnal Artisan Commands

- Create a new admin user
    ```bash
    php artisan admin:create {--name=} {--email=} {--password=}
    ```

- Mark old reservations as completed and cleanup cancelled reservations
    ```bash
    php artisan reservations:cleanup
    ```

- Send reminder emails for reservations scheduled for tomorrow
    ```bash
    php artisan reservations:send-reminders
    ```

- Send a test email to the specified address
    ```bash
    php artisan email:test {email}
    ```

## Contribution

Contributions are welcome! Please follow these steps:

1.  Fork the repository.
2.  Create a new branch for your feature (`git checkout -b feature/my-new-feature`).
3.  Commit your changes (`git commit -am 'Add my new feature'`).
4.  Push to the branch (`git push origin feature/my-new-feature`).
5.  Create a new Pull Request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Contact

For any questions or suggestions, please contact me at franciscohermas@gmail.com or open an issue on the GitHub repository.

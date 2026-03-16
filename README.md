# Task Management System

A web-based task management application built with PHP and MySQL, designed to help organizations manage tasks, assign them to employees, and track progress.

## Features

- **User Management**: Admin and employee roles with secure login
- **Task Management**: Create, assign, edit, and delete tasks
- **Task Status Tracking**: Monitor tasks in pending, in progress, and completed states
- **Notifications**: System notifications for users
- **Dashboard**: Role-based dashboards showing task statistics and overviews
- **Profile Management**: Users can edit their profiles

## Technologies Used

- **Backend**: PHP
- **Database**: MySQL
- **Frontend**: HTML, CSS
- **Server**: Apache (via XAMPP)

## Installation

1. **Prerequisites**:
   - XAMPP (or similar Apache, MySQL, PHP stack)
   - PHP 7.0 or higher
   - MySQL

2. **Setup**:
   - Clone or download the project files to your XAMPP `htdocs` directory (e.g., `C:\xampp\htdocs\task_management_system`).
   - Start XAMPP and ensure Apache and MySQL are running.

3. **Database Setup**:
   - Open phpMyAdmin (usually at `http://localhost/phpmyadmin`).
   - Create a new database (e.g., `task_management`).
   - Import the `DB.sql` file to create the necessary tables.
   - Update `DB_connection.php` with your database credentials if needed.

4. **Configuration**:
   - Ensure the project folder is accessible via `http://localhost/task_management_system`.

## Usage

1. **Access the Application**:
   - Open your browser and go to `http://localhost/task_management_system`.

2. **Login**:
   - Use default admin credentials or create users via the admin panel.

3. **Admin Features**:
   - Manage users and tasks from the dashboard.
   - View statistics on tasks, users, and deadlines.

4. **Employee Features**:
   - View and update assigned tasks.
   - Manage personal profile.
## Login Credentials:
** Default Admin User:
   Username: admin
   Password: 123
** Default Employee User:
   Username: raven
   Password: 123
   
## Database Schema

- **users**: Stores user information (id, fullname, username, password, role, created_at)
- **tasks**: Stores task details (id, title, description, assigned_to, status, created_at)
- **notifications**: Stores notifications (id, message, recipient, type, date, is_read)

## Contributing

Feel free to fork the repository and submit pull requests for improvements.

## License

This project is open-source. Please check for any licensing information.

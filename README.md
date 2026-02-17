# SportsPro Technical Support

PHP/MySQL application for managing products, technicians, customers, and product registrations.

## Features

- Customer product registration (login by email, select product)
- Customer management (search by last name, view/update details)
- Technician management (add/delete)

## Requirements

- PHP 8.x
- MySQL (XAMPP recommended)

## Setup (XAMPP)

1. Copy the project into XAMPP:
	- `/Applications/XAMPP/xamppfiles/htdocs/SportsPro`
2. Create/import the database and tables.
3. Update DB credentials in [models/database.php](models/database.php) if needed.
4. Start Apache and MySQL in XAMPP.
5. Open: `http://localhost/SportsPro`

## Database

- Database name: `sportspro`
- Tables used: `customers`, `products`, `registrations`, `technicians`

## Screenshots

![App 1](screenshots/app.png)
![App 2](screenshots/app2.png)
![App 3](screenshots/app3.png)
![App 4](screenshots/app4.png)

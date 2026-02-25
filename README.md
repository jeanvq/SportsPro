<<<<<<< HEAD
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

![Incident 1](screenshots/incident1.png)
![Incident 2](screenshots/incident2.png)
![Incident 3](screenshots/incident3.png)
=======
# SportsPro

Este proyecto es una aplicación web para gestión de clientes, técnicos, incidentes y productos.

## Screenshots

A continuación se muestran algunas capturas de pantalla:

![Ejemplo de screenshot](screenshots/mi_screenshot.png)

![Incidente 1](screenshots/incident1.png)
![Incidente 2](screenshots/incident2.png)
![Incidente 3](screenshots/incident3.png)

Puedes agregar más imágenes en la carpeta screenshots y referenciarlas aquí usando la sintaxis:

```
![Descripción](screenshots/nombre_de_tu_imagen.png)
```

## Instalación

1. Clona el repositorio en tu carpeta htdocs.
2. Asegúrate de tener XAMPP y Apache corriendo.
3. Accede a la aplicación en [http://localhost/SportsPro/](http://localhost/SportsPro/).

## Estructura del proyecto

- controllers/
- customers/
- db/
- incidents/
- models/
- registrations/
- technicians/
- views/

## Autor

Tu nombre aquí.
>>>>>>> ccfc11d (Agregar screenshots y actualizar README.md)

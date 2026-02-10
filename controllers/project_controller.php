<?php
// SportsPro/controllers/project_controller.php

require_once('../models/database.php');
require_once('../models/technician_db.php');

// 1) Leer la acción (puede venir por POST o GET)
$action = filter_input(INPUT_POST, 'action');
if ($action === null) {
    $action = filter_input(INPUT_GET, 'action');
}

// 2) Si no viene acción, mandamos al panel admin (ajusta si tu ruta es otra)
if ($action === null) {
    header('Location: ../views/admin/project_manager.php');
    exit();
}

// =====================
// ACTION: LIST TECHNICIANS (opcional si tu vista llama directo al modelo)
// =====================
if ($action === 'list_technicians') {
    // Renderiza la vista directamente para evitar acceso directo a /views
    include('../views/admin/manage_technicians.php');
    exit();
}

// =====================
// ACTION: DELETE TECHNICIAN
// =====================
if ($action === 'delete_technician') {

    $technicianID = filter_input(INPUT_POST, 'technicianID', FILTER_VALIDATE_INT);

    if ($technicianID) {
        delete_technician($technicianID);
    }

    include('../views/admin/manage_technicians.php');
    exit();
}

// =====================
// ACTION: ADD TECHNICIAN
// =====================
if ($action === 'add_technician') {

    $firstName = trim((string)filter_input(INPUT_POST, 'firstName'));
    $lastName  = trim((string)filter_input(INPUT_POST, 'lastName'));
    $email     = trim((string)filter_input(INPUT_POST, 'email'));
    $phone     = trim((string)filter_input(INPUT_POST, 'phone'));
    $password  = trim((string)filter_input(INPUT_POST, 'password'));

    // Validación: todos obligatorios
    if ($firstName === '' || $lastName === '' || $email === '' || $phone === '' || $password === '') {
        $error = "All fields are required.";
        // Si no tienes error.php, te dejo el paso 2 más abajo
        include('../views/error.php');
        exit();
    }

    add_technician($firstName, $lastName, $email, $phone, $password);

    include('../views/admin/manage_technicians.php');
    exit();
}

// =====================
// Acción desconocida
// =====================
$error = "Unknown action: " . htmlspecialchars($action);
include('../views/error.php');
exit();

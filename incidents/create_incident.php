<?php
// incidents/create_incident.php

session_start();
require_once __DIR__ . '/../models/database.php';
require_once __DIR__ . '/../models/incident_db.php';
require_once __DIR__ . '/../models/customer_db.php';

$message = '';
$success = '';
$customer = null;
$products = [];

// Obtener lista de clientes
$customers = [];
if (isset($db)) {
    $customers = $db->query('SELECT customerID, firstName, lastName FROM customers ORDER BY lastName, firstName')->fetchAll(PDO::FETCH_ASSOC);
}

// Selección de cliente
if (isset($_POST['select_customer'])) {
    $customerID = (int)$_POST['customerID'];
    $customer = get_customer_by_id($customerID);
    $_SESSION['customer'] = $customer;
}
elseif (isset($_SESSION['customer'])) {
    $customer = $_SESSION['customer'];
}

if ($customer) {
    $products = get_registered_products($customer['customerID']);
}

if ($customer && $_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['select_customer'])) {
    $productCode = trim((string)filter_input(INPUT_POST, 'productCode'));
    $title = trim((string)filter_input(INPUT_POST, 'title'));
    $description = trim((string)filter_input(INPUT_POST, 'description'));

    if ($productCode === '' || $title === '' || $description === '') {
        $message = 'All fields are required.';
    } else {
        add_incident($customer['customerID'], $productCode, $title, $description);
        $success = 'Incident was added successfully.';
    }
}

require __DIR__ . '/../views/header.php';
?>

<h2 class="mb-4">Create Incident</h2>

<?php if (!$customer): ?>
    <form method="post" class="card p-4 shadow-sm mb-4">
        <div class="mb-3">
            <label for="customerID" class="form-label">Select Customer</label>
            <select id="customerID" name="customerID" class="form-select" required>
                <option value="">Select a customer</option>
                <?php foreach ($customers as $c): ?>
                    <option value="<?= htmlspecialchars($c['customerID']) ?>">
                        <?= htmlspecialchars($c['firstName'] . ' ' . $c['lastName']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" name="select_customer" class="btn btn-primary">Select Customer</button>
    </form>
<?php endif; ?>

<?php if ($customer): ?>
<div class="mb-3">
    <strong>Customer:</strong>
    <?= htmlspecialchars($customer['firstName'] . ' ' . $customer['lastName']) ?>
</div>

<?php if ($message !== ''): ?>
    <div class="alert alert-warning"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php if ($success !== ''): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<form method="post" class="card p-4 shadow-sm">
    <div class="mb-3">
        <label for="productCode" class="form-label">Product</label>
        <select id="productCode" name="productCode" class="form-select" required>
            <option value="">Select a product</option>
            <?php foreach ($products as $product): ?>
                <option value="<?= htmlspecialchars($product['productCode']) ?>">
                    <?= htmlspecialchars($product['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" id="title" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea id="description" name="description" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create Incident</button>
</form>
<?php endif; ?>

<?php require __DIR__ . '/../views/footer.php'; ?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require __DIR__ . '/../models/database.php';
require __DIR__ . '/../models/product_db.php';
require __DIR__ . '/../models/registration_db.php';

if (!isset($_SESSION['customer'])) {
    header('Location: index.php');
    exit();
}

$customer = $_SESSION['customer'];
$products = get_products();

$message = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productCode = trim((string)filter_input(INPUT_POST, 'productCode'));

    if ($productCode === '') {
        $message = 'Please select a product.';
    } elseif (is_product_registered($customer['customerID'], $productCode)) {
        $message = 'That product is already registered.';
    } else {
        add_registration($customer['customerID'], $productCode);
        $success = 'Product ' . $productCode . ' was registered successfully.';
    }
}

require __DIR__ . '/../views/header.php';
?>

<h2 class="mb-4">Register Product</h2>

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
    <button type="submit" class="btn btn-success">Register Product</button>
</form>

<?php require __DIR__ . '/../views/footer.php'; ?>

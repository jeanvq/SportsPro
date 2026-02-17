<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require __DIR__ . '/../models/database.php';
require __DIR__ . '/../models/customer_db.php';

$email = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim((string)filter_input(INPUT_POST, 'email'));

    if ($email === '') {
        $message = 'Please enter your email.';
    } else {
        $customer = get_customer_by_email($email);
        if ($customer) {
            $_SESSION['customer'] = $customer;
            header('Location: register_product.php');
            exit();
        }
        $message = 'No customer found for that email.';
    }
}

require __DIR__ . '/../views/header.php';
?>

<h2 class="mb-4">Customer Login</h2>

<?php if ($message !== ''): ?>
    <div class="alert alert-warning"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<form method="post" class="card p-4 shadow-sm">
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>

<?php require __DIR__ . '/../views/footer.php'; ?>

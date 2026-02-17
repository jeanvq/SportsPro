<?php
require __DIR__ . '/../models/database.php';
require __DIR__ . '/../models/customer_db.php';

$customerID = filter_input(INPUT_GET, 'customerID', FILTER_VALIDATE_INT);
$success = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerID = filter_input(INPUT_POST, 'customerID', FILTER_VALIDATE_INT);
    $data = [
        'firstName' => trim((string)filter_input(INPUT_POST, 'firstName')),
        'lastName' => trim((string)filter_input(INPUT_POST, 'lastName')),
        'address' => trim((string)filter_input(INPUT_POST, 'address')),
        'city' => trim((string)filter_input(INPUT_POST, 'city')),
        'state' => trim((string)filter_input(INPUT_POST, 'state')),
        'postalCode' => trim((string)filter_input(INPUT_POST, 'postalCode')),
        'countryCode' => trim((string)filter_input(INPUT_POST, 'countryCode')),
        'phone' => trim((string)filter_input(INPUT_POST, 'phone')),
        'email' => trim((string)filter_input(INPUT_POST, 'email')),
    ];

    if (!$customerID) {
        $message = 'Invalid customer ID.';
    } elseif ($data['firstName'] === '' || $data['lastName'] === '' || $data['email'] === '') {
        $message = 'First name, last name, and email are required.';
    } else {
        update_customer($customerID, $data);
        $success = 'Customer updated successfully.';
    }
}

$customer = $customerID ? get_customer_by_id($customerID) : null;

if ($customer && (string)($customer['countryCode'] ?? '') === '') {
    $customer['countryCode'] = 'US';
}

if (!$customer && $message === '') {
    $message = 'Customer not found.';
}

require __DIR__ . '/../views/header.php';
?>

<h2 class="mb-4">View/Update Customer</h2>

<?php if ($message !== ''): ?>
    <div class="alert alert-warning"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php if ($success !== ''): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<?php if ($customer): ?>
    <form method="post" class="card p-4 shadow-sm">
        <input type="hidden" name="customerID" value="<?= (int)$customer['customerID'] ?>">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName" class="form-control" value="<?= htmlspecialchars($customer['firstName'] ?? '') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label" for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" class="form-control" value="<?= htmlspecialchars($customer['lastName'] ?? '') ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="address">Address</label>
            <input type="text" id="address" name="address" class="form-control" value="<?= htmlspecialchars($customer['address'] ?? '') ?>">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="city">City</label>
                <input type="text" id="city" name="city" class="form-control" value="<?= htmlspecialchars($customer['city'] ?? '') ?>">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label" for="state">State</label>
                <input type="text" id="state" name="state" class="form-control" value="<?= htmlspecialchars($customer['state'] ?? '') ?>">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label" for="postalCode">Postal Code</label>
                <input type="text" id="postalCode" name="postalCode" class="form-control" value="<?= htmlspecialchars($customer['postalCode'] ?? '') ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label" for="countryCode">Country Code</label>
                <input type="text" id="countryCode" name="countryCode" class="form-control" value="<?= htmlspecialchars($customer['countryCode'] ?? '') ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="phone">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" value="<?= htmlspecialchars($customer['phone'] ?? '') ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($customer['email'] ?? '') ?>" required>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update Customer</button>
        <a href="index.php" class="btn btn-secondary ms-2">Back</a>
        <a href="index.php" class="btn btn-link ms-2">Search Customers</a>
    </form>
<?php endif; ?>

<?php require __DIR__ . '/../views/footer.php'; ?>

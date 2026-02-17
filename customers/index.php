<?php
require __DIR__ . '/../models/database.php';
require __DIR__ . '/../models/customer_db.php';

$lastName = '';
$customers = [];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lastName = trim((string)filter_input(INPUT_POST, 'lastName'));

    if ($lastName === '') {
        $message = 'Please enter a last name.';
    } else {
        $customers = get_customers_by_last_name($lastName);
        if (!$customers) {
            $message = 'No customers found for that last name.';
        }
    }
}

require __DIR__ . '/../views/header.php';
?>

<h2 class="mb-4">Customer Search</h2>

<form method="post" class="card p-4 shadow-sm mb-4">
    <div class="mb-3">
        <label for="lastName" class="form-label">Last Name</label>
        <input type="text" id="lastName" name="lastName" class="form-control" value="<?= htmlspecialchars($lastName) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Search</button>
</form>

<?php if ($message !== ''): ?>
    <div class="alert alert-warning"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php if ($customers): ?>
    <h4 class="mb-3">Customers</h4>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>City</th>
                <th>State</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= htmlspecialchars($customer['firstName'] . ' ' . $customer['lastName']) ?></td>
                    <td><?= htmlspecialchars($customer['email']) ?></td>
                    <td><?= htmlspecialchars($customer['city']) ?></td>
                    <td><?= htmlspecialchars($customer['state']) ?></td>
                    <td>
                        <form method="get" action="view_customer.php">
                            <input type="hidden" name="customerID" value="<?= (int)$customer['customerID'] ?>">
                            <button type="submit" class="btn btn-sm btn-outline-primary">Select</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/../views/footer.php'; ?>

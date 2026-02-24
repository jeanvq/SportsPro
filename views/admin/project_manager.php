<?php
// list_products.php
require 'db/database.php';

/*
 Expected database columns:
 productCode (VARCHAR)
 name        (VARCHAR)
 version     (DECIMAL or VARCHAR)
 releaseDate (DATE)
*/

$sql = "SELECT productCode, name, version, releaseDate FROM products";
$products = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

include '<views>header.php';
?>

<h2 class="mb-3">Product List</h2>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Product Code</th>
            <th>Name</th>
            <th>Version</th>
            <th>Release Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['productCode']) ?></td>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= htmlspecialchars($product['version']) ?></td>
                <td>
                    <?= date('Y-m-d', strtotime($product['releaseDate'])) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<div class="mb-4">
    <h3>Administrators</h3>
    <a href="/SportsPro/views/admin/project_manager.php" class="btn btn-secondary mb-1">Manage Products</a><br>
    <a href="/SportsPro/views/admin/manage_technicians.php" class="btn btn-secondary mb-1">Manage Technicians</a><br>
    <a href="/SportsPro/views/admin/manage_customers.php" class="btn btn-secondary mb-1">Manage Customers</a><br>
    <a href="/SportsPro/incidents/create_incident.php" class="btn btn-warning mb-1">Create Incident</a><br>
    <a href="/SportsPro/views/admin/assign_incident.php" class="btn btn-secondary mb-1">Assign Incident</a><br>
    <a href="/SportsPro/views/admin/display_incidents.php" class="btn btn-secondary mb-1">Display Incidents</a><br>
    <a href="/SportsPro/views/admin/update_incident.php" class="btn btn-secondary mb-1">Update Incident</a><br>
    <a href="/SportsPro/registrations/register_product.php" class="btn btn-success mb-1">Register Product</a><br>
</div>

<?php include '<views>footer.php'; ?>

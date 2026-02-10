<?php
require_once(__DIR__ . '/../../models/database.php');
require_once(__DIR__ . '/../../models/technician_db.php');

$technicians = get_technicians();
include('../header.php');
?>

<h2>Technician List</h2>

<table>
  <tr>
    <th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Password</th><th></th>
  </tr>

  <?php foreach ($technicians as $t) : ?>
  <tr>
    <td><?= htmlspecialchars($t['firstName']) ?></td>
    <td><?= htmlspecialchars($t['lastName']) ?></td>
    <td><?= htmlspecialchars($t['email']) ?></td>
    <td><?= htmlspecialchars($t['phone']) ?></td>
    <td><?= htmlspecialchars($t['password']) ?></td>
    <td>
      <form action="/SportsPro/controllers/project_controller.php" method="post">
        <input type="hidden" name="action" value="delete_technician">
        <input type="hidden" name="technicianID" value="<?= $t['technicianID'] ?>">
        <button type="submit">Delete</button>
      </form>
    </td>
  </tr>
  <?php endforeach; ?>
</table>

<p><a href="/SportsPro/views/admin/add_technician.php">Add Technician</a></p>

<?php include('../footer.php'); ?>


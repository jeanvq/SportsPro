<?php
require_once(__DIR__ . '/../../models/database.php');
require_once(__DIR__ . '/../../models/technician_db.php');

$technicians = get_technicians();
require_once(__DIR__ . '/../header.php');
?>

<h2 class="mb-3">Technician List</h2>

<div class="card shadow-sm">
  <div class="card-body p-0">
    <table class="table table-striped table-bordered mb-0">
      <thead class="table-dark">
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Password</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
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
                <input type="hidden" name="technicianID" value="<?= (int)$t['technicianID'] ?>">
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<a href="/SportsPro/views/admin/add_technician.php" class="btn btn-primary mt-3">Add Technician</a>

<?php require_once(__DIR__ . '/../footer.php'); ?>


<?php
require_once(__DIR__ . '/../header.php');
?>

<h2 class="mb-4">Add Technician</h2>

<form action="/SportsPro/controllers/project_controller.php" method="post" class="card p-4 shadow-sm">
  <input type="hidden" name="action" value="add_technician">

  <div class="mb-3">
    <label for="firstName" class="form-label">First Name</label>
    <input type="text" id="firstName" name="firstName" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="lastName" class="form-label">Last Name</label>
    <input type="text" id="lastName" name="lastName" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" id="email" name="email" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input type="text" id="phone" name="phone" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="text" id="password" name="password" class="form-control" required>
  </div>

  <button type="submit" class="btn btn-success">Add Technician</button>
</form>

<a href="/SportsPro/controllers/project_controller.php?action=list_technicians" class="btn btn-link mt-3">View Technician List</a>

<?php require_once(__DIR__ . '/../footer.php'); ?>

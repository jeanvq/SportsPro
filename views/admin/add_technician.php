<?php
include('../header.php');
?>

<h2>Add Technician</h2>

<form action="/SportsPro/controllers/project_controller.php" method="post">
  <input type="hidden" name="action" value="add_technician">

  <label>First Name:</label>
  <input type="text" name="firstName"><br>

  <label>Last Name:</label>
  <input type="text" name="lastName"><br>

  <label>Email:</label>
  <input type="text" name="email"><br>

  <label>Phone:</label>
  <input type="text" name="phone"><br>

  <label>Password:</label>
  <input type="text" name="password"><br>

  <button type="submit">Add Technician</button>
</form>

<p><a href="/SportsPro/controllers/project_controller.php?action=list_technicians">View Technician List</a></p>

<?php include('../footer.php'); ?>

<?php include('header.php'); ?>

<h2>Error</h2>
<p><?= htmlspecialchars($error ?? 'Something went wrong.') ?></p>

<p><a href="/SportsPro/views/admin/project_manager.php">Back to Admin</a></p>

<?php include('footer.php'); ?>

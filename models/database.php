<?php
$dsn = 'mysql:host=localhost;dbname=tech_support';
$username = 'root';
$password = '';

try {
  $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
  echo "DB Error: " . $e->getMessage();
  exit();
}

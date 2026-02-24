<?php
// models/incident_db.php

require_once('database.php');

function get_registered_products($customerID) {
    $db = get_db();
    $query = 'SELECT p.productCode, p.name FROM products p
              JOIN registrations r ON p.productCode = r.productCode
              WHERE r.customerID = :customerID';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $products;
}

function add_incident($customerID, $productCode, $title, $description) {
    $db = get_db();
    $query = 'INSERT INTO incidents (customerID, productCode, title, description, dateOpened)
              VALUES (:customerID, :productCode, :title, :description, NOW())';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->bindValue(':productCode', $productCode);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}

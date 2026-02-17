<?php

function is_product_registered($customerID, $productCode) {
    global $db;
    $query = 'SELECT COUNT(*) FROM registrations WHERE customerID = :customerID AND productCode = :productCode';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->bindValue(':productCode', $productCode);
    $statement->execute();
    $count = (int)$statement->fetchColumn();
    $statement->closeCursor();
    return $count > 0;
}

function add_registration($customerID, $productCode) {
    global $db;
    $query = 'INSERT INTO registrations (customerID, productCode, registrationDate)
              VALUES (:customerID, :productCode, NOW())';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->bindValue(':productCode', $productCode);
    $statement->execute();
    $statement->closeCursor();
}

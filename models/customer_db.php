<?php

function get_customer_by_email($email) {
    global $db;
    $query = 'SELECT * FROM customers WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();
    return $customer;
}

function get_customers_by_last_name($lastName) {
    global $db;
    $query = 'SELECT customerID, firstName, lastName, email, city, state
              FROM customers
              WHERE lastName = :lastName
              ORDER BY firstName';
    $statement = $db->prepare($query);
    $statement->bindValue(':lastName', $lastName);
    $statement->execute();
    $customers = $statement->fetchAll();
    $statement->closeCursor();
    return $customers;
}

function get_customer_by_id($customerID) {
    global $db;
    $query = 'SELECT * FROM customers WHERE customerID = :customerID';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();
    return $customer;
}

function update_customer($customerID, $data) {
    global $db;
    $query = 'UPDATE customers
              SET firstName = :firstName,
                  lastName = :lastName,
                  address = :address,
                  city = :city,
                  state = :state,
                  postalCode = :postalCode,
                  countryCode = :countryCode,
                  phone = :phone,
                  email = :email
              WHERE customerID = :customerID';
    $statement = $db->prepare($query);
    $statement->bindValue(':firstName', $data['firstName']);
    $statement->bindValue(':lastName', $data['lastName']);
    $statement->bindValue(':address', $data['address']);
    $statement->bindValue(':city', $data['city']);
    $statement->bindValue(':state', $data['state']);
    $statement->bindValue(':postalCode', $data['postalCode']);
    $statement->bindValue(':countryCode', $data['countryCode']);
    $statement->bindValue(':phone', $data['phone']);
    $statement->bindValue(':email', $data['email']);
    $statement->bindValue(':customerID', $customerID);
    $statement->execute();
    $statement->closeCursor();
}

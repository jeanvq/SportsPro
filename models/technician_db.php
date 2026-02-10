<?php

function get_technicians() {
  global $db;
  $query = 'SELECT * FROM technicians ORDER BY lastName, firstName';
  $statement = $db->prepare($query);
  $statement->execute();
  return $statement->fetchAll();
}

function add_technician($firstName, $lastName, $email, $phone) {
  global $db;
  $query = 'INSERT INTO technicians (firstName, lastName, email, phone)
            VALUES (:firstName, :lastName, :email, :phone)';
  $statement = $db->prepare($query);
  $statement->bindValue(':firstName', $firstName);
  $statement->bindValue(':lastName', $lastName);
  $statement->bindValue(':email', $email);
  $statement->bindValue(':phone', $phone);
  $statement->execute();
  $statement->closeCursor();
}

function delete_technician($technicianID) {
  global $db;
  $query = 'DELETE FROM technicians WHERE technicianID = :technicianID';
  $statement = $db->prepare($query);
  $statement->bindValue(':technicianID', $technicianID);
  $statement->execute();
  $statement->closeCursor();
}

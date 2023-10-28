<?php
// Accounts moodel




// Site registrations


function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
    $db = phpmotorsConnect(); // Assuming phpmotorsConnect() returns a PDO object
    $sql = "INSERT INTO clients (clientFirstName, clientLastName, clientEmail, clientPassword) 
    VALUES (:clientFirstName, :clientLastName, :clientEmail, :clientPassword)";

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':clientFirstName', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastName', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);

    $stmt->execute();
    $rowsChanged = $stmt->rowCount();

    return $rowsChanged;
}





?>



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



function checkExistingEmail($clientEmail) {
    $db =  phpmotorsConnect();
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if(empty($matchEmail)){
     return 0;
    } else {
     return 1;
    }
   }

   function getClient($clientEmail){
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
   }





?>



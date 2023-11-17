<?php

function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;

}

function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

function checkVarChar30($clientInput){
    $pattern = "/^[A-Za-z]{3,30}$/";
    return preg_match($pattern, $clientInput);

}

function checkVarChar50($clientInput){
    $pattern = "/^.*\.(jpg|jpeg|png|gif|bmp)$/";
    return preg_match($pattern, $clientInput) && strlen($clientInput) <= 50;

}

function checkInt($intNum){
    $pattern = "/^\d+(\.\d+)?$/";
    return preg_match($pattern, $intNum);
}

function checkVarChar20($clientInput){
    $pattern = "/^[A-Za-z]{3,20}$/";
    return preg_match($pattern, $clientInput);

}


function navigation(){
    $classifications = getClassifications();

    $navList= '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'> Home </a></li>";

    foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName="
    .urlencode($classification['classificationName']).
    "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
        }
    $navList .= '</ul>';

    return $navList;

}

function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id = "classificationId">';
        foreach($classifications as $classification){
            $classificationList .=  "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
            
        } 
    $classificationList .= '</select>';
 return $classificationList; 
}



   function getUserInfo($clientId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM clients WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

function updateUserInfo($clientEmail,$clientFirstname, $clientLastname, $clientId){
    $db = phpmotorsConnect();
    $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientId = :clientId ,clientEmail = :clientEmail WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function updatePassword($clientId, $clientPassword){
    $db = phpmotorsConnect();
    $sql = 'UPDATE clients SET clientPassword = :clientPassword  WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;

}

function getInventoryByClassification($classificationId){ 
    $db = phpmotorsConnect(); 
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
   }
function getInvItemInfo($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
   }


function buildVehiclesDisplay($vehicles){

    $dv = '<div id="inv-display">';
    foreach ($vehicles as $vehicle) {
    $price = formatPrice($vehicle["invPrice"]);
    $dv .= '<section class ="display">';   
     $dv .= '<div>';
     $dv .= "<a href='/phpmotors/vehicles/?action=car&carName=$vehicle[invId]'><img src='/phpmotors$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
     $dv .= '</div>';
     $dv .= '<div class="info">';
     $dv .= "<a href='/phpmotors/vehicles/?action=car&carName=$vehicle[invId]'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
     
     $dv .= "<span>$ $price </span>";
     $dv .= '</div>';    
     $dv .= '</section>';   
    }
    $dv .= '</div>';
    return $dv;


   }

function formatPrice($number) {
    $formattedPrice = number_format($number,2, '.');
    return $formattedPrice;
}
function displayCarInfo($info){
    $price = formatPrice($info['invPrice']);
    $carInfo = '
    <section class="information">
        <div class="container">
            <h2>' . $info['invMake'] . ' ' . $info['invModel'] . '</h2>
            <div class="photo">
                <img src="/phpmotors/' . $info['invImage'] . '" alt="vehicle thumbnail">
            </div>
            <p>Price: $ ' . $price . '</p> 
            <button>Checkout</button>
        </div>
        <div class="description">
            <h3>' . $info['invMake'] . ' ' . $info['invModel'] . ' Details</h3>
            <p class="desc">' . $info['invDescription'] . '</p>
            <p>In Stock: ' . $info['invStock'] . '</p>
            <p>Color: ' . $info['invColor'] . '</p>              
        </div>
    </section>';
  
    return $carInfo;
  }


?>


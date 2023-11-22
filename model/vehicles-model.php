<?php

require_once '../library/connections.php';


function getClassificationID(){
    $db = phpmotorsConnect();

    $sql = 'SELECT * FROM `carclassification`';

    $stmt = $db->prepare($sql);

    $stmt->execute();

    $classifications= $stmt->fetchAll();
    
    $stmt->closeCursor();

   return $classifications;

}


function getVehiclesByClassification($classificationName){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;

}




function insertCarClassfication($carModel){

    $db = phpmotorsConnect();
    $sql = "INSERT INTO carclassification (classificationName) VALUES (:carClassification)";

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':carClassification', $carModel,PDO::PARAM_STR);
    $stmt->execute();

    $rowsChanges= $stmt->rowCount();

    return $rowsChanges;
}


function insertCar($make,$model,$description,$image,$thumbnail,$price,$inStock,$color,$classificationId){
    $db=phpmotorsConnect();

    $sql = "INSERT INTO inventory (invMake,invModel,invDescription,invImage, invThumbnail, invPrice, invStock, invColor,classificationId) VALUES
    (:invMake,:invModel,:invDescription,:invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)";

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':invMake', $make, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $model, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $description, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $image, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $thumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $price, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $inStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $color, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);


    $stmt->execute();
    $rowChanges = $stmt->rowCount();

    return $rowChanges;
}

function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor,
   $classificationId, $invId) {
 $db = phpmotorsConnect();
 $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
 $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
$stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
 $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
 $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
 $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
 $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
 $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
 $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $rowsChanged = $stmt->rowCount();
 $stmt->closeCursor();
 return $rowsChanged;
}

function updateDelete($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor,
   $classificationId, $invId) {
 $db = phpmotorsConnect();
 $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
 $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
 $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
 $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
 $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
 $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
 $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
 $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $rowsChanged = $stmt->rowCount();
 $stmt->closeCursor();
 return $rowsChanged;
}

function deleteVehicle($invId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
   }


//    / Get information for all vehicles
   function getVehicles(){
       $db = phpmotorsConnect();
       $sql = 'SELECT invId, invMake, invModel FROM inventory';
       $stmt = $db->prepare($sql);
       $stmt->execute();
       $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
       $stmt->closeCursor();
       return $invInfo;
   }


?>
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

?>
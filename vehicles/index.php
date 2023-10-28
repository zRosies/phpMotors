<?php
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../library/functions.php';



    $classifications = getClassifications();
    $classificationID =  getClassificationID();


    $navList = navigation();

   //Passing the classificationName and ClassificationID into the option select

   $options= '';

   foreach($classificationID as $classification){
       $options .=  "<option value='$classification[classificationId]'>$classification[classificationName]</option>";

   
       
   }

    $action= filter_input(INPUT_POST,'action');
    if($action == NULL){
        $action= filter_input(INPUT_GET, 'action');
    }    
   

    switch($action){
      

        case  'vehicle':
            include '../view/add-vehicle.php';

            break;

        case 'class':
            include '../view/add-classification.php';
            break;
        
        case 'post':

            $carClassfication = trim(filter_input(INPUT_POST, 'carClassification', FILTER_SANITIZE_FULL_SPECIAL_CHARS));


            $checkInput = checkVarChar30($carClassfication);

            if(empty($checkInput)){
                $message = '<p class="message"> Please, fill out the form with at least 3 characters before sending! :) </p>';
                include '../view/add-classification.php';
                exit;
            } 
            else if(empty($carClassfication)){
                
                
                $message = '<p class="message"> Please, fill out the form before sending! :) </p>';
                include '../view/add-classification.php';
                exit;
                
                
                
            }


            $created = insertCarClassfication($carClassfication);
            

            if($created >= 1){
                $message = '<p class="message">Classification added successfuly </p>';
                header('Location: /phpmotors/vehicles');

            }

            break;
            
        case 'postcar':
           
            $invclassificationId = trim(filter_input(INPUT_POST, 'invclassificationId', FILTER_VALIDATE_INT));
            $invMake = trim(filter_input(INPUT_POST, 'invMake',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invModel = trim(filter_input(INPUT_POST, 'invModel',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invDescription = trim(filter_input(INPUT_POST, 'invDescription',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invImage = trim(filter_input(INPUT_POST, 'invImage',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION  ));
            $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_VALIDATE_INT));
            $invColor = trim(filter_input(INPUT_POST, 'invColor',FILTER_SANITIZE_FULL_SPECIAL_CHARS));

            $checkMake = checkVarChar30($invMake);
            $checkModel = checkVarChar30($invModel);
            $checkThumb = checkVarChar50($invImage);
            $checkImg = checkVarChar50($invThumbnail);
            $checkColor = checkVarChar20($invColor);
            $checkId = checkInt($invclassificationId);

            if(empty($checkMake) || empty($checkModel) || empty($checkThumb) || empty($checkImg) || empty($checkColor) || empty($checkId)){
                $message = '<p class="message"> Please, fill the form with the correct format before sending! </p>';
                include "../view/add-vehicle.php";
                exit;

            }


           
            if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($invclassificationId)){
                $message = '<p class="message"> Please, fill out the form before sending! :) </p>';

                $newMessage = $invclassificationId;
                include "../view/add-vehicle.php";
                exit;
            }

            $created = insertCar($invMake,$invModel,$invDescription,$invImage,$invThumbnail,$invPrice,$invStock,$invColor,$invclassificationId);

            if($created >= 1){
                $message = '<p class="message">Car added to the database </p>';
                include "../view/vehicle-man.php";
                exit;
            }

            break;

       
         default:
            include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/view/vehicle-man.php';
                 
        
        //sending the path to 500 if the action neither is register or login :) but it should be empty for now              


    }

   

?>


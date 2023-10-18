<?php
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';



    $classifications = getClassifications();
    $classificationID =  getClassificationID();


    
    $navList= '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'> Home </a></li>";

    foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
   }

   $navList .= '</ul>';

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

            $carClassfication = filter_input(INPUT_POST, 'carClassification');
            
            
            if(empty($carClassfication)){
                
                
                $message = '<p class="message"> Please, fill out the form before sending! :) </p>';
                include '../view/add-classification.php';
                
                exit;
                
            }


            $created = insertCarClassfication($carClassfication);
            

            if($created >= 1){
                $message = '<p class="message">Classification added successfuly </p>';
                include '../view/vehicle-man.php';

            }

            break;
            
        case 'postcar':
            $invclassificationId = filter_input(INPUT_POST, 'invclassificationId');
            $invMake = filter_input(INPUT_POST, 'invMake');
            $invModel = filter_input(INPUT_POST, 'invModel');
            $invDescription = filter_input(INPUT_POST, 'invDescription');
            $invImage = filter_input(INPUT_POST, 'invImage');
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
            $invPrice = filter_input(INPUT_POST, 'invPrice');
            $invStock = filter_input(INPUT_POST, 'invStock');
            $invColor = filter_input(INPUT_POST, 'invColor');
           
            if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($invclassificationId)){
                $message = '<p class="message"> Please, fill out the form before sending! :) </p>';
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


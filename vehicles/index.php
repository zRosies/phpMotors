<?php
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../library/functions.php';


    session_start();
    $classifications = getClassifications();
    $classificationID =  getClassificationID();


    $navList = navigation();

    //Passing the classificationName and ClassificationID into the option select

    $options= '';

    foreach($classificationID as $classification){
        $options .=  "<option value='$classification[classificationId]'>$classification[classificationName]</option>";

    
        
    }

    $clientLevel = isset($_SESSION['clientLevel']) ? (int)$_SESSION['clientLevel'] : 0;

    //Extra points here \/
    //checking if the user is logged in and the client level is  > 2 before proceeding
    // if(!isset($_SESSION['loggedin']) || $clientLevel < 2){
    //     include header('Location: /phpmotors/?action=home');
       
    // }    
    

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

            case 'getInventoryItems': 
                // Get the classificationId 
                $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
                // Fetch the vehicles by classificationId from the DB 
                $inventoryArray = getInventoryByClassification($classificationId); 
                // Convert the array to a JSON object and send it back 
                echo json_encode($inventoryArray); 
                break;
            case 'mod':
                $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
                $invInfo = getInvItemInfo($invId);
                if(count($invInfo)<1){
                    $message = 'Sorry, no vehicle information could be found.';
                   }
                include '../view/vehicle-update.php';
                   exit;
               
                break;

            case 'updateVehicle':
                $invclassificationId = filter_input(INPUT_POST, 'invclassificationId', FILTER_SANITIZE_NUMBER_INT);
                $invMake = trim(filter_input(INPUT_POST, 'invMake',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $invModel = trim(filter_input(INPUT_POST, 'invModel',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $invDescription = trim(filter_input(INPUT_POST, 'invDescription',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $invImage = trim(filter_input(INPUT_POST, 'invImage',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION  ));
                $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_VALIDATE_INT));
                $invColor = trim(filter_input(INPUT_POST, 'invColor',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

                $checkMake = checkVarChar30($invMake);
                $checkModel = checkVarChar30($invModel);
                $checkThumb = checkVarChar50($invImage);
                $checkImg = checkVarChar50($invThumbnail);
                $checkColor = checkVarChar20($invColor);
                $checkId = checkInt($invclassificationId);
    
                if(empty($checkMake) || empty($checkModel) || empty($checkThumb) || empty($checkImg) || empty($checkColor) || empty($checkId)){
                    $message = '<p class="response"> Please, fill the form with the correct format before sending! </p>';
                    include "../view/vehicle-update.php";
                    exit;
    
                }

                
    
    
               
                if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($invclassificationId)){
                    $message = '<p class="response"> Please, fill out the form before sending! :) </p>';
    
                    $newMessage = $invclassificationId;
                    include "../view/vehicle-update.php";
                    exit;
                }

                $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor,
                $invclassificationId, $invId);

                if ($updateResult) {
                    $message = "<p class='response'>Congratulations, the $invMake $invModel was successfully updated.</p>";
                       $_SESSION['message'] = $message;
                       header('location: /phpmotors/vehicles/');
                       exit;
                   } else {
                       $message = "<p class='response'>Error. the $invMake $invModel was not updated.</p>";
                        include '../view/vehicle-update.php';
                        exit;
                       }
                
                include "../view/vehicle-update.php";
                
                break;
            case 'del':
                $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
                $invInfo = getInvItemInfo($invId);
                if (count($invInfo) < 1) {
                    $message = 'Sorry, no vehicle information could be found.';
                }
                // else{
                //     $message = "<p class='response'>$invMake $invModel was deleted sucessfuly</p>";
                // }

                include '../view/delete.php';
             
                break;

            case 'delete':
                    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
                    
                    $deleteResult = deleteVehicle($invId);
                    if ($deleteResult) {
                        $message = "<p class='notice'>Congratulations the, $invMake $invModel was successfully deleted.</p>";
                        $_SESSION['message'] = $message;
                        header('location: /phpmotors/vehicles/');
                        exit;
                    } else {
                        $message = "<p class='notice'>Error: $invMake $invModel was not
                    deleted.</p>";
                        $_SESSION['message'] = $message;
                        header('location: /phpmotors/vehicles/');
                        exit;
                    }
                    break;
                
                break;
            case 'classification':
                    $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    
                    $vehicles = getVehiclesByClassification($classificationName);
                    if(!count($vehicles)){
                        $message = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
                      } else {
                        $vehicleDisplay = buildVehiclesDisplay($vehicles);
                      }
                    //   echo $vehicleDisplay;
 

                     include '../view/classification.php';
                     break;
            case 'car':
                $carId = filter_input(INPUT_GET, 'carName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
               
                $vechileInfo = getInvItemInfo($carId);
                $carTitle = $vechileInfo['invMake'] .' '. $vechileInfo['invModel'];
                $additionalImg = getCarInfo($carId);

                // print_r($additionalImg);
                // print_r($vechileInfo);
                $carInfo = displayCarInfo( $vechileInfo, $additionalImg);
                // $vehicles = getInvItemInfo($InvModel);
              

                include '../view/vehicle-detail.php';
                break;


       
            default:
        //  echo '<pre>';
        //     print_r($classificationID);
        //  echo '</pre>';
   
            $classificationList = buildClassificationList($classificationID);


            


            include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/view/vehicle-man.php';
                 
        
        //sending the path to 500 if the action neither is register or login :) but it should be empty for now              


    }

   

?>


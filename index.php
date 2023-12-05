<?php
require_once 'library/connections.php';
require_once 'model/main-model.php';
require_once 'library/functions.php';

session_start();

$classifications = getClassifications();
$navList = navigation();

// if(isset($_COOKIE['firstname'])){
//     $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//  }
if(isset($_SESSION['clientFirstname'])){
    $firstName = isset($_SESSION['clientFirstname']) ? $_SESSION['clientFirstname'] : '';

}


// var_dump($classifications);

// exit;

// echo($navList);

$action= filter_input(INPUT_POST,'action');
    if($action == NULL){
        $action= filter_input(INPUT_GET, 'action');
    }
    
  
    switch($action){
        case 'template':
            break;



       
        default:
            $heroInfo = getInvItemInfo("50SPI165C5EW9AA9");

            $hero_img_path = $heroInfo['invImage'];
            $carId = $heroInfo['invId'];
    
            include 'view/home.php';                


    }

   
  

    // if(isset($_COOKIE['firstname'])){
    //     $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     // echo $cookieFirstname;
    // }

   

?>


<?php
require_once 'library/connections.php';
require_once 'model/main-model.php';
require_once 'library/functions.php';

$classifications = getClassifications();

// var_dump($classifications);

// exit;
$navList = navigation();
    

// echo($navList);

$action= filter_input(INPUT_POST,'action');
    if($action == NULL){
        $action= filter_input(INPUT_GET, 'action');
    }    

    switch($action){
        case 'template':
            break;

       
        default:
            include 'view/home.php';                


    }

   

?>


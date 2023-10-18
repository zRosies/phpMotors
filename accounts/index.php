<?php
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/accounts-model.php';

$classifications = getClassifications();



    
    $navList= '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'> Home </a></li>";

    foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
   }

   $navList .= '</ul>';




    $action= filter_input(INPUT_POST,'action');
    if($action == NULL){
        $action= filter_input(INPUT_GET, 'action');
    }    
    // echo($action);


    switch($action){
      
        case 'register':
            $clientFirstname = filter_input(INPUT_POST, 'clientFirstName');
            $clientLastname = filter_input(INPUT_POST, 'clientLastName');
            $clientEmail = filter_input(INPUT_POST, 'clientEmail');
            $clientPassword = filter_input(INPUT_POST, 'clientPassword');

            if(empty($clientFirstname) || empty($clientLastname) ||empty($clientEmail) || empty($clientPassword)){
                $message = "<p class='response'> Please provide information for all empty fields. </p> ";
                include '../view/register.php';
                exit;
            }

            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

            // echo $regOutcome;

            // handeling the error

            if($regOutcome >= 1){
                $message = "<p class='response'> Thanks for registering, $clientFirstname</p>!";
                include '../view/login.php';
                exit;

            }

            else{
            $message = "<p> Sorry, $clientFirstname! But the registration failed, please try again</p>";
            include '../view/register.php';
            exit;
            }

            // break     
            break;


            case 'login':
            include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/view/login.php';
            break;

     

       
        // default:
        //         '';
                // include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/view/500.php';  
        
        //sending the path to 500 if the action neither is register or login :) but it should be empty for now              


    }

   

?>


<?php
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/accounts-model.php';
require_once '../library/functions.php';



   $navList = navigation();


    $action= filter_input(INPUT_POST,'action');
    if($action == NULL){
        $action= filter_input(INPUT_GET, 'action');
    }    
    // echo($action);


    switch($action){
        
        case 'register':
        $clientFirstname =trim( filter_input(INPUT_POST, 'clientFirstName',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastName',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword',FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
        $hashedPassword = password_hash($checkPassword, PASSWORD_DEFAULT);

            if(empty($checkPassword) ){
                $message = "<p class='response'> Please provide information for all empty fields. </p> ";
                include '../view/register.php';
                exit;
            }
            else if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($hashedPassword)){
                $message = "<p class='response'> Please provide information for all empty fields. </p> ";
                include '../view/register.php';
                exit;
            }

            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

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
            $clientEmail =trim(filter_input(INPUT_POST, 'clientEmail',FILTER_SANITIZE_EMAIL));
            $clientPassword =trim(filter_input(INPUT_POST, 'clientPassword',FILTER_SANITIZE_FULL_SPECIAL_CHARS));

            $cheackPassword = checkPassword($clientPassword);
            $checkEmail = checkEmail($clientEmail);

            if(empty($checkEmail) || empty($checkPassword)){
                $message = "<p class='response'> Please provide information for all empty fields. </p> ";
                include '../view/login.php';
                exit;
            }
               
                
            // include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/view/login.php';

           
        break;

     

       
        // default:
        //         '';
                // include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/view/500.php';  
        
        //sending the path to 500 if the action neither is register or login :) but it should be empty for now              


    }

   

?>


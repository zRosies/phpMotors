<?php
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/accounts-model.php';
require_once '../library/functions.php';


    session_start();
   $navList = navigation();

    $action= filter_input(INPUT_POST,'action');
    if($action == NULL){
        $action= filter_input(INPUT_GET, 'action');
    }  
    // echo($action);

    if(isset($_SESSION['loggedin'])){
        if($_SESSION['loggedin']){

            $action = 'logged';
        }
       
    }

    if(isset($_COOKIE['firstname']) || isset($_COOKIE['lastname']) || isset($_COOKIE['email'])){
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $cookieLastname = filter_input(INPUT_COOKIE, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $cookieEmail = filter_input(INPUT_COOKIE, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
     }

  


    switch($action){
        
        case 'register':
              


            $clientFirstname =trim( filter_input(INPUT_POST, 'clientFirstName',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientLastname = trim(filter_input(INPUT_POST, 'clientLastName',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword',FILTER_SANITIZE_STRING));

            $existingEmail = checkExistingEmail($clientEmail); 
        
            if($existingEmail){
                $message = '<p class="response">That email address already exists. Do you want to login instead?</p>';
                include '../view/login.php';
                exit;
            } 

      

            $clientEmail = checkEmail($clientEmail);
            $checkPassword = checkPassword($clientPassword);
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

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

            if($regOutcome === 1){
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                $_SESSION['message'] = "<p class='response'> Thanks for registering, $clientFirstname. Please use your email and password to login.</p> "; 
                include header('Location: /phpmotors/accounts/?action=login');
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
            $clientEmail =trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientPassword =trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

            
            $checkPassword = checkPassword($clientPassword);
            $checkEmail = checkEmail($clientEmail);
            
                // echo $clientData['clientPassword'];
                // $message = "<p> $hashCheck </p>";

                // if ($clientPassword == $clientData['clientPassword'])


            if (empty($clientEmail) || empty($checkPassword)) {
                $message = '<p class="response">Please provide a valid email address and password.</p>';
                include '../view/login.php';
                exit;
               }
                 
               
               $clientData = getClient($clientEmail);
    
               $hashedPassword = $clientData['clientPassword'];
           
               $hashCheck = password_verify($clientPassword, $hashedPassword);

               
          
                $clientData = getClient($clientEmail);
                // Compare the password just submitted against
                // the hashed password for the matching client
                $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
                // If the hashes don't match create an error
                // and return to the login view
                if(!$hashCheck) {
                $message = '<p class="response">Please check your password and try again.</p>';
                include '../view/login.php';
                exit;
                }

        
               $_SESSION['loggedin'] = TRUE;

               $clientFirstname = $clientData['clientFirstname'];

               $_SESSION['clientFirstname'] = $clientFirstname;

               setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
               setcookie('lastname', $clientData['clientLastname'], strtotime('+1 year'), '/');
               setcookie('email', $clientData['clientEmail'], strtotime('+1 year'), '/');
         
               array_pop($clientData);
               // Store the array into the session
               $_SESSION['clientData'] = $clientData;
               // Send them to the admin view
               include '../view/admin.php';
               exit;
        break;
               
        case 'logged':

            

            include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/view/admin.php';
            break;

        case'logout':
            
            break;
        
        case 'manage':
            break;
    

     

       
        // default:
        //         '';
                // include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/view/500.php';  
        
        //sending the path to 500 if the action neither is register or login :) but it should be empty for now              


    }

   

?>


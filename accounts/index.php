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

    //Checking if the user is logged in! If the users is logged in it will not stop the logout action.

    //look this if the controlers is not working properly
    // echo $action;

    if(isset($_SESSION['loggedin']) && $action != 'logout' && $action != 'update' && $action != 'updateaccount' && $action != 'password'){
        if($_SESSION['loggedin']){

            $action = 'logged';
        }
       
    }



    

    // checking if the variables exist in the session with ternary elements
    if(isset($_SESSION['clientFirstname'])){
        $firstName = isset($_SESSION['clientFirstname']) ? $_SESSION['clientFirstname'] : '';
    
    }
    $lastName = isset($_SESSION['clientLastname']) ? $_SESSION['clientLastname'] : '';
    $email = isset($_SESSION['clientEmail']) ? $_SESSION['clientEmail'] : '';
    $clientId = isset($_SESSION['clientId']) ? $_SESSION['clientId'] : '';
    $clientLevel = isset($_SESSION['clientLevel']) ? (int)$_SESSION['clientLevel'] : 0;
    
    $showAdminView = FALSE;

    if($clientLevel > 1){
        $showAdminView = TRUE;
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

               if(!$clientData){
                   $message = '<p class="response">Please provide a valid email address and password.</p>';
                   include '../view/login.php';
                   exit;
               }


    
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

               $_SESSION['clientFirstname'] = $clientData['clientFirstname'];
               $_SESSION['clientLastname'] = $clientData['clientLastname'];
               $_SESSION['clientEmail'] = $clientData['clientEmail'];
               $_SESSION['clientId'] = $clientData['clientId'];
               $_SESSION['clientLevel'] = $clientData['clientLevel'];
               
            //    $_SESSION['clientFirstname'];
               
        
            //     $_SESSION['clientLastname'];
               
     
            //    $_SESSION['clientEmail'];
         
               array_pop($clientData);
              
               $_SESSION['clientData'] = $clientData;
              
               include header('Location: /phpmotors/accounts/index.php?action=login');
               exit;
        break;
               
        case 'logged':

            

            include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/view/admin.php';
            break;

        case 'logout':

            session_unset();
            session_destroy();

            foreach($_COOKIE as $cookieName => $cookieValue){
                setcookie($cookieName,'',1,'/');
            }

            
            include header('Location: /phpmotors/?action=home');
             break;
        case 'update':
      
                $clientId = filter_input(INPUT_GET, 'clientId',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $_SESSION['clientId'] = $clientId;

                $result = getUserInfo($clientId);
                if (count($result) < 1) {
                    $message = 'Sorry, no user information found.';
                }
                include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/view/client-update.php';
        
                break;
        case 'updateaccount':
            $clientFirstname =trim( filter_input(INPUT_POST, 'clientFirstName',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientLastname = trim(filter_input(INPUT_POST, 'clientLastName',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
         
            $clientEmail = checkEmail($clientEmail);
        
        
            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
                $message = "<p class='response'> Please provide information for all empty fields. </p> ";
                include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/view/client-update.php';
                exit;
            }


            $result = updateUserInfo($clientEmail, $clientFirstname, $clientLastname, $clientId);




            if ($result) {
                $message = "<p class='response'>Congratulations, $clientFirstname! Your profile was updated.</p>";
                $_SESSION['message'] = $message;
                include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/view/client-update.php';
                exit;
            } else {
                $message = "<p class='response'>Error. Your profile was not updated.</p>";
                $_SESSION['message'] = $message;
                include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/view/client-update.php';
                exit;
            }

            
          

            
            include "../view/vehicle-update.php";
    
            break;
        case 'password':
            
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword',FILTER_SANITIZE_STRING));
            $checkPassword = checkPassword($clientPassword);
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
            
            if(empty($checkPassword) ){
                $message = "<p class='response'> Please provide information correclty. </p> ";
                include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/view/client-update.php';
                exit; 
            }
            else if(empty($hashedPassword)){
                $message = "<p class='response'> Please provide information for all empty fields. </p> ";
                include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/view/client-update.php';
                exit;
            }

            $result = updatePassword($_SESSION['clientId'], $hashedPassword);
            $userInfo = getUserInfo($_SESSION['clientId']);
            
            
            if ($result) {
                $message = "<p class='response'>Congratulations, Your password was updated sucessfuly</p>";
                $_SESSION['message'] = $message;
                include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/view/client-update.php';
                exit;
            } else {
                $message = "<p class='response'>Error. Your password was not updated.</p>";
                $_SESSION['message'] = $message;
                include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/view/client-update.php';
                exit;
            }

            break;
 


     

             


    }

   

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account | Register</title>
    <link rel="stylesheet" href="/phpmotors/css/regi.css?<?php echo time()?>">
    <link rel="stylesheet" href="/phpmotors/css/loginmobile.css?<?php echo time()?>">
</head>
<body>
 <div class='weird'>
   <header>
       <?php
            include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/header.php'
       ?>

    </header>
    <main>
        <?php
             if(isset($message)){
                    echo $message;
                }

        ?>

        <form method="post" action = "/phpmotors/accounts/index.php?action=updateaccount">
            <!-- Just put the message here so i could use postition relative to follow the container form with position absolute -->
            
            <h1>Update your account</h1>
            <label for="firstName">First name <span>*</span>
                <input name="clientFirstName" id="firstName" type="text" placeholder="eg: Ana" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}
                    if(isset($firstName)){ echo "value='$firstName'"; } elseif(isset($result['firstName'])) {echo "value='$result[firstName]'"; }
                ?> required>
            </label>
            <label for="lastName">Last name <span>*</span>
                <input name="clientLastName" id="lastName" type="text" required placeholder="eg: Swift" <?php if(isset($clientFirstname)){echo "value='$clientLastname'";}
                    if(isset($clientLastName)) {
                        echo "value='" . htmlspecialchars($clientLastName) . "'";
                    } else if(isset($result['clientLastname'])) {
                        echo "value='" . htmlspecialchars($result['clientLastname']) . "'";
                    } else if(isset($userInfo['clientLastname'])) {
                        echo "value='" . htmlspecialchars($userInfo['clientLastname']) . "'";
                    }
                ?>>
            </label>
            <label for="email">Email <span>*</span>
                <input name="clientEmail" id="email" type="email" required placeholder="eg: yourname@gmail.com" <?php if(isset($clientFirstname)){echo "value='$clientEmail'";}
                    if(isset($clientEmail)){ echo "value='$clientEmail'"; } 
                    elseif(isset($result['clientEmail'])) {echo "value='$result[clientEmail]'";
                     }
                     else if(isset($userInfo['clientEmail'])) {
                        echo "value='" . htmlspecialchars($userInfo['clientEmail']) . "'";
                    }
                    
                ?>>
            </label>
            <button type="submit">Update Account</button>
            <!-- <input type="hidden" name="action" value="updateaccount"> -->
        </form>
        <form action="/phpmotors/accounts/index.php?action=password" method='post'>
            <label for="password" >Password <span>*</span>
                <input name="clientPassword" id="password" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" placeholder="eg: myPassword2$">
                <span id='span'>Your new password must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> 
            </label>
            <button type="submit">Update Password</button>


        </form>
     

    </main>
    <footer>
                <?php

                    include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php';

                ?>
    </footer>
    </div>
 </body>
 <script src="/phpmotors/scripts/script.js"></script>
</html>
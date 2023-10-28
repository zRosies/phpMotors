<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account | Login</title>
    <link rel="stylesheet" href="/phpmotors/css/login.css?<?php echo time()?>">
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
        
        <form action="/phpmotors/accounts/index.php" method='post'>
            <h1>Sign In</h1>
            <label for="clientEmail">Email :
                <input name=clientEmail id="clientEmail" type="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}?> required>
            </label>
            <label for="clientPassword" >Password :
                <input name=clientPassword id="clientPassword" type="password" pattern='(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$' required >
            </label>
            <button type="submit" name="login">Login</button>
            <input type="hidden" name='action' value='login'>
            <p>or</p>
            <p>Not registered? <span><a href="/phpmotors/accounts/index.php?action=register">Sign up for free</a></span></p>
            
        </form>

    </main>
    <footer>
                <?php

                    include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php';

                ?>
    </footer>
    </div>
    <script src="/phpmotors/scripts/script.js"></script>
</body>
</html>
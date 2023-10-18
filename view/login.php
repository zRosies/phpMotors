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
        
        <form action="">
            <h1>Sign In</h1>
            <label for="clientEmail">Email :
                <input name=clientEmail id="clientEmail" type="email"  required>
            </label>
            <label for="clientPassword" >Password :
                <input name=clientPassword id="clientPassword" type="password"  required>
            </label>
            <button type="submit">Login</button>
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
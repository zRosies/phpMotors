<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account | Register</title>
    <link rel="stylesheet" href="/phpmotors/css/regi.css">
    <link rel="stylesheet" href="/phpmotors/css/loginmobile.css">
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
                if (isset($message)) {
                echo $message;
                }
            ?>
       
        <form method="post" action = "/phpmotors/accounts/index.php">
            <!-- Just put the message here so i could use postition relative to follow the container form with position absolute -->
            
            <h1>Register</h1>
            <label for="firstName">First name <span>*</span>
                <input name="clientFirstName" id="firstName" type="text"  placeholder="eg: Ana">
            </label>
            <label for="lastName">Last name <span>*</span>
                <input name="clientLastName" id="lastName" type="text" placeholder="eg: Swift">
            </label>
            <label for="email">Email <span>*</span>
                <input name="clientEmail" id="email" type="email"  placeholder="eg: yourname@gmail.com">
            </label>
            <label for="password" >Password <span>*</span>
                <input name="clientPassword" id="password" type="password" placeholder="eg: myPassword2$">
            </label>
            <p>You password must include (8) characters, (1) number, (1) capital letter, and (1) special chracter.</p>
            <button type="submit">Register</button>
            <input type="hidden" name="action" value="register">
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
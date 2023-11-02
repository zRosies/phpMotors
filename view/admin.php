<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My account</title>
    <link rel="stylesheet" href="/phpmotors/css/admin.css?<?php echo time()?>">
</head>
<body>
<div class='weird'>
   <header>

   <div class="account">
    <a href="/phpmotors/index.php"><img src="/phpmotors/images/site/logo.png" alt="logo"></a>
    <div class='log'>
        <?php
             if(isset($cookieFirstname)){
                echo "<p class='welcome'>$cookieFirstname </p>";
            }
        ?>
        <a class='logout' href="/phpmotors/accounts/index.php?action=logout">Log out</a>
        
    </div>
</div>

    <?php
        include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/nav.php';
    ?>

    </header>
    <main>
        <h3></h3>
            <?php
                 if(isset($cookieFirstname) || isset($cookieLastname) || isset($cookieEmail) ){
                    echo "
                   

                    <div class = 'info'>
                        <h1>$cookieFirstname $cookieLastname </h1>

                        <h3>You are logged in: </h3>

                        <p class='welcome'>First Name:$cookieFirstname </p> 
                        <p> Last Name: $cookieLastname</p>
                        <p>Email: $cookieEmail </p>
                    
                    </div>";
                }

                if(true){
                    echo "<h3>Inventory Management</h3>
                        <p> Use this link to manage the inventory </p>
                        <a href='/phpmotors/inventory/index.php?action=MANAGE'>Vhicle Management</a>
                    ";

                }
            ?>  
     <!-- <a href="">testando</a> -->
        
       

    </main>
    <footer>
                <?php

                    include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php';

                ?>
    </footer>
    </div>
    
</body>
</html>
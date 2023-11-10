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
            <?php
                if(isset($firstName)){
                    echo "<p class='response'>Welcome, $firstName </p>";
                }
            ?>
        <div class='log'>
            <?php
                if(isset($firstName)){
                    echo "<p class='welcome'>$firstName </p>";
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
    

            <?php
                 if(true){
                    echo "
                    <div class='info'>
                        <h1>{$firstName} {$lastName}</h1>
                
                        <h3>You are logged in: </h3>
                
                        <p class='welcome'>First Name: {$firstName} </p> 
                        <p>Last Name: {$lastName}</p>
                        <p>Email: {$email}</p>
                
                        <h3>Use this link to update your account information</h3> 
                        <a href= '../accounts/index.php?action=update&clientEmail=$email'
                   
                   >
                
                   Update</a> 
                       
                    </div>";
                }
               

                if($showAdminView){
                    
                    echo "<h3>Inventory Management</h3>
                        <p> Use this link to manage the inventory</p>
                        <a href='/phpmotors/vehicles/'>Vehicle Management</a>
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
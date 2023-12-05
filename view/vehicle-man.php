<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Management</title>
    <link rel="stylesheet" href="/phpmotors/css/vehicle-man.css?v=<?php echo time();?>">
 
</head>
<body>
<div class='weird'>
<header>

         <?php
            include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/header.php';
          
       ?>
        <?php
            if ($_SESSION['clientData']['clientLevel'] < 2) {
            header('location: /phpmotors/');
            exit;
            }
        ?>

</header>
    <main>
        <?php
            if(isset($message)){
                echo $message;
            }

            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
               }
            
        ?>
        <ul>
            <li>
                <a href="index.php?action=class">Add Classification</a>
                
            </li>
            <li>
                <a href="index.php?action=vehicle">Add Vehicle</a>
            </li>
        </ul>
        <?php
                if (isset($classificationList)) { 
                echo '<h2>Vehicles By Classification</h2>'; 
                echo '<p>Choose a classification to see those vehicles</p>'; 
                echo $classificationList; 
                }
        ?>
        <noscript>
        <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
        </noscript>
        <script src="../js/inventory.js"></script>
        <table id="inventoryDisplay"></table>
   

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

<?php unset($_SESSION['message']); ?>
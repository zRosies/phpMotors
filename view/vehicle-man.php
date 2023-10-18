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
            include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/header.php'
       ?>

    </header>
    <main>
        <?php
            if(isset($message)){
                echo $message;
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
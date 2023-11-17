<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <?php 
       if(isset($classificationName)){
        echo " <title>$classificationName Vehicles| PHP Motors</title>";
       }
    ?>
    <link rel="stylesheet" href="/phpmotors/css/class.css?<?php echo time()?>">
    <link rel="stylesheet" href="/phpmotors/css/classmob.css?<?php echo time()?>">
    
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
       
            if(isset($vehicleDisplay)){
                echo $vehicleDisplay;
            }
        
        ?>
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
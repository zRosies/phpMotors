<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Classification</title>
    <link rel="stylesheet" href="/phpmotors/css/carclassification.css?<?php echo time()?>">
</head>
<body>
    <div class='weird'>
        <header>
        <?php
                include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/header.php'
        ?>

        </header>
        <main>

            <h1>Add Car Classification</h1>

            <?php
                if(isset($message)){
                    echo $message;
                }

            ?>
            
            <form method='post' action="/phpmotors/vehicles/index.php?action=post">
                <label for="carClassification" >Car Classification
                    <input type="text" name="carClassification" id="carClassification">

                </label>
                <button type="submit">Add classification</button>

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
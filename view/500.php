<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error</title>
    <link rel="stylesheet" href="/css/home.css?<?php echo time()?>">
    <link rel="stylesheet" href="/css/mobile.css?<?php echo time()?>">
    <link rel="stylesheet" href="/css/500.css?<?php echo time()?>">
</head>
<body>
    <div class="weird">
        <header>
            <?php
                include $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'
            ?>
        </header>
        <main>
            <h1>Server Error</h1>
            <p>Sorry, our servers seems to be experiencing some technical difficulties.
                Please check back later!

            </p>

        </main>
        <footer>
            <?php
                include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php'
            ?>
        </footer>
    </div>
    <script src='./scripts/script.js'></script>
    
</body>
</html>
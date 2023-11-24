<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/home.css?<?php echo time()?>">
    <link rel="stylesheet" href="/phpmotors/css/mobile.css?<?php echo time()?>">
</head>
<body>
    <div class="weird">
    <header>  
       <?php
            include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/header.php';
          
       ?>

    </header>
    <main>
        <h1>Welcome to PHP Motors</h1>
        <div class="hero">
            <img src=<?php  if(isset($hero_img_path)){
                   echo '/phpmotors'. $hero_img_path;
                }?> 
                alt="hero">
            <div class="banner">
                <h2>DMC Delorean</h2>
                <p>3 cup holders</p>
                <p>Superman doors</p>
                <p>Fuzzy dice!</p>
                
            </div>
            <!-- own today here -->
            <!-- <div class="banner1">
                <img src="./images/site/own_today.png"  alt="ban">
            </div> -->

            <div class='banner1'>
               <a href=<?php echo 'vehicles/?action=car&carName='. $carId ?> > <button>Own Now !</button></a>
            </div>
            
        </div>
        <section>
            <div>
                <h2>Delorean Upgrades</h2>
                <div class="upgrades">
                    <div>
                        <img src="./images/upgrades/flux-cap.png" alt="flux">
                        <a href="#">Flux Capacitor</a>

                    </div>
                    <div>
                        <img src="./images/upgrades/flame.jpg" alt="flame">
                        <a href="#">Flame decals</a>
                        
                    </div>
                    <div>
                        <img src="./images/upgrades/bumper_sticker.jpg" alt="sticker">
                        <a href="#">Bumper Stickers</a>
                        
                    </div>
                    <div>
                    <img src="./images/upgrades/hub-cap.jpg" alt="hub">
                        <a href="#">Hub Caps</a>
                    </div>

                </div>

            </div>
            <div class="reviews">
                <h2>DMC Reviews</h2>
                <ul>
                    <li>"So fast its almost like traveling in time" (4/5)</li>
                    <li>"Coolest ride on the road"(4/5)</li> 
                    <li>"I'm feeling McFly!"(5/5)</li>
                    <li>"The most futurist ride of our day" (4.5/5)</li>
                    <li>"80's livin and love it"(5/5)</li>
                   
                    
                </ul>

            </div>
        </section>
        <footer>
                <?php

                    include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php';

                ?>
        </footer>
    </main>
    
    <script src="./scripts/script.js"></script>
</body>
</html>
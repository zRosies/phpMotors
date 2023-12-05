
<link rel="stylesheet" href="/phpmotors/css/nav.css?<?php echo time()?>">
<script src="https://kit.fontawesome.com/7393b3984f.js" crossorigin="anonymous"></script>
<div class="account">
    <a href="/phpmotors/index.php"><img src="/phpmotors/images/site/logo.png" alt="logo"></a>
        <?php
            if(isset($firstName)){
                echo "<p class='response'>Welcome, $firstName </p>";
            }
            ?>
    <div class='user'>
        <a href='/phpmotors/search/'>
        <span class="sr-only">Search</span>
        <i id="search" class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
        </a>
        <a href="/phpmotors/accounts/index.php?action=login">My account</a>
       
        <?php
        if(isset($_SESSION['loggedin'])){
            echo '<a class="logout" href="/phpmotors/accounts/index.php?action=logout">Log out</a>';
            
        }
        ?>
    </div>


</div>


<?php
    include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/nav.php'
?>




<div class="account">
    <a href="/phpmotors/index.php"><img src="/phpmotors/images/site/logo.png" alt="logo"></a>
        <?php
            if(isset($firstName)){
                echo "<p class='response'>Welcome, $firstName </p>";
            }
            ?>
    <a href="/phpmotors/accounts/index.php?action=login">My account</a>
    <?php
    if(isset($_SESSION['loggedin'])){
        echo '<a class="logout" href="/phpmotors/accounts/index.php?action=logout">Log out</a>';
        
    }
?>

</div>


<?php
    include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/nav.php'
?>




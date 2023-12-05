<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php  if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/addvehicle.css?v=<?php echo time(); ?>">
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
            if(isset($message)){
                echo $message;
            }
        ?>
          <h1>
          <p>Confirm Vehicle Deletion. The delete is permanent.</p>
        
            </h1>
        
        <form action='/phpmotors/vehicles/index.php?action=delete' method="post" >
        
            <label for="invMake"> Make
            <input type="text" name="invMake" id="invMake" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
            </label>
            
            <label for="invModel"> Model
            <input type="text" name="invModel" id="invModel" required <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>
            </label>
            <label for="invDescription"> Description
                <textarea name='invDescription' id="invDescription" rows="4" required >
                    <?php if(isset($invDescription)){echo trim($invDescription);}
                        if(isset($invDescription)){ echo "value='$invDescription'"; } elseif(isset($invInfo['invDescription'])) {echo "$invInfo[invDescription]"; }
                    ?>
                </textarea>
            </label>
           

            <button type='submit'>Delete</button>
            <input type="hidden" name="invId" value="
            <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
            elseif(isset($invId)){ echo $invId; }?>
            ">
            <input type="hidden" name="action" value="delete">

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
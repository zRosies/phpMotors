<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> || PHP Motors</title>
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
            <?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	                echo "Modify $invInfo[invMake] $invInfo[invModel]";
                }

	        else if(isset($invMake) && isset($invModel)) { 
		    echo "Modify $invMake $invModel"; 
            }?>
        
            </h1>
        
        <form action="/phpmotors/vehicles/index.php?action=postcar" method="post" >
          

      
                <select name= invclassificationId required>
                    <option value="" selected disabled>Choose car classficiation</option>
                    <?php
                            if (isset($options)) {
                                foreach ($classificationID as $classification) {
                                    $value = $classification['classificationId'];
                                    $selected = isset($_POST['invclassificationId']) && $_POST['invclassificationId'] == $value ? 'selected' : '';
                        
                                    echo "<option value='$value' $selected>{$classification['classificationName']}</option>";
                                }
                            }
                                            
                    ?>
                </select>
        
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
            <label for="invImage" required> Image
                <input name='invImage' id = "invImage" pattern=".+\.(jpg|jpeg|png|gif|bmp)$" <?php if(isset($invImage)){echo "value='$invImage'";}
                       if(isset($invImage)){ echo "value='$invImage'"; } elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }
                ?> maxlength="50" type="text" required>
            </label>
            <label for="invThumbnail"> Thumbnail
                <input  name='invThumbnail' id = "invThumbnail" pattern=".+\.(jpg|jpeg|png|gif|bmp)$" type="text"  maxlength="50"  <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}
                    if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }
                ?> required>
            </label>
            <label for="invPrice"> Price
                <input name='invPrice' id= "invPrice" type="number" <?php if(isset($invPrice)){echo "value='$invPrice'";}
                    if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }
                ?>  step="0.1" placeholder="$0.00" required>
            </label>
            <label for="invStock"># in Stock
                <input name='invStock' id = "invStock" type="number"  <?php if(isset($invStock)){echo "value='$invStock'";}
                    if(isset($invStock)){ echo "value='$invStock'"; } elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }
                ?>required>
            </label>
            
            <label for="invColor"> Color 
                <input name='invColor' id = "invColor" type="text" pattern="[A-Za-z]{3,20}"  <?php if(isset($invColor)){echo "value='$invColor'";}
                    if(isset($invColor)){ echo "value='$invColor'"; } elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }
                ?> required>
            </label>

            <button type='submit'>Add car</button>
            <input type="hidden" name="action" value="updateVehicle">

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
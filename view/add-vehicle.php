<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vechicle</title>
    <link rel="stylesheet" href="/phpmotors/css/addvehicle.css?v=<?php echo time(); ?>">
</head>
<body>
<div class='weird'>
<header>


         <?php
            include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/header.php';
          ?>

</header>
    <main>

        <?php
            if(isset($message)){
                echo $message;
            }
        ?>
        
        <form action="/phpmotors/vehicles/index.php?action=postcar" method="post" >
            <h1>Vehicle Information</h1>

      
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

            <label for="invMiles"> Miles
                <input name='invMiles' id="invMiles" type="text" required <?php if(isset($invMiles)){echo "value='$invMiles'";}?>> 
            </label>

            <label for="invId"> Product id
                <input name='invId' id="invId" type="text"  required <?php if(isset($invId)){echo "value='$invId'";}?>> 
            </label>
        
            <label for="invMake"> Make
                <input name='invMake' id="invMake" type="text" pattern="[A-Za-z]{3,30}" required <?php if(isset($invMake)){echo "value='$invMake'";}?>> 
            </label>
            
            <label for="invModel"> Model
                <input name='invModel' id = "invModel" type="text" pattern="[A-Za-z]{3,30}" <?php if(isset($invModel)){echo "value='$invModel'";}?>  required>
            </label>
            <label for="invDescription"> Description
                <textarea name='invDescription' id="invDescription" rows="4" required>
                    <?php if(isset($invDescription)){echo trim($invDescription);}?>
                </textarea>
            </label>
            <label for="invImage" required> Image
                <input name='invImage' id = "invImage" pattern=".+\.(jpg|jpeg|png|gif|bmp)$" <?php if(isset($invImage)){echo "value='$invImage'";}?> maxlength="50" type="text" required>
            </label>
            <label for="invThumbnail"> Thumbnail
                <input  name='invThumbnail' id = "invThumbnail" pattern=".+\.(jpg|jpeg|png|gif|bmp)$" type="text"  maxlength="50"  <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}?> required>
            </label>
            <label for="invPrice"> Price
                <input name='invPrice' id= "invPrice" type="number" <?php if(isset($invPrice)){echo "value='$invPrice'";}?>  step="0.1" placeholder="$0.00" required>
            </label>
            <label for="invStock"># in Stock
                <input name='invStock' id = "invStock" type="number"  <?php if(isset($invStock)){echo "value='$invStock'";}?>required>
            </label>
            
            <label for="invColor"> Color 
                <input name='invColor' id = "invColor" type="text" pattern="[A-Za-z]{3,20}"  <?php if(isset($invColor)){echo "value='$invColor'";}?> required>
            </label>

            <button type='submit'>Add car</button>

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
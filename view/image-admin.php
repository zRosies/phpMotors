<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($invInfo['invMake']) || isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) || isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> || PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/addvehicle.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="/phpmotors/css/image-admin.css?<?php echo time()?>">
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
                    if (isset($_SESSION['message'])) {
                        $message = $_SESSION['message'];
                        echo $message;
                    }
            ?>
        <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
            <label>Vehicle</label>
                <?php echo $prodSelect; ?>
                <label>Is this the main image for the vehicle?</label>
                <fieldset>
                  
                    <label for="priYes" class="pImage">Yes</label>
                    <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                    <label for="priNo" class="pImage">No</label>
                    <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                </fieldset>
            <label>Upload Image:
                <input type="file" name="file1">
            </label>
            
            <input type="submit" class="regbtn" value="Upload">
            <input type="hidden" name="action" value="upload">
        </form>
        <h2>Existing Images</h2>
            <p >If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
            if (isset($imageDisplay)) {
            echo $imageDisplay;
            } ?>

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


<?php unset($_SESSION['message']); ?>
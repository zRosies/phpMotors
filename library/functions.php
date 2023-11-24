<?php

function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;

}

function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

function checkVarChar30($clientInput){
    $pattern = "/^[A-Za-z]{3,30}$/";
    return preg_match($pattern, $clientInput);

}

function checkVarChar50($clientInput){
    $pattern = "/^.*\.(jpg|jpeg|png|gif|bmp)$/";
    return preg_match($pattern, $clientInput) && strlen($clientInput) <= 50;

}

function checkInt($intNum){
    $pattern = "/^\d+(\.\d+)?$/";
    return preg_match($pattern, $intNum);
}

function checkVarChar20($clientInput){
    $pattern = "/^[A-Za-z]{3,20}$/";
    return preg_match($pattern, $clientInput);

}


function navigation(){
    $classifications = getClassifications();

    $navList= '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'> Home </a></li>";

    foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName="
    .urlencode($classification['classificationName']).
    "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
        }
    $navList .= '</ul>';

    return $navList;

}

function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id = "classificationId">';
        foreach($classifications as $classification){
            $classificationList .=  "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
            
        } 
    $classificationList .= '</select>';
 return $classificationList; 
}



   function getUserInfo($clientId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM clients WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

function updateUserInfo($clientEmail,$clientFirstname, $clientLastname, $clientId){
    $db = phpmotorsConnect();
    $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientId = :clientId ,clientEmail = :clientEmail WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function updatePassword($clientId, $clientPassword){
    $db = phpmotorsConnect();
    $sql = 'UPDATE clients SET clientPassword = :clientPassword  WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;

}

function getInventoryByClassification($classificationId){ 
    $db = phpmotorsConnect(); 
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
   }
function getInvItemInfo($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    // $sql = 'SELECT * FROM images JOIN inventory ON images.invId = inventory.invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
   }

   function getCarInfo($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT images.imgId, images.invId, images.imgName, images.imgPath, inventory.invMake, inventory.invModel
            FROM images
            JOIN inventory ON images.invId = inventory.invId
            WHERE images.imgPrimary = 0 AND images.invId = :invId'; // Added invId condition
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll instead of fetch
    $stmt->closeCursor();
    return $invInfo;
}


function buildVehiclesDisplay($vehicles){

    $dv = '<div id="inv-display">';
    foreach ($vehicles as $vehicle) {
    $price = formatPrice($vehicle["invPrice"]);
    $dv .= '<section class ="display">';   
     $dv .= '<div>';
     $dv .= "<a href='/phpmotors/vehicles/?action=car&carName=$vehicle[invId]'><img src='/phpmotors$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
     $dv .= '</div>';
     $dv .= '<div class="info">';
     $dv .= "<a href='/phpmotors/vehicles/?action=car&carName=$vehicle[invId]'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
     
     $dv .= "<span>$ $price </span>";
     $dv .= '</div>';    
     $dv .= '</section>';   
    }
    $dv .= '</div>';
    return $dv;


   }

function formatPrice($number) {
    $formattedPrice = number_format($number,2, '.');
    return $formattedPrice;
}
function displayCarInfo($info , $additionalImg){
    $price = formatPrice($info['invPrice']);

    $carInfo = '
    <section class="information">
        <div class="additional-images"> ';
            foreach ($additionalImg as $image) {

                //here I get only with images with final TN
                $imgPath = $image['imgPath'];
                $allowedExtensions = ['png', 'jpeg', 'jpg', 'gif'];
                
                $endsWithTN = false;
                foreach ($allowedExtensions as $extension) {
                    if (substr($imgPath, -7) === "-tn.{$extension}") {
                        $endsWithTN = true;
                        break;
                    }
                }
            
                if ($endsWithTN) {

                    $carInfo .= "<img src='{$imgPath}' alt='Image of {$info['invMake']} {$info['invModel']} on phpmotors.com'>";
                }
            }

            $carInfo .= '
        </div>
        <div class="container">
            <h2>' . $info['invMake'] . ' ' . $info['invModel'] . '</h2>
            <div class="photo">
                <img src="/phpmotors' . $info['invImage'] . '" alt="vehicle thumbnail">
            </div>
            <p>Price: $ ' . $price . '</p> 
            <button>Checkout</button>
        </div>
        <div class="description">
            <h3>' . $info['invMake'] . ' ' . $info['invModel'] . ' Details</h3>
            <p class="desc">' . $info['invDescription'] . '</p>
            <p>In Stock: ' . $info['invStock'] . '</p>
            <p>Color: ' . $info['invColor'] . '</p>
            
        </div>
    </section>';
  
    return $carInfo;
  }


  /* * ********************************
    *  Functions for working with images
    * ********************************* */

    function makeThumbnailName($image) {
        $i = strrpos($image, '.');
        $image_name = substr($image, 0, $i);
        $ext = substr($image, $i);
        $image = $image_name . '-tn' . $ext;
        return $image;
       }

    function buildImageDisplay($imageArray) {
        $id = '<ul id="image-display">';
        foreach ($imageArray as $image) {
         $id .= '<li>';
            $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
            $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
         $id .= '</li>';
       }
        $id .= '</ul>';
        return $id;
       }
       
    function buildVehiclesSelect($vehicles) {
        $prodList = '<select name="invId" id="invId">';
        $prodList .= "<option>Choose a Vehicle</option>";
        foreach ($vehicles as $vehicle) {
         $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
        }
        $prodList .= '</select>';
        return $prodList;
       }

    // Handles the file upload process and returns the path
    // The file path is stored into the database
    function uploadFile($name) {
        // Gets the paths, full and local directory
        global $image_dir, $image_dir_path;
        if (isset($_FILES[$name])) {
        // Gets the actual file name
        $filename = $_FILES[$name]['name'];

        if (empty($filename)) {
        return;
        }
        // Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
        // Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;
        //-------------- Until here is working well --------------------
        move_uploaded_file($source, $target);
        // Send file for further processing
        processImage($target, $filename);
        // Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;
        // Returns the path where the file is stored
        return $filepath;
        }
    }

    function uploadAndUpdateThumbnail($name, $tmpFilePath) {
        global $image_dir, $image_dir_path;
    
        // Check if the temporary file path and file name are not empty
        if (!empty($tmpFilePath) && !empty($name)) {
            $target = $image_dir_path . '/' . $name;
    
            // Move uploaded file to the target path
            if (move_uploaded_file($tmpFilePath, $target)) {
                // Process the uploaded image if necessary
                $thumbnailTarget = processImage($image_dir_path, $name);
    
                if ($thumbnailTarget !== false) {
                    // Sets the path for the image for Database storage
                    $originalPath = $image_dir . '/' . $name;
                    $thumbnailPath = $image_dir . '/' . $thumbnailTarget;
    
                    // Return an associative array with paths to both original and thumbnail images
                    return array('img' => $originalPath, 'img-tn' => $thumbnailPath);
                } else {
                    // Handle image processing error
                    return array('error' => 'Error processing image');
                }
            } else {
                // Handle file upload error
                return array('error' => 'Error uploading file');
            }
        } else {
            // Handle the case where the file or temporary file path is empty
            return array('error' => 'File or temporary file path is empty');
        }
    }
    
    function processImage($dir, $filename) {

        $dir = $dir . '/';
    

        $image_path = $dir . $filename;
    
  
        $isThumbnail = strpos($filename, '-tn.') !== false;
    
        if ($isThumbnail) {
            $thumbnailPath = resizeImage($image_path, 200, 200);
        } else {
            $thumbnailPath = resizeImage($image_path, 500, 500);
        }
    
        return $thumbnailPath;
    }
    
    function resizeImage($old_image_path, $target_width, $target_height) {
        // Get image type
        $image_info = getimagesize($old_image_path);
        $image_type = $image_info[2];
    
        // Set up the function names
        switch ($image_type) {
            case IMAGETYPE_JPEG:
                $image_from_file = 'imagecreatefromjpeg';
                $image_to_file = 'imagejpeg';
                break;
            case IMAGETYPE_GIF:
                $image_from_file = 'imagecreatefromgif';
                $image_to_file = 'imagegif';
                break;
            case IMAGETYPE_PNG:
                $image_from_file = 'imagecreatefrompng';
                $image_to_file = 'imagepng';
                break;
            default:
                return false;
        }
    
        // Get the old image and its height and width
        $old_image = $image_from_file($old_image_path);
        $old_width = imagesx($old_image);
        $old_height = imagesy($old_image);
    
        // Calculate height and width ratios
        $width_ratio = $old_width / $target_width;
        $height_ratio = $old_height / $target_height;
    
        // If image is larger than specified ratio, create the new image
        if ($width_ratio > 1 || $height_ratio > 1) {
            // Calculate height and width for the new image
            $ratio = max($width_ratio, $height_ratio);
            $new_height = round($old_height / $ratio);
            $new_width = round($old_width / $ratio);
    
            // Create the new image
            $new_image = imagecreatetruecolor($new_width, $new_height);
    
            // Set transparency according to image type
            if ($image_type == IMAGETYPE_GIF) {
                $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
                imagecolortransparent($new_image, $alpha);
            }
    
            if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
                imagealphablending($new_image, false);
                imagesavealpha($new_image, true);
            }
    
            // Copy old image to new image - this resizes the image
            $new_x = 0;
            $new_y = 0;
            $old_x = 0;
            $old_y = 0;
            imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
    
            // Generate a new image path with '-tn' appended
            $path_parts = pathinfo($old_image_path);
            $new_image_path = $path_parts['dirname'] . '/' . $path_parts['filename'] . '-tn.' . $path_parts['extension'];
    
            // Write the new image to a new file
            $image_to_file($new_image, $new_image_path);
    
            // Free any memory associated with the new image
            imagedestroy($new_image);
    
            // Return the thumbnail target path
            return $new_image_path;
        } else {
            // Image doesn't need resizing, return the original path
            return $old_image_path;
        }
    
        // Free any memory associated with the old image
        imagedestroy($old_image);
    } 
    
    
    
    
    
    // ends resizeImage function
            
       
       // Processes images by getting paths and 
    // creating smaller versions of the image
    // function processImage($dir, $filename) {
    //     // Set up the variables
    //     $dir = $dir . '/';
    
    //     // Set up the image path
    //     $image_path = $dir . $filename;
    
    //     // Set up the thumbnail image path
    //     $image_path_tn = $dir.makeThumbnailName($filename);
    
    //     // Create a thumbnail image that's a maximum of 200 pixels square
    //     resizeImage($image_path, $image_path_tn, 200, 200);
    
    //     // Resize original to a maximum of 500 pixels square
    //     resizeImage($image_path, $image_path, 500, 500);
    // }


?>


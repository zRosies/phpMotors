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
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
        }
    $navList .= '</ul>';

    return $navList;

}


?>
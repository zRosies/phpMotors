<?php

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../library/functions.php';

$navList = navigation();


$action= filter_input(INPUT_POST,'action');
if($action == NULL){
    $action= filter_input(INPUT_GET, 'action');
}

$currentPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ?? 1;
$itemsPerPage = 10;

switch ($action) {
    case "search":
    
        $searchQuery = filter_input(INPUT_GET, 'searchQuery', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $arrayOfInfo = getSearchInfo($searchQuery, $currentPage, $itemsPerPage);

        $displayInfo = displaySearchInfo($arrayOfInfo, $searchQuery, $itemsPerPage);
        
        include '../view/search.php';
        break;

    default:
        include '../view/search.php';
        break;


}



?>
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

if(isset($_GET["page"])){
    $page = $_GET["page"];
}
else{
    $page = 1;


}


$start_from=($page-1)*1;

switch ($action) {
    case "search":
    
        $searchQuery = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? 1;
        
        $searchQuery = strip_tags($searchQuery);

        
            if(empty($searchQuery) ){
                $message = "<p class='response'> Please provide information for all empty fields. </p> ";
                include '../view/search.php';
                exit; 
            }

            if (preg_match('/[<>;&]/', $searchQuery)) {
                $message = "<p class='response'> Your search query contains invalid characters. </p>";
                include '../view/search.php';
                exit;
            }

      

        
        $arrayOfInfo = getSearchInfo($searchQuery, $page);

        $length  = count($arrayOfInfo);

            if($length < 1){
                $message = "<p class='response'> No results for $searchQuery </p> ";
                include '../view/search.php';
                exit;

            }
        // echo $searchQuery;

        $invInfo = displayNumberOfPages($searchQuery);

        $totalOfRecords = count($invInfo);
            
        $numOfPages = ceil($totalOfRecords/10);

        $currentPage = $page;
        
        $displayInfo = displaySearchInfo($arrayOfInfo, $searchQuery, $totalOfRecords);
        
        include '../view/search.php';
        break;

    default:
        include '../view/search.php';
        break;


}



?>
<?php



function phpmotorsConnect(){

    $server= 'localhost';
    $dbname='phpmotors'; //Put an s in motor so you can see the database connected :D
    $username='iClient';
    $password='6GlT2uSM9I/O8-Sd';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try{
        $link= new PDO($dsn, $username, $password, $options);
        if(is_object($link)){
            // echo('Connected to the database');
        }
        return $link ;
    }
    catch(PDOException $e){
       
        header('Location: /phpmotors/view/500.php');

        exit;

    }

}

phpmotorsConnect();













?>
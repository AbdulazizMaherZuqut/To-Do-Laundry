<?php
    //-------------- DATABASE CONNECTION ------------
    $dsn = 'mysql:host=localhost;dbname=todolaundry';
    $user = 'root';
    $pass = '';
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
    );

    try {
       $db = new PDO($dsn,$user,$pass,$options);
       $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e){
        echo 'Failed' . $e->getMessage();
    }

?>
<?php 
    
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'login_register';

    $db = new PDO("mysql:dbhost={$db_host};dbname={$db_name}",$db_user, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>
<?php
//include $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
try {
    $db = new PDO('mysql:host=HOSTNAME;dbname=DB_NAME', 'USERNAME', 'PASSWORD');
} catch (PDOException $e) {
    echo $e->getmessage();
}

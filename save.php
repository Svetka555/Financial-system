<?php
require_once "index.html";
include $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
class_alias('\RedBeanPHP\R', '\R');
R::setup('mysql:host=localhost;dbname=finance', 'root', 'root');
if (!R::testConnection()) {
    exit('Нет подключения!');
}

$input = $_POST['input'];
$date = $_POST['date'];

$table = R::dispense('one');
$table->money = $input;
$table->date = $date;

R::store($table);
header('Location: /');


R::close();

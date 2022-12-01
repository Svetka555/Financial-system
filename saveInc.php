<?php
require_once "Income.php";
Income::connect();

$input = $_POST['input'];
$date = $_POST['date'];
$category = $_POST['category'];
$id = R::getAll("SELECT id FROM `users` WHERE login='{$_COOKIE['login']}'");
$category = (array_search($_POST['category'], Income::category));

Income::addRecord($input, $date, $category);
header('Location: /income.html');


R::close();

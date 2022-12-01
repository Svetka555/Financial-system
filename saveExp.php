<?php
require_once "Expenses.php";
Expenses::connect();

$input = $_POST['input'];
$date = $_POST['date'];
$category = $_POST['category'];
$id = R::getAll("SELECT id FROM `users` WHERE login='{$_COOKIE['login']}'");
$category = (array_search($_POST['category'], Expenses::category));

Expenses::addRecord($input, $date, $category, $id);
header('Location: /expenses.html');


R::close();

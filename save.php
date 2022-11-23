<?php
require_once "Expenses.php";
Expenses::connect();

$input = $_POST['input'];
$date = $_POST['date'];
$category = $_POST['category'];

$category = (array_search($_POST['category'], Expenses::category));

Expenses::addRecord($input, $date, $category);
header('Location: /');


R::close();

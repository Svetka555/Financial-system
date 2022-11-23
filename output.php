<?php
require_once "Expenses.php";
Expenses::connect();
$category = (array_search($_POST['category'], Expenses::category));
$name_month = (array_search($_POST['month'], Expenses::month));
$expenses1 = Expenses::getRecordsCategory();
$expenses2 = Expenses::getRecordsDate();
$expenses3 = Expenses::getRecordsCategoryDate();
$sum1 = Expenses::sumCategory($expenses1);
$sum2 = Expenses::sumDate($expenses2);
$sum3 = Expenses::sumCategoryDate($expenses3);
$expenses = R::findAll('money');
require_once "index.html";

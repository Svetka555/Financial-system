<?php
require_once "Income.php";
Income::connect();
$categoryIncome = (array_search($_POST['category'], Income::category));
$name_month = (array_search($_POST['month'], Income::month));
$income1 = Income::getRecordsCategory();
$income2 = Income::getRecordsDate();
$income3 = Income::getRecordsCategoryDate();
$sum1 = Income::sumCategory($income1);
$sum2 = Income::sumDate($income2);
$sum3 = Income::sumCategoryDate($income3);
$expenses = R::findAll('money');
require_once "income.html";

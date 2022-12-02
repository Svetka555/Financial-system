<?php
require_once "Expenses.php";
require_once "Income.php";
Expenses::connect();
$name_month = (array_search($_POST['month'], Expenses::month));
$expenses = Expenses::getRecordsDate();
$income = Income::getRecordsDate();
$sumExp = Expenses::getRecordsAll();
$sumInc = Income::getRecordsAll();
$sumAll = Income::sumAll($sumInc) - Expenses::sumAll($sumExp);
$sumMonth = Income::sumDate($income) - Expenses::sumDate($expenses);
require_once "balance.html";

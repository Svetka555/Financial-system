<?php
include $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
class_alias('\RedBeanPHP\R', '\R');
R::setup('mysql:host=localhost;dbname=finance', 'root', 'root', false);
if (!R::testConnection()) {
    exit('Нет подключения!');
}

function search($value, $array)
{
    return (array_search($value, $array));
}
$month = ["Январь" => "1", "Февраль" => "2", "Март" => "3", "Апрель" => "4", "Май" => "5", "Июнь" => "6", "Июль" => "7", "Август" => "8", "Сентябрь" => "9", "Октябрь" => "10", "Ноябрь" => "11", "Декабрь" => "12"];
$name_month = (search($_POST['month'], $month));

$year = date('Y');
$days = cal_days_in_month(CAL_GREGORIAN, $_POST['month'], $year);
$date1 = date("Y-{$_POST['month']}-01");
$date2 = date("Y-{$_POST['month']}-{$days}");

$expenses = R::getAll("SELECT * FROM `one` WHERE date BETWEEN '{$date1}' AND '{$date2}'");
$sum = 0;
foreach ($expenses as $expens) {
    $sum += (int)$expens['money'];
}

require_once "index.html";

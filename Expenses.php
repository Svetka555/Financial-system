<?php
class Expenses
{
    public const month = [
        "Январь" => "1",
        "Февраль" => "2",
        "Март" => "3",
        "Апрель" => "4",
        "Май" => "5",
        "Июнь" => "6",
        "Июль" => "7",
        "Август" => "8",
        "Сентябрь" => "9",
        "Октябрь" => "10",
        "Ноябрь" => "11",
        "Декабрь" => "12"
    ];
    public const category = [
        "Личные расходы" => "personal",
        "Дом" => "house",
        "Здоровье" => "health",
        "Одежда" => "clothes",
        "Питание" => "food",
        "Подарки" => "gifts",
        "Техника" => "technic",
        "Услуги" => "services",
        "Автомобиль" => "car"
    ];
    static function connect()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
        class_alias('\RedBeanPHP\R', '\R');
        R::setup('mysql:host=127.0.0.1;dbname=finance', 'root', 'root');
    }
    static function getRecordsCategory()
    {
        $category = (array_search($_POST['category'], self::category));

        $expenses1 = R::getAll("SELECT * FROM `expenses` WHERE category='{$category}'");
        return $expenses1;
    }
    static function sumCategory($expenses1)
    {
        $sum = 0;
        foreach ($expenses1 as $expens) {
            $sum += (int)$expens['money'];
        }
        return $sum;
    }
    static function getRecordsDate()
    {
        $year = date('Y');
        $days = cal_days_in_month(CAL_GREGORIAN, $_POST['month'], $year);
        $date1 = date("Y-{$_POST['month']}-01");
        $date2 = date("Y-{$_POST['month']}-{$days}");

        $expenses2 = R::getAll("SELECT * FROM `expenses` WHERE date BETWEEN '{$date1}' AND '{$date2}'");
        return $expenses2;
    }
    static function sumDate($expenses2)
    {
        $sum = 0;
        foreach ($expenses2 as $expens) {
            $sum += (int)$expens['money'];
        }
        return $sum;
    }
    static function getRecordsCategoryDate()
    {
        $category = (array_search($_POST['category'], self::category));

        $year = date('Y');
        $days = cal_days_in_month(CAL_GREGORIAN, $_POST['month'], $year);
        $date1 = date("Y-{$_POST['month']}-01");
        $date2 = date("Y-{$_POST['month']}-{$days}");

        $expenses3 = R::getAll("SELECT * FROM `expenses` WHERE date BETWEEN '{$date1}' AND '{$date2}' AND category='{$category}'");
        return $expenses3;
    }
    static function sumCategoryDate($expenses3)
    {
        $sum = 0;
        foreach ($expenses3 as $expens) {
            $sum += (int)$expens['money'];
        }
        return $sum;
    }
    static function addRecord($input, $date, $category)
    {
        $table = R::dispense('expenses');
        $table->money = $input;
        $table->date = $date;
        $table->category = $category;
        R::store($table);
    }
}

<?php
class Income
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
        "Зарплата" => "salary",
        "Премия" => "prize",
        "Пенсия" => "pension",
        "Пособие" => "stipend",
        "Стипендия" => "scholarship",
        "Наследство" => "heritage",
        "Дивиденды" => "dividends",
        "Иное" => "other",
    ];

    static function getRecordsCategory()
    {
        $id = R::getAll("SELECT id FROM `users` WHERE login='{$_COOKIE['login']}'");
        $category = (array_search($_POST['category'], self::category));

        $income1 = R::getAll("SELECT * FROM `income` WHERE category='{$category}' AND idusers = '{$id[0]['id']}'");
        return $income1;
    }
    static function sumCategory($income1)
    {
        $sum = 0;
        foreach ($income1 as $inc) {
            $sum += (int)$inc['money'];
        }
        return $sum;
    }
    static function getRecordsDate()
    {
        $id = R::getAll("SELECT id FROM `users` WHERE login='{$_COOKIE['login']}'");
        $year = date('Y');
        $days = cal_days_in_month(CAL_GREGORIAN, $_POST['month'], $year);
        $date1 = date("Y-{$_POST['month']}-01");
        $date2 = date("Y-{$_POST['month']}-{$days}");

        $income2 = R::getAll("SELECT * FROM `income` WHERE date BETWEEN '{$date1}' AND '{$date2}' AND idusers = '{$id[0]['id']}'");
        return $income2;
    }
    static function sumDate($income2)
    {
        $sum = 0;
        foreach ($income2 as $inc) {
            $sum += (int)$inc['money'];
        }
        return $sum;
    }
    static function getRecordsCategoryDate()
    {
        $id = R::getAll("SELECT id FROM `users` WHERE login='{$_COOKIE['login']}'");
        $category = (array_search($_POST['category'], self::category));

        $year = date('Y');
        $days = cal_days_in_month(CAL_GREGORIAN, $_POST['month'], $year);
        $date1 = date("Y-{$_POST['month']}-01");
        $date2 = date("Y-{$_POST['month']}-{$days}");

        $income3 = R::getAll("SELECT * FROM `income` WHERE date BETWEEN '{$date1}' AND '{$date2}' AND category='{$category}' AND idusers = '{$id[0]['id']}'");
        return $income3;
    }
    static function sumCategoryDate($income3)
    {
        $sum = 0;
        foreach ($income3 as $inc) {
            $sum += (int)$inc['money'];
        }
        return $sum;
    }
    static function getRecordsAll()
    {
        $id = R::getAll("SELECT id FROM `users` WHERE login='{$_COOKIE['login']}'");

        $sum = R::getAll("SELECT * FROM `income` WHERE idusers = '{$id[0]['id']}'");
        return $sum;
    }
    static function sumAll($sum)
    {
        $sumAll = 0;
        foreach ($sum as $su) {
            $sumAll += (int)$su['money'];
        }
        return $sumAll;
    }
    static function addRecord($input, $date, $category)
    {
        $id = R::getAll("SELECT id FROM `users` WHERE login='{$_COOKIE['login']}'");
        $table = R::dispense('income');
        $table->money = $input;
        $table->date = $date;
        $table->category = $category;
        $table->idusers = $id[0]['id'];
        R::store($table);
    }
}

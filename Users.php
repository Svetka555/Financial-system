<?php
class Users
{
    static function connect()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
        class_alias('\RedBeanPHP\R', '\R');
        R::setup('mysql:host=127.0.0.1;dbname=finance', 'root', 'root');
    }

    static function addRecord($login, $email, $password)
    {
        $table = R::dispense('users');
        $table->login = $login;
        $table->email = $email;
        $table->password = $password;

        R::store($table);
    }
    static function User($login, $password)
    {
        $result = R::getAll("SELECT * FROM `users` WHERE login = '$login' AND password = '$password' ");
        $user = $result;
        return $user;
    }
    static function NewUser()
    {
        return R::getAll("SELECT * FROM `users` WHERE login='{$_POST['login']}'") == null;
    }
    static function NewUserEmail()
    {
        return R::getAll("SELECT * FROM `users` WHERE email='{$_POST['email']}'") == null;
    }
}

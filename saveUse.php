<?php
require_once "Users.php";
Users::connect();

$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];


Users::addRecord($login, $email, $password);
header('Location: /');


R::close();

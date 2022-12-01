<?php
require_once "Users.php";
require_once "index2.html";
Users::connect();

$login = filter_var(
    trim($_POST['login']),
    FILTER_SANITIZE_STRING
);
$email = filter_var(
    trim($_POST['email']),
    FILTER_SANITIZE_STRING
);
$password = filter_var(
    trim($_POST['password']),
    FILTER_SANITIZE_STRING
);


if (!Users::NewUser()) {
?> <script>
        alert("Логин занят");
    </script> <?php
                exit();
            }
            if (!Users::NewUserEmail()) {
                ?> <script>
        alert("Почта занята");
    </script> <?php
                exit();
            }
            Users::addRecord($login, $email, $password);

            header('Location: /index.html');

            R::close();

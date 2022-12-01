<?php
require_once "Users.php";
require_once "index.html";
Users::connect();

$login = filter_var(
    trim($_POST['login']),
    FILTER_SANITIZE_STRING
);
$password = filter_var(
    trim($_POST['password']),
    FILTER_SANITIZE_STRING
);



$user = Users::User($login, $password);
if (count($user) == 0) {
?><script>
        alert("Такой пользователь не существует");
    </script> <?php
                exit();
            }

            setcookie('login', $user[0]['login'], time() + 3600);
            header('Location: /expenses.html');

<?php
    session_start();


    if (!function_exists('mysql_init') && !extension_loaded('mysql')) {
        echo 'We don\'t have mysqli!!!';
    } else {
        echo 'Phew we have it!';
    }

    $login = filter_var(trim($_POST['login']));
    $name = filter_var(trim($_POST['name']));
    $password = filter_var(trim($_POST['password']));

    if(strlen($login)< 5 || strlen($login) > 20) {
        echo "Длинна логина не допустима";
        exit();
    }else if(strlen($name) < 3 || strlen($name) > 20) {
        echo "Длинна имени не допустима";
        exit();
    }else if(strlen($password) < 5 || strlen($password) > 50) {
        echo "Длинна пароля не допустима";
        exit();
    }

    $password=md5($password."qwerty");

    $mysql = new mysqli('localhost','root', '', 'pwc');
    $mysql->query("INSERT INTO `user` (`login`, `name`, `password`) 
    VALUES ('$login', '$name', '$password')");

    $mysql->close();

    header('Location: /');

?>
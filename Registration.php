<?php
session_start();
require 'lib.php';

echo template('templates/head.php', [
    'title' => "Регистрация",
]);

ini_set('display_errors', 1);
error_reporting(E_ALL);

$connection = db_plug();

if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
    $sql = $connection->prepare(" SELECT * FROM `users` WHERE `email`=:_email");
    $sql->execute([':_email' => $_POST['email']]);
    if (empty($data = $sql->fetchAll())) {
        $sql = $connection->prepare(" INSERT INTO `users`(`email`,`password`) VALUES (:_email, :_pass)");
        $sql->execute([':_email' => $_POST['email'], ':_pass' => md5($_POST['pass'])]);
        $_SESSION["reg_success"];
        header("Location:http://192.168.100.220/");
    } else {
        echo "Такой email уже зарегистрирован";
    }
}
echo template('templates/tmp_Registration.php', [
    'authorisation' => false,
    'alert'         => false,
]);

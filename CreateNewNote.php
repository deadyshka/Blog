<?php
require 'lib.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo template('templates/head.php', [
    'title' => "Оставить сообщение",
]);

$connection = db_plug();

if (isset($_POST['email']) && isset($_POST['pass']) || isset($_POST['btn_logout'])) {
    authorisation($_POST['email'], $_POST['pass']);
    if (isset($_POST['btn_logout'])) {
        logout();
    }
}

echo template('templates/authorisation.php', [
    'authorisation' => $_SESSION['authorisation'],
    'user'          => $_SESSION['user'],
    'id'            => $_SESSION['id'],
    'alert'         => $_SESSION['wrong_user_alert'],

]);

$connection = db_plug();
if (!empty($_POST['title']) && !empty($_POST['body']) && valid_token($_POST['token'])) {

    $sql = $connection->prepare(
        "INSERT INTO blog_data(`title`,`body`, `autor_id`) VALUES (:_title, :_body, :_id);");
    if ($sql->execute([':_title' => $_POST['title'], ':_body' => $_POST['body'], ':_id' => $_SESSION['id']])) {
        header("Location:http://192.168.100.220/");
    } else
        echo 'ошибка';

}

echo template('templates/tmp_CreateNewNote.php', [
    'authorisation' => $_SESSION['authorisation'],
    'token'         => get_token(),
]);




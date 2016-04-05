<?php
session_start();
require 'lib.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);


$connection = db_plug();
if (isset($_POST['email']) && isset($_POST['pass']))
    authorisation($_POST['email'], $_POST['pass']);

if (isset($_SESSION['authorisation']) && $_SESSION['authorisation']) {

    echo template('templates/head.php', [
        'title' => "Это ваш личный блог! {$_SESSION['user']}",
    ]);

    echo template('templates/authorisation.php', [
        'authorisation' => $_SESSION["authorisation"],
        'user'          => $_SESSION["user"],
        'id'            => $_SESSION["id"],
        'alert'         => $_SESSION["wrong_user_alert"],
    ]);

    if (isset($_POST['btn_logout'])) {
        logout();
    }

    $row = $connection->prepare("SELECT * FROM blog_data WHERE `autor_id`=:_id ORDER BY `id` DESC ");
    $row->execute([':_id' => $_SESSION["id"]]);

    echo template('templates/Blog.php', [
        'authorisation' => $_SESSION["authorisation"],
        'data'          => $row,
    ]);

} else {
    echo template('templates/head.php', [
        'title' => "Стена",
    ]);

    echo template('templates/authorisation.php', [
        'authorisation' => false,
        'user'          => null,
        'id'            => null,
        'alert'         => $_SESSION['wrong_user_alert'],
    ]);


}









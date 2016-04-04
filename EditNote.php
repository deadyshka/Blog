<?php
require 'lib.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo template('templates/head.php', [
    'title' => "Отредактировать новость"
]);

$connection = db_plug();

if (isset($_POST['email']) && isset($_POST['pass']) || isset($_POST['btn_logout'])) {
    authorisation($_POST['email'], $_POST['pass']);
    if (isset($_POST['btn_logout']))
        logout($_POST['btn_logout']);
}

echo template('templates/authorisation.php', [
    'authorisation' => $_SESSION["authorisation"],
    'user' => $_SESSION["user"],
    'id' => $_SESSION["id"],
    'alert' => $_SESSION["wrong_user_alert"],

]);

$connection = db_plug();
if (!empty($_POST['btn_edit_note']) && !empty($_POST['note_id'])) {

    $sql = $connection->prepare(
        "SELECT `title`, `body` FROM blog_data WHERE `id`=:_id");
    if ($sql->execute([':_id' => $_POST['note_id']])) {
        $data = $sql->fetch();
        echo template('templates/tmp_EditNote.php', [
            'authorisation' => $_SESSION['authorisation'],
            'title' => $data['title'],
            'body' => $data['body'],
            'note_id' =>$_POST['note_id'],
            'token' => get_token()
        ]);
    } else
        echo 'ошибка';
}

if (!empty($_POST['Edit']) && !empty($_POST['note_id']) && !empty($_POST['token']) &&($_SESSION['token'] == $_POST['token'])) {
    var_dump($_POST['note_id']);
    $sql = $connection->prepare(
        "UPDATE blog_data SET `title`=:_title, `body`=:_body, `updated`= NOW() WHERE `id`=:_id;");
    if ($sql->execute([':_title' => $_POST['title'],
        ':_body' => $_POST['body'],
        ':_id' => $_POST['note_id']])
    ) {
        header("Location:http://192.168.100.220/");
    }
}

if (!empty($_POST['Delete']) && !empty($_POST['note_id']) && $_SESSION['token'] == $_POST['token']) {
    $sql = $connection->prepare(
        "UPDATE blog_data  SET `deleted`=TRUE WHERE `id`=:_id;");
    if ($sql->execute([':_id' => $_POST['note_id']])) {
        header("Location:http://192.168.100.220/");
    }

}



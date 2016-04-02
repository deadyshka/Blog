<?php
require 'lib.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
$connection = db_plug();

if(!empty($_POST['email']) && !empty($_POST['pass']))
{
autorisation($_POST['email'],$_POST['pass'],$_POST['btn_logout']);
}

if (!empty($_POST['btn_logout']))
{
    logout($_POST['btn_logout']);
}
echo template('templates/autorisation.php', [
    'autorisation' => $_SESSION["autorisation"],
    'user' => $_SESSION["user"],
    'id' => $_SESSION["id"],
    'alert' => $_SESSION["wrong_user_alert"],

]);

$row = $connection->prepare("SELECT `title`, `body`, `created` FROM blog_data WHERE `autor_id`=:_id ORDER BY `id` DESC ");
$row->execute([':_id'=>$_SESSION["id"]]);

echo template('templates/Blog.php', [
    'data'=>$row
])
?>





<?php

$pdo =new PDO("mysql:host=localhost;dbname=blog_data;charset=utf8","root","vagrant");
$statement =$pdo->query("select title from messages");
/*do
{
$row = $statement->fetch(PDO::FETCH_ASSOC);
echo htmlentities($row["title"]).PHP_EOL;
}
while ($row!=false);
*/
$row = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($row as $item=>$value)
{
    echo htmlentities($item.' ');
    echo htmlentities($value['title']).PHP_EOL;
}





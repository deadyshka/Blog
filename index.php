<?php

while (true)
{
    $date = date('d-m-y');
    $res = file_get_contents("./blog/{$date}.dat");
    $glob =  glob('./blog/*.dat');
    foreach ($glob as $item=>$value)
    {
    $handler = fopen("$value", 'r');
        echo "Открыт файл:{$value}: ".PHP_EOL;
    while (($str = fgets($handler))!==false)
    {
        echo $str;
    }
    fclose($handler);
    }
    //echo 'Введите запись в блог или введите \"exit\" чтобы выйти:';
    $str = readline();
    $date_note = date('h:i:s');
    $res = 'Время: '.$date_note.' Сообщение: '.$str; //+ ' ' + $date_note
    if ($str=='exit')
        break;
    file_put_contents("./blog/{$date}.dat",$res.PHP_EOL, FILE_APPEND);
}


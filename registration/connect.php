<?php
$link=mysqli_connect('localhost','root','','Site');
mysqli_query($link, "SET NAMES 'utf8'");

if (mysqli_connect_errno())//проверка на соединение
{
printf("Попытка соединения не удалась: %s\n", mysqli_connect_error());
exit();
}

?>
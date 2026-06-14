<?php

$host='localhost';
$user= 'root';
$password='';
$db_name='evidenca_knjig';

$link = mysqli_connect($host, $user, $password)
        or die("Povezava s strežnikom ni uspela");

mysqli_select_db($link, $db_name)
        or die("Povezava s podatkovno bazo ni uspela");

mysqli_set_charset($link, "utf8mb4");
require_once 'funkcije.php';
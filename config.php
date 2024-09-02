<?php
$host = "localhost";
$login = "root";
$pass = "";
$db_name = "feedbackform";

$link = mysqli_connect($host, $login, $pass, $db_name) or die(mysqli_error($link));
mysqli_query($link, "SET NAMES utf8");
?>
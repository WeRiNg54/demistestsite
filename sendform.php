<?php
include "config.php";
$isSuccess = false;
$name = $adress = $phone = $email = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $adress = $_POST['adress'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];


    $arErrors = [];
    if (!$name) $arErrors[] = 'name';
    if (!$adress) $arErrors[] = 'adress';
    if (!$phone) $arErrors[] = 'phone';
    if (!$email) $arErrors[] = 'email';

    if (empty($arErrors)) {
        $query = ("INSERT INTO dataform (name, adress, phone, email) VALUES ('" . $name . "','" . $adress . "','" . $phone . "','" . $email . "')");
        mysqli_query($link, $query) or die(mysqli_error($link));
        $isSuccess = true;
        $name = $adress = $phone = $email = "";
    }
}

$result = mysqli_query($link, "SELECT * FROM dataform");
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
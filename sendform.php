<?php
include "config.php";
$isSuccess = false;
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

    if (!$arErrors) {
        $query = ("INSERT INTO dataform (name, adress, phone, email) VALUES ('" . $name . "','" . $adress . "','" . $phone . "','" . $email . "')");
        mysqli_query($link, $query) or die(mysqli_error($link));
        $isSuccess = true;
        $arOptions = [];
        $name = $adress = $phone = $email = "";
        unset($_POST);
    }
}

$result = mysqli_query($link, "SELECT * FROM dataform");
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
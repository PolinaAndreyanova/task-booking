<?php
include("functions.php");

define("CSV_FILE", "dates.csv");

$arNewDates = PostDataHandler();

$arDates = readCSV(CSV_FILE);

$res = AddDates($arNewDates, $arDates);

if ($res) {
    writeCSV(CSV_FILE);
    $feedbsck = "Данную дату или период можно добавить в массив для нового бронирования";
} else {
    $feedbsck = "Данную дату или период нельзя добавить в массив для нового бронирования";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Статус бронирования</title>
    <style>
        input {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <p><?=$feedbsck?></p>
    <form action="index.php" method="post">
        <input type="submit" value="На главную!" />
    </form>
</body>
</html>
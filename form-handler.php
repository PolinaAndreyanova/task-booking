<?php
include_once("functions.php");

define("DATABASE", "dates.csv");

$arNewDates = PostDataHandler();

$res = true;

$streamDb = fopen(DATABASE, "rt") or Die("Ошибка!");

for ($i = 0; $value = ReadDate($streamDb); $i++) {
    $isAdd = IsAddDates($arNewDates, $value);

    if (!$isAdd) {
        $res = false;

        break;
    }
}

fclose($streamDb);

if ($res) {
    $streamDb = fopen(DATABASE, "a") or Die("Ошибка!");

    WriteDate($streamDb);

    fclose($streamDb);  

    $feedback = "Данную дату или период можно добавить в массив для нового бронирования";
} else {
    $feedback = "Данную дату или период нельзя добавить в массив для нового бронирования";
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
    <p><?=$feedback?></p>
    <form action="index.php" method="post">
        <input type="submit" value="На главную!" />
    </form>
</body>
</html>
<?php
include_once("functions.php");

define("DATABASE", "dates.csv");

$arAllDates = [];

$arNewDates = PostDataHandler();

$res = true;

$streamDb = fopen(DATABASE, "rat") or Die("Ошибка!");

for ($i = 0; $value = ReadDate($streamDb); $i++) {
    $arAllDates[] = PostDataHandlerBack($value);
    $isAdd = IsAddDates($arNewDates, $value);

    if (!$isAdd) {
        $res = false;

        break;
    }
}

fclose($streamDb);

if ($res) {
    $streamDb = fopen(DATABASE, "a") or Die("Ошибка!");

    $arAllDates[] = WriteDate($streamDb);

    fclose($streamDb);  

    $feedback = "Данную дату или период можно добавить в массив для нового бронирования";
} else {
    $feedback = "Данную дату или период нельзя добавить в массив для нового бронирования";
}

echo '<table border="1" cellpadding="0" cellspacing="0" width="100%">';

for ($j = 0; $j < count($arAllDates); $j++) {
    echo "<tr>";

    echo '<td align="center" valign="middle" width="50%">' . $arAllDates[$j][0] . "</td>";

    if (count($arAllDates[$j]) == 2) {
        echo '<td align="center" valign="middle" width="50%">' . $arAllDates[$j][1] . "</td>";
    } else {
        echo '<td align="center" valign="middle" width="50%"></td>';
    }
    
    echo "</tr>";
}

echo "</table>";
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
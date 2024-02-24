<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Форма бронирования</title>
    <style>
        input {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <form action="form-handler.php" method="post">
        Дата заезда: <input type="date" name="dateStart" value="" required /><br>
        Дата выезда: <input type="date" name="dateEnd" value="" /><br>
        <input type="submit" value="Забронировать!" />
    </form>
</body>
</html>
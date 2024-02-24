<?php
function DatePeriodConverter($arDatePeriod) {
    return [strtotime($arDatePeriod[0]), strtotime($arDatePeriod[1])];
}

function PostDataHandler() {
    $dateStart = $_POST["dateStart"];
    $dateEnd = $_POST["dateEnd"];

    if (!$dateEnd) {
        $dateEnd = $dateStart;
    }

    return [$dateStart, $dateEnd];
}

function readCSV($file) {
    $arDates = [];

    $fDates = fopen($file, "rt") or Die("Ошибка!");

    for ($i = 0; $arData = fgetcsv($fDates, 100); $i++) {
        if (count($arData) == 1) {
            $arDates[] = [$arData[0], $arData[0]];
        } else {
            $arDates[] = $arData;
        }
    }

    fclose($fDates);

    return $arDates;
}

function writeCSV($file) {
    $arDates = PostDataHandler();

    if ($arDates[0] === $arDates[1]) {
        unset($arDates[1]);
    }

    $fDates = fopen($file, "a") or Die("Ошибка!");

    fputcsv($fDates, $arDates);

    fclose($fDates);
}

function AddDates($new, $dates) {
    $isAdd = true;

    [$newDateStart, $newDateEnd] = DatePeriodConverter($new);

    foreach ($dates as $value) {
        [$bookedStart, $bookedEnd] = DatePeriodConverter($value);

        if (($newDateStart <= $bookedEnd) && ($newDateEnd >= $bookedStart)) {
            $isAdd = false;
            break;
        }
    }
    return $isAdd;
}
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

function PostDataHandlerBack($arPostData) {
    if ($arPostData[0] === $arPostData[1]) {
        unset($arPostData[1]);
    }

    return $arPostData;
}

function ReadDate($fDates) {
    $arDates = [];

    $arData = fgetcsv($fDates, 100);

    if ($arData){
        if (count($arData) == 1) {
            $arDates = [$arData[0], $arData[0]];
        } else {
            $arDates = $arData;
        }
    }

    return $arDates;
}

function WriteDate($fDates) {
    $arDates = PostDataHandlerBack(PostDataHandler());

    fputcsv($fDates, $arDates);
}

function IsAddDates($new, $dates) { // 
    $isAdd = true;

    [$newDateStart, $newDateEnd] = DatePeriodConverter($new);

    [$bookedStart, $bookedEnd] = DatePeriodConverter($dates);

    if (($newDateStart <= $bookedEnd) && ($newDateEnd >= $bookedStart)) {
        $isAdd = false;
    }

    return $isAdd;
}
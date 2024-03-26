<?php
function DatePeriodConverter(array $arDatePeriod): array 
{
    return [strtotime($arDatePeriod[0]), strtotime($arDatePeriod[1])];
}

function PostDataHandler(): array 
{
    $dateStart = $_POST["dateStart"];
    $dateEnd = $_POST["dateEnd"];

    if (!$dateEnd) {
        $dateEnd = $dateStart;
    }

    return [$dateStart, $dateEnd];
}

function PostDataHandlerBack(array $arPostData): array 
{
    if ($arPostData[0] === $arPostData[1]) {
        unset($arPostData[1]);
    }

    return $arPostData;
}

function ReadDate(mixed $fDates): array 
{
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

function WriteDate(mixed $fDates): void 
{
    $arDates = PostDataHandlerBack(PostDataHandler());

    fputcsv($fDates, $arDates);

    return;
}

function IsAddDates(array $new, array $dates): bool 
{ 
    $isAdd = true;

    [$newDateStart, $newDateEnd] = DatePeriodConverter($new);
    [$bookedStart, $bookedEnd] = DatePeriodConverter($dates);

    if (($newDateStart <= $bookedEnd) && ($newDateEnd >= $bookedStart)) {
        $isAdd = false;
    }

    return $isAdd;
}
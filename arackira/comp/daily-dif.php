<?php
function differenceDays($date1, $date2)
{
    $datetime1 = new DateTime($date1);
    $datetime2 = new DateTime($date2);

    $interval = $datetime1->diff($datetime2);

    return $interval->days;
}

<?php

function getWeekday($date) {
    $days = array('Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư','Thứ năm','Thứ sáu', 'Thứ bảy');
    $day = date('w', strtotime($date));
    return $days[$day];
}


function isCurrent($date) {
    $current = strtotime(date("Y-m-d"));
    $date    = strtotime($date);

    $datediff = $date - $current;
    $difference = floor($datediff/(60*60*24));
    return $difference == 0 ? true : false;
}

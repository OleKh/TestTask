<?php
function getDistance($lat1, $lon1, $lat2, $lon2) {
    $lat1 *= M_PI / 180;
    $lat2 *= M_PI / 180;
    $lon1 *= M_PI / 180;
    $lon2 *= M_PI / 180;

    $d_lon = $lon1 - $lon2;

    $slat1 = sin($lat1);
    $slat2 = sin($lat2);
    $clat1 = cos($lat1);
    $clat2 = cos($lat2);
    $sdelt = sin($d_lon);
    $cdelt = cos($d_lon);

    $y = pow($clat2 * $sdelt, 2) + pow($clat1 * $slat2 - $slat1 * $clat2 * $cdelt, 2);
    $x = $slat1 * $slat2 + $clat1 * $clat2 * $cdelt;

    return atan2(sqrt($y), $x) * 6372795;
}

function isAlmostPalindrome($w){
    for($i = 0, $l = strlen($w)-1, $il = ceil($l/2); $i < $il; ++$i)
        if($w[$i] != $w[$l-$i])
            return false;
    return true;
}
$array = [1, 12, 55, 87, 88, 99, 55, 22, 33];
mostPopularNumbber($array);
function mostPopularNumbber($array, $lenth = 0) {
    $result = array_count_values($array);
    $repeat = [];
    foreach ($result  as $number=>$repeated) {
        if($repeat > 1) {
            $repeat[$number] =  $repeated;
        }
    }
    arsort($repeat);
    $number = key($repeat);
    $times = array_shift($repeat);
    return $number . " appears " . $times. " times \n";
}

<?php
$meetings = "1630 2030
1600 1630
1000 1030
1530 2100";

verify_meeting_time($meetings);

function verify_meeting_time($meetings)
{
    $arr = explode("\n", $meetings);

    $meetingsCollection = [];
    foreach ($arr as $value) {
        $temp_arr = explode(" ", $value);
        $meetingsCollection[] = $temp_arr[0];
        $meetingsCollection[] = $temp_arr[1];
    }

    foreach (array_unique($meetingsCollection) as $uTime) {
        $temp = [];
        foreach ($meetingsCollection as $number=>$time) {
            if($uTime == $time) {
                $temp[] = $number;
                if(count($temp) > 1)
                echo "A meeting number " . ( $temp[0]  + 1) . " at " . $time . " intersect with  a meeting number " . ( $number + 1) ." <br/>";
            }
        }
    }
}


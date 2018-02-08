<?php
$monday=strtotime("Monday last week"); // get the date of monday last week
$mondayformat=date("D,d M Y",$monday); // format $monday into D, d M Y
$friday=strtotime("Friday last week"); // get the date of friday last week
$fridayformat=date("D,d M Y",$friday); // format $monday into D, d M Y
$dataperpage=12; // determine the amound of records displayed per page
$deadline=date("D,d M Y",strtotime("this Friday")); // change the format of Friday


?>
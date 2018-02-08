<?php
include("teacher_session.php"); // link this page to teacher_session.php 
include("connection.php");
$date=$_POST["date"];
$count=$_POST["count"]; //get the no of records from the previous page
for($i=0;$i<$count;$i++)
{
	$id[$i]=$_POST["studid$i"]; //get all the students id values from letters.php
	$status[$i]=$_POST["status$i"];	//get all the letters status from letters.php
	if(isset($status[$i]))
	{
		mysql_query("UPDATE absent_letter SET letters_given='1' WHERE student_id='$id[$i]' AND date='$date' ");
	}
	else
	{
		mysql_query("UPDATE absent_letter SET letters_given='0' WHERE student_id='$id[$i]' AND date='$date' ");	
	}
}

header("location:sortsuccessful.php");
?>

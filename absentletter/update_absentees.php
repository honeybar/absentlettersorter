<?php

$con=mysql_connect("localhost","root",""); // connect to database

$check=mysql_query("SELECT attendance_student_tbl.Student_ID AS Student_ID, attendance_student_tbl.date AS date
		FROM attendancedb.attendance_student_tbl
		LEFT JOIN absent_letter_sorter.absent_letter ON absent_letter.date = attendance_student_tbl.date
		AND absent_letter.Student_ID = attendance_student_tbl.Student_ID
		WHERE absent_letter.Student_ID IS NULL 
		AND attendance_student_tbl.status =  'a' "); //check if there are new absentees added to the table.
		
$check2=mysql_query("SELECT absent_letter . * FROM absent_letter_sorter.absent_letter
					LEFT JOIN (SELECT attendance_student_tbl.Student_ID AS Student_ID, attendance_student_tbl.date AS date
					FROM attendancedb.attendance_student_tbl
					WHERE attendance_student_tbl.status =  'a') AS absentees 
					ON absentees.date = absent_letter.date
					AND absentees.Student_ID = absent_letter.Student_ID
					WHERE absentees.Student_ID IS NULL "); //check if there are any changes to the absenttees  to the attendance_student_tbl

if(mysql_num_rows($check)>0) // in case of added new absentees...
{
	
	while($new_absentees=mysql_fetch_array($check))
	{
		mysql_query("INSERT INTO absent_letter_sorter.absent_letter(Student_ID, date) VALUES ('$new_absentees[Student_ID]', 
		 			'$new_absentees[date]')"); // insert new absentees to absent_letter	
	}
}

if(mysql_num_rows($check2)>0) // in case of absentees  are instead latecomers...
{
	while($del_absentees=mysql_fetch_array($check2))
	{
		mysql_query("DELETE FROM absent_letter_sorter.absent_letter WHERE absent_letter.Student_ID='$del_absentees[Student_ID]' AND 
		absent_letter.date='$del_absentees[date]'");
	}
}
?>
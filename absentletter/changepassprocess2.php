<?php
		include("teacher_session.php"); // link this page to teacher_session.php
		include("connection.php"); // link connection.php to this page
		
		$newpass=$_POST["newpass"]; // obtain newpass from changepass2.php
		$newpass2=$_POST["newpass2"]; // obtain newpass2 from changepass2.php
		$oldpass=$_POST["oldpass"]; // obtain oldpass from changepass2.php
		
		if(empty($_POST["newpass"]) OR empty($_POST["newpass2"]) OR empty($_POST["oldpass"]))
		// in case of one of the fields empty ...
		{
			header("location:changepass2error.php");	// direct to changepass2error.php
		}
		else
		{
			$search=mysql_query("SELECT teacherstbl.Username AS username, teacherstbl.Password AS password  FROM school_db.teacherstbl WHERE 
			username='$uname' AND  password='$oldpass'"); // check if the user enter the correct old password
	
			if(mysql_num_rows($search)<1) // if no such record found
			{
				header("location:changepass2error2.php");	// direct to changepass2error2.php
			}
			else
			{
				if($newpass===$newpass2) // check if the new passwords are exactly the same
				{
					
					mysql_query("UPDATE school_db.teacherstbl SET Password='$newpass' 
					WHERE Teacher_ID='$id'"); // update the database with new password
					
					header("location:changepasssuccess2.php");	//direct to changepasssuccess2.php
				}
				else // in case the new passwords are not exactly the same...
				{
					header("location:changepass2error3.php"); // direct to changepass2error3.php
				}
		}
}
?>
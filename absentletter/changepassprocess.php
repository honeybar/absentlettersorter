<?php
		include("discpline_session.php"); // link this page to discpline_session.php
		include("connection.php"); // link connection.php to this page
		
		$newpass=$_POST["newpass"]; // obtain newpass from changepass.php
		$newpass2=$_POST["newpass2"]; // obtain newpass2 from changepass.php
		$oldpass=$_POST["oldpass"]; // obtain oldpass from changepass.php
		
		if(empty($_POST["newpass"]) OR empty($_POST["newpass2"]) OR empty($_POST["oldpass"]))
		// in case of one of the fields empty ...
		{
			header("location:changepasserror.php");	// direct to changepasserror.php
		}
		else
		{
			$search=mysql_query("SELECT Username FROM admin_tbl WHERE Username='$uname' AND 
					 Password='$oldpass'"); // check if the user enter the correct old password
	
			if(mysql_num_rows($search)<1) // if no such record found
			{
				header("location:changepasserror2.php");	// direct to changepasserror2.php
			}
			else
			{
				if($newpass===$newpass2) // check if the new passwords are exactly the same
				{
					
					mysql_query("UPDATE admin_tbl SET Password='$newpass' 
					WHERE User_ID='$id'"); // update the database with new password
					
					header("location:changepasssuccess.php");	//direct to changepasssuccess.php
				}
				else // in case the new passwords are not exactly the same...
				{
					header("location:changepasserror3.php"); // direct to changepasserror3.php
				}
		}
}
?>
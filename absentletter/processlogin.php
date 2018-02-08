<?php
$con=mysql_connect("localhost","root",""); // connect to database
mysql_select_db("school_db",$con); // select school_db database
$uname=$_POST["uname"]; // get username from login.php
$pword=$_POST["pword"]; // get password from login.php

$authentication=mysql_query("SELECT teacherstbl.Username AS Username, teacherstbl.Password AS Password, classtbl.Class_ID AS Class_ID, teacherstbl.Teacher_Name AS Teacher_Name  FROM teacherstbl, classtbl WHERE Username='$uname' AND Password='$pword' AND teacherstbl.Teacher_ID=classtbl.Teacher_ID"); //search in database for the username and password

mysql_select_db("absent_letter_sorter",$con); // select absent_letter_sorter database

$authentication2=mysql_query("SELECT * FROM admin_tbl WHERE Username='$uname' AND Password='$pword'"); //search in database for the username and password

if(mysql_num_rows($authentication)<1 && mysql_num_rows($authentication2)<1) // in case no such username and password found...
	{
		header("location:loginfail.php"); // direct to loginfail.php
	}
	else
	{
		if(mysql_num_rows($authentication)>0) //in case the username and password found in teacherstbl
		{
			while($user_data = mysql_fetch_array($authentication)) // fetch user data from database
			{
				$name = $user_data["Teacher_Name"]; // teacher's name
				$id = $user_data["Teacher_ID"]; // teacher's id
				$classid=$user_data["Class_ID"]; // class id
			}
			/* start the session with the username */
			session_start();
			$_SESSION['userid']=$id;
			$_SESSION['name']=$name;
			$_SESSION['uname']=$uname;
			$_SESSION['classid']=$classid;
			$_SESSION['usertype']="Teacher";
			
			header("location:mainpage2.php"); // direct the user to mainpage.php
		}
		else
		{
			if($authentication2>0)
			{
				while($user_data = mysql_fetch_array($authentication2)) // fetch user data from database
				{
					$name = $user_data["Name"]; // admin's name
					$id = $user_data["User_ID"]; // admin's id
					$uname=$user_data["Username"]; // admin's username
				}
				
				/* start the session with the username */
				
				session_start();
				$_SESSION['userid']=$id; 
				$_SESSION['name']=$name;
				$_SESSION['uname']=$uname;
				$_SESSION['usertype']="discp";
				
				header("location:mainpage.php"); // direct to mainpage.php
			}
	}
		
			
		}
?>
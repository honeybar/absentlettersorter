<?php
session_start();
/* check if the user has logged in */
if (!isset($_SESSION['uname'])) // in case the user has not log in
{
	header('location:loginfirst.php'); // direct to loginfirst.php
}
else
{		/*** teacher's session info ***/
		$id=$_SESSION['userid']; // teacher's id
		$name=$_SESSION['name']; // teacher's name
		$uname=$_SESSION['uname']; // teacher's username
		$type=$_SESSION['usertype']; // teacher's usertype
		
		if($type<>"discp") // in case of the user is not the discpline master
		{
			header("location:noaccess.php");	// direct to mainpage2.php
		}
}
?>
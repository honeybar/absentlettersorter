<?php
include("teacher_session.php");		
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 	
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>change password</title>
    <link href="stylesheet.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body>
    <center><div class="content">
    <div class="top" align="right">
      <p>Today's Date: <?php echo(date("D,d M Y")); ?><br />
      </p>
      
      <!-- build menu -->
      <table width="660" border="0" >
      <tr>
            <td width="74" align="center"><a href="mainpage2.php">Home</a></td>
            <td width="112" align="center"><a href="sort.php">Sorting Letters</a></td>
            <td width="130" align="center"><a href="missing2.php">Missing Letters</a></td>
            <td width="146" align="center"><p>Change Password</p></td>
            <td width="86" align="center"><a href="FAQ.php">FAQ</a></td>
           <td width="86" align="center"><a href="logout.php">Log Out</a></td>
          </tr>
    </table>
    <!-- end menu -->
      
      </div>
      <h1 align="center">&nbsp; </h1>
      <h1 align="center">&nbsp;</h1>
      <center>
      <div class="layering">
      <h1 align="center"><br />Change Password:</h1>
      <!-- constructing form -->
      <form action="changepassprocess2.php" method="POST">
        <table width="100%" border="0">
        <tr>
          <td align="right"><p>New Password:</p></td>
          <!-- below is the text box for password input -->
          <td><input type="password" name="newpass" /></td>
        </tr>
        <tr>
          <td align="right"><p>Confirm new password:</p></td>
          <!-- below is the text box for password input -->
          <td><input type="password" name="newpass2" /></td>
        </tr>
        <tr><!-- below is the text box for password input -->
          <td align="right"><p>Old password:</p></td>
          <td><input type="password" name="oldpass" /></td>
        </tr>
      </table>
      
      <p>&nbsp;</p>
      <!-- below is the submit button -->
      <p><input type="image" onclick="submit()" src="submitbutton.png" /></p></form>
      <!-- end of form -->
      </div></center>
    <p>&nbsp;</p>
    <h3>New passwords don't match!</h3>
      <p align="center">&nbsp;</p>
      <p align="center">&nbsp;</p>
    </div>
    </center>
    <center><div class="bottom"></div></center>
    </body>
    </html>

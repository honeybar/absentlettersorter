<?php
include("discpline_session.php");	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>report</title>
<!-- attch stylesheet.css to this page -->
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
</head>

<body>
<center><div class="content">
<div class="top" align="right">
  <p>Today's Date: <?php echo(date("D,d M Y")); // output today's date?><br />
  </p>
  <!-- building the menu -->
  <table width="774" border="0" >
    <tr>
      <td width="82" align="center"><a href="mainpage.php">Home</a></td>
      <td width="151" align="center"><a href="missing.php">Missing Letters</a></td>
      <td width="91" align="center"><p>Report</p></td>
      <td width="184" align="center"><a href="changepass.php">Change Password</a></td>
      <td width="120" align="center"><a href="FAQ.php">FAQ</a></td>
      <td width="120" align="center"><a href="logout.php">Log Out</a></td>
    </tr>
</table>
<!-- end menu -->
</div>

	<h1 align="center">&nbsp;</h1>
	<p align="center">&nbsp;</p>
  	<h1 align="center">Select Report:</h1>
  
  	<div class="list">
  	<a href="daily.php" class="link"><br />Daily Report of Absentees and Late Comers</a>
  	</div><br />
  
  	<div class="list"><br />
  	<a href="weekly.php" class="link">Weekly Report of Missing Letters and Absentees</a>
  	</div>
  
	<p align="center">&nbsp;</p>
  	<p align="center">&nbsp;</p>
</div>
</center>
<center><div class="bottom"></div></center>
</body>
</html>

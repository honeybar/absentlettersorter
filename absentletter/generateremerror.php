<?php
include("discpline_session.php");// include displine_session.php
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home </title>
<!-- link the page to stylesheet.css -->
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
</head>

<body>
<center><div class="content">
<div class="top" align="right">
  <p>Today's Date: <?php echo(date("D,d M Y")); // output today's date ?><br />
  </p>
  <!-- building the menu -->
  <table width="774" border="0" >
    <tr>
      <td width="82" align="center"><a href="mainpage.php">Home</a></td>
      <td width="151" align="center"><p>Missing Letters</p></td>
      <td width="91" align="center"><a href="report.php">Report</a></td>
      <td width="184" align="center"><a href="changepass.php">Change Password</a></td>
      <td width="120" align="center"><a href="FAQ.php">FAQ</a></td>
      <td width="120" align="center"><a href="logout.php">Log Out</a></td>
    </tr>
</table>
<!-- end menu -->
</div>

	<h1 align="center">&nbsp;</h1>
  	<p align="center">&nbsp;</p>
  	<p align="center">&nbsp;</p>
    <center>
      <div class="layering">
  	<h1 align="center"> <br />Missing Absent Letters  	</h1>
  	<p align="center"><a href="lastweek.php">
  	  Click here to generate last week's missing absent letter</a></p>
  	<p align="center">OR  	</p>
  	<p align="center">Select Date:  	</p>
  	<form action="generaterem.php" method="GET">
    
      <p>
          <input type="date" name="date1" placeholder="select a date..."/>
          <!-- this is the textbox for date input -->
          <span class="table">to</span>
          <input type="date" name="date2" placeholder="select a date..." />
      </p>
        <p><!-- below is the submitbutton -->
          <input type="image" onclick="submit();" src="submitbutton.png" />
        </p>
        <p>( interval between 2 dates must not be greater than 5 days.) </p>
    </form>
    </div>
     <h3>Please input both dates!<br />
  </h3>
    </center>
    <!-- end of construction -->
    
  </div>
</center>
<center><div class="bottom"></div></center>
</body>
</html>

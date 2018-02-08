<?php
include("discpline_session.php");
?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>weekly report</title>
        <!-- attach stylesheet.css to this page -->
        <link href="stylesheet.css" rel="stylesheet" type="text/css" />
        </head>
        
        <body>
        <center><div class="content">
        <div class="top" align="right">
          <p>Today's Date: <?php echo(date("D,d M Y")); // output today's date ?></p>
        <!-- building the menu -->
	  <table width="774" border="0" >
	    <tr>
	      <td width="82" align="center"><a href="mainpage.php">Home</a></td>
	      <td width="151" align="center"><a href="missing.php">Missing Letters</a></td>
	      <td width="91" align="center"><a href="report.php">Report</a></td>
	      <td width="184" align="center"><a href="changepass.php">Change Password</a></td>
	      <td width="120" align="center"><a href="FAQ.php">FAQ</a></td>
	      <td width="120" align="center"><a href="logout.php">Log Out</a></td>
	    </tr>
	</table>
        </div>
        <br />
        <br />
        <br />
        <br />
        <center>
          <div class="layering">
           <br /> <h1 align="center">Weekly Report of Missing Letters and Absentees</h1>
          <p align="center"><a href="lastweekrep.php">Click here to generate last week's report</a></p>
          <p align="center">OR</p>
          <p align="center">Select Date:</p>
          
          <!-- set up form page to be sent to generateweekrep.php --> 
          <form action="generateweekrep.php" method="GET">
          <!-- This is textbox for date -->
          <p><input type="date" name="date1"  placeholder="select a date"/>
          to 
            <!-- This is textbox for date -->
            <input type="date" name="date2" placeholder="select a date"/>
          </p>

          <!-- below is the submitbutton -->
          <input type="image" onclick="submit();" src="submitbutton.png" /></form>
          <!-- end the form page -->
	
          </div>
	<h3><br />
    	The interval between 2 dates must not be greater than 5 days.</h3>
	</center>
          </div>
        </center>
        <center><div class="bottom"></div></center>
        </body>
        </html>


<?php
	include("discpline_session.php"); // link this page to discpline_session.php
	include("connection.php"); // link this page to connection.php
?>

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>daily report </title>
        <link href="stylesheet.css" rel="stylesheet" type="text/css" />
        </head>
        
        <body>
        <center><div class="content">
        <div class="top" align="right">
          <p>Today's Date: <?php echo(date("D,d M Y")); ?></p><br />
          <!--building menu -->
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
        <!-- end menu -->
        </div>
        <br />
        <br />
        <br />
	  <center>
	    <div class="layering">
	      <h1 align="center">&nbsp;</h1>
	      <h1 align="center">Daily Report of Absentees and Late Comers</h1>
<p align="center"><a href="todayrep.php">Click here to generate today's list</a></p>
      <p align="center">OR</p>
      <p align="center">Select Date:      </p>
      <form action="generatedailyrep.php" method="GET">
        <input type="date" name="date" /><!-- this is the text box for inputting date -->
      </p>
      <!-- this is the submit button -->
      <p align="center"><input type="image" onclick="submit();" src="submitbutton.png" />
      </form></p>
     </div></center>
    </div>
    </center>
    <center><div class="bottom"></div></center>
    </body>
    </html>

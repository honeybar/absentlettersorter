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
		
		if($type=="discp") // in case of the user is  the discpline master
		{ // load the user guide for discpline teacher
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
      <td width="151" align="center"><a href="missing.php">Missing Letters</a></td>
      <td width="91" align="center"><a href="report.php">Report</a></td>
      <td width="184" align="center"><a href="changepass.php">Change Password</a></td>
      <td width="120" align="center"><p>FAQ</p></td>
      <td width="120" align="center"><a href="logout.php">Log Out</a></td>
    </tr>
</table>
<!-- end menu --></div><br />
<center>
  <div class="helppage"><h1>Frequently Asked Questions</h1><br />
    <h2 align="left">Q1. How to view the list of missing absent letters?</h2>
    <p align="left">Ans: Click &quot;missing letters&quot; link at the top of the page. Click &quot;last week&quot; to generate the report of the previous week missing letters. Or, you can input two dates to generate specific dates of missing absent letters.</p>
    <h2 align="left">Q2. How to view all absentees over the week?</h2>
    <p align="left">Ans: Click &quot;report&quot; link at the top of the page. Click &quot;weekly report of missing letters and absentees&quot;. Click &quot;lastweek&quot; to generate the report of the previous week missing letters and absentees. Or, you can input two dates to generate specific dates of missing absent letters and absentees. &quot;A&quot; means missing absent letters Whereas &quot;OK&quot; means absent letter has been given.</p>
    <h2 align="left">Q3. How to view absentees and latecomers on daily basis?</h2>
    <p align="left">Ans: Click &quot;report&quot; link at the top of the page. Click &quot;daily report of absentees and latecomers&quot;. Click &quot;today's list&quot; to generate today's absentees and latecomers. Or, you can input a specific date to view the latecomers and absentees on that day. </p>
    <h2 align="left">Q4. How to print reports?</h2>
    <p align="left">Ans: Everytime, you generate reports, there will be a link &quot;print this page&quot; at the bottom of the report. When you click it, a new page will be opened in a new tab, and a black and white version of the report will be generated. Click ctrl+p on your keyboard to print the report. Or you can choose printing option from the web browser that you use.</p>
    <h2 align="left">Q5. How to change your password?</h2>
    <p align="left">Ans: Click &quot;Change password&quot; link at the top of the page. Enter new password twice and your previous password once. Click submit.</p>
    <p align="left">&nbsp;</p>
    <p align="left">&nbsp;</p>
    <p align="left">&nbsp;</p>
    <p align="left">&nbsp;</p>
  </div></center>
</div>
</center>
<center><div class="bottom"></div></center>
</body>
</html>

            
            
        <?php    
		}
		else // if not
		{ // load user guide for form teacher
			$classid=$_SESSION['classid']; // id of the class
		?>
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>home</title>
            <link href="stylesheet.css" rel="stylesheet" type="text/css" />
            </head>
            
            <body>
            <center><div class="content">
            <div class="top" align="right">
              <p>Today's Date: <?php echo(date("D,d M Y")); ?><br />
              </p>
              <table width="660" border="0" >
              <tr>
                    <td width="74" align="center"><a href="mainpage2.php">Home</a></td>
                    <td width="112" align="center"><a href="sort.php">Sorting Letters</a></td>
                    <td width="130" align="center"><a href="missing2.php">Missing Letters</a></td>
                    <td width="146" align="center"><a href="changepass2.php">Change Password</a></td>
                    <td width="86" align="center"><p>FAQ</p></td>
                   <td width="86" align="center"><a href="logout.php">Log Out</a></td>
                  </tr>
            </table>
            </div>
            <br />
            <center>
              <div class="helppage"><h1>Frequently Asked Questions</h1><br />
                <h2 align="left">Q1. How to view the list of missing absent letters?</h2>
                <p align="left">Ans: Click &quot;missing letters&quot; link at the top of the page. Click &quot;last week&quot; to generate the report of the previous week missing letters. Or, you can input two dates to generate specific dates of missing absent letters.</p>
                <h2 align="left">Q2. How to change the status of the missing letters?</h2>
                <p align="left">Ans: Click &quot;sorting letters&quot; link at the top of the page. Click the desired date. Thick the name of the student who has submitted the letters. Click "submit"</p>
                <h2 align="left">Q3. How to search for specific date?</h2>
                <p align="left">Ans: Click &quot;sorting letters&quot; link at the top of the page. At the top right hand corner, there is a search box. enter the desired date and click &quot;search&quot;. If found, the date will be displayed on the screen. 
                 <h2 align="left">Q4. How to search for dates with missing letters</h2>
                <p align="left">Ans: Click &quot;sorting letters&quot; link at the top of the page. At the bottom page, You'll find "missing " link. Click it and only the date with missing letters will be displayed. 
                 <h2 align="left">Q5. How to search for dates with no missing letters</h2>
                <p align="left">Ans: Click &quot;sorting letters&quot; link at the top of the page. At the bottom page, You'll find "complete " link. Click it and only the date with no missing letters will be displayed. 
                <h2 align="left">Q6. How to print reports?</h2>
                <p align="left">Ans: Everytime, you generate reports, there will be a link &quot;print this page&quot; at the bottom of the report. When you click it, a new page will be opened in a new tab, and a black and white version of the report will be generated. Click ctrl+p on your keyboard to print the report. Or you can choose printing option from the web browser that you use.</p>
                <h2 align="left">Q7. How to change your password?</h2>
                <p align="left">Ans: Click &quot;Change password&quot; link at the top of the page. Enter new password twice and your previous password once. Click submit.</p>
                
              </div></center>
            </div>
            </center>
            <center><div class="bottom"></div></center>
            </body>
            </html>
    <?php
		}
}
?>
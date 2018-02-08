<?php
include("teacher_session.php"); // link this page to teacher_session.php
include("update_absentees.php"); // link this page to update_absentees.php
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
        <td width="74" align="center"><p>Home</p></td>
        <td width="112" align="center"><a href="sort.php">Sorting Letters</a></td>
        <td width="130" align="center"><a href="missing2.php">Missing Letters</a></td>
        <td width="146" align="center"><a href="changepass2.php">Change Password</a></td>
        <td width="86" align="center"><a href="FAQ.php">FAQ</a></td>
       <td width="86" align="center"><a href="logout.php">Log Out</a></td>
      </tr>
</table>
</div>
<h1 align="right">Welcome,<?php echo($name);?></h1>
<?php
	  $monday=strtotime("Monday last week"); // get the date of monday last week
	  $mondayformat=date("D, d M Y",$monday); // format $monday into D, d M Y
 	  $d1=date("Y-m-d",$monday); // change the format of monday into Y-m-d
	  $d2=date("Y-m-d");// change the format of friday into Y-m-d
	  $todayformat=date("D, d M Y"); // change the format of today's date
	  
	  
	  $absentees_search=mysql_query("SELECT absent_letter.date AS date, classtbl.Class_ID FROM absent_letter_sorter.absent_letter, 
	   					school_db.classtbl, school_db.studentlisttbl WHERE date>='$d1' AND date<='$d2' AND 
						classtbl.Class_ID=studentlisttbl.Class_ID AND absent_letter.Student_ID=studentlisttbl.Student_ID AND 
						classtbl.Class_ID='$classid' "); 
	  								// find the absentees in the class 
							
	  
	  $missingletter_search=mysql_query("SELECT absent_letter.date AS date, studentlisttbl.Student_Name AS Name, classtbl.Class AS class 
								FROM absent_letter_sorter.absent_letter, school_db.studentlisttbl, school_db.classtbl
								WHERE absent_letter.Student_ID = studentlisttbl.Student_ID
								AND studentlisttbl.Class_id = classtbl.Class_ID
								AND absent_letter.letters_given='0'
								AND absent_letter.date>='$d1' AND absent_letter.date<='$d2' AND
								classtbl.Class_ID='$classid'"); // find absentees who has not submitted the letters last week
	 
	 $total_absentees=mysql_num_rows($absentees_search); // find the no of absentees
	 $no_of_missingletters=mysql_num_rows($missingletter_search); // find no of missing letters found
	 
	 if($no_of_missingletters==0)
	 {						
?>
		<p align="right"><b>There are no missing letters  since last week, <?php echo($mondayformat); ?> till today, <?php echo($todayformat); ?>
       </b> </p>      
<?php
	 }
	 else
	 {
	 ?>
      <b><p align="right"><?php echo($no_of_missingletters); ?> out of <?php echo($total_absentees); ?> absentees have not submitted the letters  since last week, <?php echo($mondayformat); ?> till today, <?php echo($todayformat); ?></p></b> 
<?php
	 }
	 
	 ?>
<h1 align="center"><img src="home.png" width="700" height="300" /></h1>
<p align="center">&nbsp;</p>
  <p align="center">&nbsp;</p>
</div>
</center>
<center><div class="bottom"></div></center>
</body>
</html>
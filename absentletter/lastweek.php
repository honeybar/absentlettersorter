<?php

		include("discpline_session.php"); // link this page to teacher_session.php
		include("update_absentees.php"); // link this page to update_absentees.php			
		include("connection.php"); // link this page to connection.php
		include("defaultweeksettings.php"); // link this page to defaultsettings.php
		
		
?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Last week's missing absent letters</title>
        <link href="stylesheet.css" rel="stylesheet" type="text/css" />
        </head>
        
        <body>
        <center><div class="content">
        <div class="top" align="right">
          <p>Today's Date: <?php echo(date("D,d M Y")); ?></p>
          
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
        
	<?php
	
  	  $d1=date("Y-m-d",$monday); // change the format of monday into Y-m-d
	  $d2=date("Y-m-d",$friday);// change the format of friday into Y-m-d
	  
	   $absentees=mysql_query("SELECT date FROM absent_letter WHERE date>='$d1' AND date<='$d2'"); // find the absentees between last week's monday to friday
	  
		  $missingletters_search=mysql_query("SELECT absent_letter.date AS Date, studentlisttbl.Student_Name AS Name, classtbl.Class AS class 
								FROM absent_letter_sorter.absent_letter, school_db.studentlisttbl, school_db.classtbl
								WHERE absent_letter.Student_ID = studentlisttbl.Student_ID
								AND studentlisttbl.Class_ID = classtbl.Class_ID
								AND absent_letter.letters_given='0'
								AND absent_letter.date>='$d1' AND absent_letter.date<='$d2'"); // find absentees who has not submitted the letters last week
	 
							
	  $total_absentees=mysql_num_rows($absentees); // find the no of absentees
	  $no_of_missingletters=mysql_num_rows($missingletters_search); // find no of missing letters found
	  
	  if($no_of_missingletters>0) // if records are found ...
	  {
		$totalpages=ceil($no_of_missingletters/$dataperpage); // find total pages for the no of records to be displayed
		include("pagination.php"); // link this page to pagination.php
	  ?>
      	<!--begin report -->
        <center><div class="reportlayout">
  		<h1 align="center">Missing Absent Letters</h1>
  		<p align="center"><?php echo($mondayformat." to ". $fridayformat);         ?></p>
          <table width="100%%" border="1" class="table" cellpadding="0" cellspacing="0">
            <tr>
              <td width="37%"><strong>Name</strong></td>
              <td width="14%"><strong>Class</strong></td>
     
		  <?php
		  
	  	  $missingletters_search=mysql_query("SELECT absent_letter.date AS date, studentlisttbl.Student_Name AS Name, classtbl.Class AS class 
								FROM absent_letter_sorter.absent_letter, school_db.studentlisttbl, school_db.classtbl
								WHERE absent_letter.Student_ID = studentlisttbl.Student_ID
								AND studentlisttbl.Class_ID = classtbl.Class_ID
								AND absent_letter.letters_given='0'
								AND absent_letter.date>='$d1' AND absent_letter.date<='$d2'
								ORDER BY class, Name
								LIMIT $offset,$dataperpage"); // repeat the previous query, this time control the no of records displayed per page

		  	for($i=0;$i<5;$i++) // loop the date from monday to friday
		  	{
			  $d=date("d M",strtotime("+$i day",$monday)); // increment the date by $i day(s)
			  
			  echo("<td width='9%'><strong>$d</strong></td>"); // output date
		  	}
		  
		  	echo("</tr>"); // close table row
		
		  	while($missingletters=mysql_fetch_array($missingletters_search)) // put data in an array
			{
				echo ("<tr><td>".$missingletters['Name']."</td><td>".$missingletters['class']."</td>"); // output name and class
				
				for($i=0;$i<5;$i++) // loop table cell 5 times
				{	
					$d=date("Y-m-d",strtotime("+$i day",$monday)); // increment the date by $i day 
					if($missingletters["date"]==$d) // if absence date equals to $d ...
					{
      					echo("<td align='center'>A</td>"); // output A
					}
					else // if not absent on date $d ...
					{
      					echo("<td align='center'>&nbsp;</td>"); // output empty cell
					}
				}
			}
		?>
            </tr>
          </table>
          <br />  
	<?php
    
        if($currentpage==$totalpages) // in case of the user on the lastpage
        {
            echo("<h6>The deadline for submitting letter is on ".$deadline.". <br>
		".$no_of_missingletters." out of ".$total_absentees." absentees haven't submitted the
		 absent letters from ".$mondayformat." to ".$fridayformat.".</h6>" ); // output the warning
        }
     ?>
        <!-- end report -->  
        
        <p align="left"> 
        <a href="printrem.php" target="_blank">Print this report </a></p>
        <p align="left"><a href="missing.php">go back</a></p>
		</div></center>

<?php
	  }
	else
	{
		echo("<br><br><h1 align='center'> No missing letters</h1><a href='missing.php'>go back</a>");
		// display this if no data is found	
	}
  ?>
  
</div>
</center>
<center><div class="bottom"></div></center>
</body>
</html>

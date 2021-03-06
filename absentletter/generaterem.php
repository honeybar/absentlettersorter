<?php

	include("discpline_session.php"); // link this page to discpline_session.php
		
	$d1=$_GET["date1"]; // get date1 from missing.php
	$d2=$_GET["date2"]; // get date 2 from missing.php
	
	$filename="generaterem"; // the name of this page	
	include("connection.php"); // link this page to connection.php
	include("generaterepsettings.php"); // link this page to generaterepsettings.php
	include("update_absentees.php"); // link this page to update_absentees.php
		
?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>generate weekly reminder</title>
        <!-- link this page to stylesheet.css -->
        <link href="stylesheet.css" rel="stylesheet" type="text/css" />
        </head>
        
        <body>
        <center><div class="content">
        <div class="top" align="right">
          <p>Today's Date: <?php echo(date("D,d M Y")); //output today's date ?></p>
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
	  $absentees=mysql_query("SELECT date FROM absent_letter WHERE date>='$startdate' AND date<='$enddate'"); // find the absentees between last week's monday to friday
	  
		  $missingletters_search=mysql_query("SELECT absent_letter.date AS Date, studentlisttbl.Student_Name AS Name, classtbl.Class AS class 
								FROM absent_letter_sorter.absent_letter, school_db.studentlisttbl, school_db.classtbl
								WHERE absent_letter.Student_ID = studentlisttbl.Student_ID
								AND studentlisttbl.Class_id = classtbl.Class_ID
								AND absent_letter.letters_given='0'
								AND absent_letter.date>='$startdate' AND absent_letter.date<='$enddate'");

	  $no_of_missingletters=mysql_num_rows($missingletters_search); // find the total of $misingletters
	  $total_absentees=mysql_num_rows($absentees); // find the no of absentees 

	  
	  if($no_of_missingletters>0) // in case of data between the 2 dates exist
	  {
		$totalpages=ceil($no_of_missingletters/$dataperpage); // find the total pages for all records to be displayed
	  
	  	include("pagination.php"); // link this page to pagination.php	  
?>
	      <!-- output all results -->
	      <center><div class="reportlayout">
	      <h1 align="center">Missing Absent Letters</h1>
	      <p align="center"><?php echo($date1." to ". $date2); // output $date1 and $date2 ?></p>
	      <table width="100%" border="1" class="table" cellpadding="0" cellspacing="0">
		<tr>
		  <td width="37%"><strong>Name</strong></td>
		  <td width="14%"><strong>Class</strong></td>
	     
	      <?php
	  
	  $missingletters_search=mysql_query("SELECT absent_letter.date AS Date, studentlisttbl.Student_Name AS Name, classtbl.Class AS class 
							FROM absent_letter_sorter.absent_letter, school_db.studentlisttbl, school_db.classtbl
							WHERE absent_letter.Student_ID = studentlisttbl.Student_ID
							AND studentlisttbl.Class_id = classtbl.Class_ID
							AND absent_letter.letters_given='0'
							AND absent_letter.date>='$startdate' AND absent_letter.date<='$enddate'
							ORDER BY class, Name
							LIMIT $offset,$dataperpage"); // search for the same query, this time limitting the number of data displayed per page

	  for($i=0;$i<$diff;$i++) // loop for intervals between two dates
	  {
		  $d=date("d M",strtotime("+$i day",$start)); 
		  // increment the date by $i day and format the date into d-M
		  
     	  echo("<td width='9%'><strong>$d</strong></td>"); // output the date in a table cell
	  }
	  
	  echo("</tr>"); // close table row
	
	  while($missingletters=mysql_fetch_array($missingletters_search)) // put data from database into array
	  	{
    		echo("<tr><td>".$missingletters['Name']."</td><td>".$missingletters['class']."</td>"); 
			// output name and class in table cells
			
			for($i=0;$i<$diff;$i++) // loop for intervals between two dates
			{	
				$d=date("Y-m-d",strtotime("+$i day",$start)); 
				// increment date by $i and format the date into Y-M-d
				
				if($missingletters["Date"]==$d) // in case of date of absence the same as $d
				{
      				echo("<td align='center'>A</td>"); // Output A 
				}
				else
				{
      				echo("<td align='center'>&nbsp;</td>"); // leave the cell empty
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
		 absent letters from ".$date1." to ".$date2.".</h6>" ); // output the warning
	}
 ?>
	<!-- end report -->  
    
	<p align="left"> 
	<a href="printgeneraterem.php?date1=<?php echo($startdate); ?>&date2=<?php echo($enddate); ?>" 	target="_blank">Print this report </a></p>
	<p align="left"><a href="missing.php">go back</a></p>

<?php
		echo("</div></center>");
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

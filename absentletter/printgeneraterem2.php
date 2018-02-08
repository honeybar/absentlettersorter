<?php    
		include("teacher_session.php");
		
		$d1=$_GET["date1"]; // get date1 from generaterem.php
		$d2=$_GET["date2"]; // get date 2 from generaterem.php
		
		include("connection.php"); // link this page to connection.php
		include("generaterepsettings.php"); // link this page to generaterepsettings.php
		include("update_absentees.php"); // link this page to update_absentees.php
  	  
	  	  $absentees=mysql_query("SELECT absent_letter.date AS date, classtbl.Class_ID FROM absent_letter_sorter.absent_letter, 
								school_db.classtbl, school_db.studentlisttbl WHERE date>='$startdate' AND date<='$enddate' AND 
								classtbl.Class_ID=studentlisttbl.Class_ID AND absent_letter.Student_ID=studentlisttbl.Student_ID AND 
								classtbl.Class_ID='$classid'"); 
	  								// find the absentees in the class 
							
	  
	  $missingletters_search=mysql_query("SELECT absent_letter.date AS date, studentlisttbl.Student_Name AS Name, classtbl.Class AS class 
										FROM absent_letter_sorter.absent_letter, school_db.studentlisttbl, school_db.classtbl
										WHERE absent_letter.Student_ID = studentlisttbl.Student_ID
										AND studentlisttbl.Class_id = classtbl.Class_ID
										AND absent_letter.letters_given='0'
										AND absent_letter.date>='$d1' AND absent_letter.date<='$d2' AND 
										classtbl.Class_ID='$classid' 
										ORDER BY class, Name"); // find absentees who has not submitted the letters last week


	  $no_of_missingletters=mysql_num_rows($missingletters_search); // find the total of $misingletters
	  $total_absentees=mysql_num_rows($absentees); // find the no of absentees 				   
	  	$friday=strtotime("this Friday"); // get the date of this w
	  ?>
      
  <!-- output report -->   
  <h1 align="center">Missing Absent Letters</h1>
  <p align="center"><?php echo($date1." to ". $date2);         ?></p>
  <table width="80%" border="1" class="table" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td width="37%"><strong>Name</strong></td>
      <td width="14%"><strong>Class</strong></td>
     
  <?php
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
				
				if($missingletters["date"]==$d) // in case of date of absence the same as $d
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
		echo("<h3 align='center'>The deadline for submitting letter is on ".$deadline.". <br>
		".$no_of_missingletters." out of ".$total_absentees." absentees haven't submitted the
		 absent letters from ".$date1." to ".$date2.".</h3>" ); // output the warning
?>
<!-- end of report -->

     
  <?php
		include("teacher_session.php"); // link this page to teacher_session.php
		include("update_absentees.php"); // link this page to update_absentees.php	
  		include("connection.php"); // link this page to connection.php
		include("defaultweeksettings.php"); // link this page to defaultweeksettings.php
	  	$d1=date("Y-m-d",$monday); // convert monday Y-m-d format
	  	$d2=date("Y-m-d",$friday); // convert friday to Y-m-d format
		
	  	 $absentees=mysql_query("SELECT absent_letter.date AS date, classtbl.Class_ID FROM absent_letter_sorter.absent_letter, 
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
										classtbl.Class_ID='$classid' 
										ORDER BY class, Name"); // find absentees who has not submitted the letters last week
							
	  $total_absentees=mysql_num_rows($absentees); // find the no of absentees
	  $no_of_missingletters=mysql_num_rows($missingletter_search); // find no of missing letters found
		?>
		<!-- building report -->
         <h1 align="center">Missing Absent Letters</h1>
		  <p align="center"><?php echo($mondayformat." to ". $fridayformat);         ?></p>
		  <table width="80%" border="1" class="table" cellpadding="0" cellspacing="0" align="center">
			<tr>
			  <td width="37%"><strong>Name</strong></td>
			  <td width="14%"><strong>Class</strong></td>
<?php
	  $friday=strtotime("this Friday"); // find the date of this week's friday
	  $deadline=date("D,d M Y",$friday); // change the format of this week's friday
	  
	  for($i=0;$i<5;$i++) // loop monday's date to Friday's date
	  {
		  $d=date("d M",strtotime("+$i day",$monday));
     	  echo("<td width='9%'><strong>$d</strong></td>");
	  }
	  
	  echo("</tr>"); // close table row
	
	 while($missingletters=mysql_fetch_array($missingletter_search)) // put data in an array
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
		echo(" </tr></table>"); // close table
		
		 echo("<h3 align='center'>The deadline for submitting letter is on ".$deadline.". <br>
		".$no_of_missingletters." out of ".$total_absentees." absentees haven't submitted the
		 absent letters from ".$mondayformat." to ".$fridayformat.".</h3>" ); // output the warning
		?>
</body>
</html>
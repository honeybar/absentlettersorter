<?php
$today=date("Y-m-d"); 
include("connection.php");
include("update_absentees.php"); // link this page to update_absentees.php

$absentees_search=mysql_query("SELECT absent_letter.date AS Date, studentlisttbl.Student_Name AS Name, classtbl.Class AS class 
								FROM absent_letter_sorter.absent_letter, school_db.studentlisttbl, school_db.classtbl
								WHERE absent_letter.Student_ID = studentlisttbl.Student_ID
								AND studentlisttbl.Class_id = classtbl.Class_ID
								AND absent_letter.date='$today' 
			   			  		ORDER BY class, Name"); // join the tables using primary keys and find 													absentees absent on $today


		$latecomers_search=mysql_query("SELECT studentlisttbl.Student_Name AS Name, classtbl.Class AS class, attendance_student_tbl.date AS date 
										FROM attendancedb.attendance_student_tbl, school_db.studentlisttbl, school_db.classtbl 
										WHERE attendance_student_tbl.Student_ID=studentlisttbl.Student_ID AND
										classtbl.Class_ID=studentlisttbl.Class_ID AND attendance_student_tbl.status='l'
										AND attendance_student_tbl.date='$today'
										ORDER BY class, Name"); // join the tables using primary keys and find 													latecomers who are late on $today
										
$totallate=mysql_num_rows($latecomers_search); // find total no of latecomers 
$totalabsent=mysql_num_rows($absentees_search); // find total no of absentees
if($totalabsent==0 && $totallate==0)
	{
		echo("<br><br><br><h2 align='center'>No data available yet</h2> <p align='center'><a href='report.php'>go back</a></p>");
	}
	else
	{
?>
      <p align="right"><?php echo(date("D, d M Y")); // change date format ?> </p>    
 <?php
		if($totallate>0) // if there are latecomers on $date
		{
	?>
  			<!-- build table for latecomers -->
	
   		 	<table width="45%" border="1" cellpadding="0" cellspacing="0" class="table" 
            style="float:left">
        	<tr>
    	 	<td colspan="2" align="center"> <p>Late Comers</p></td></tr>
     		<tr>
        
          	<td width="71%" align="center"><strong>Name</strong></td>
         	 <td width="29%" align="center"><strong>Class</strong></td>
          
			</tr>
        
  		<?php
			while($latecomers=mysql_fetch_array($latecomers_search)) // store $latecomers_search into an array
			{
  		?>
        		<tr>
            
          		<td align="center"><?php echo($latecomers["Name"]); // output student name ?></td>
          		<td align="center"><?php echo($latecomers["class"]); // output class ?> </td>
            
        		</tr>
        <?php
			}
      		echo("<tr><td align='right'>total:</td><td>".$totallate."</td></tr></table>"); 
	  		// output total late comers
			/* end of latecomers table */
		}
		else // if no latecomers ...
		{ 
		?>
    	    <table width="45%" border="1" cellpadding="0" cellspacing="0" class="table" 
            style="float:left" align="center">
            <tr>
			<td align='center'><p>No Late comers</p></td>
            </tr></table>
            
        <?php	
		}
		
		if($totalabsent>0) // if there are absentees ...
		{
		?>
        	<!-- build absentees table -->
      		<table width="45%" border="1" cellpadding="0" cellspacing="0" class="table" >
      		<tr>
      		<td colspan="2" align="center"><p>Absentees</p></td></tr>
        	<tr>
          	<td width="71%" align="center"><strong>Name</strong></td>
          	<td width="29%" align="center"><strong>Class</strong></td>
        	</tr>
            
        <?php
			while($absentees=mysql_fetch_array($absentees_search)) // put $absentees_search in an array
			{
					
		?>
        		<tr>
          		<td align="center"><?php echo($absentees["Name"]); // output student's name?></td>
          		<td align="center"><?php echo($absentees["class"]); // output class ?></td>
        		</tr>
 		<?php
			
      			
			}
			
			echo("<tr><td align='right'>total:</td><td>".$totalabsent."</td></tr></table>"); 
				// output total absentees
		}
			
				/* end of absentees table */
				
		else // if no absentees... 
		{
			/* output no absentees */
		?>
        
        	<table width="45%" border="1" cellpadding="0" cellspacing="0" class="table" 
        	align="center">
        	<tr>
			<td align='center'><p>No absentees</p></td>
            </tr>
            </table>
            
        <?php
		}
	}
		?>
  
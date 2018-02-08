<?php
	include("discpline_session.php"); // link this page to discpline_session.php
	include("connection.php"); // link this page to connection.php
	include("update_absentees.php"); // link this page to update_absentees.php
		
	if(empty($_GET["date"])) // in case of the date not filled in by the user
	{
			header("location:generatedailyreperror.php"); // direct to generatedailyreperror.php
	}
		
?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>generate daily report</title>
        <link href="stylesheet.css" rel="stylesheet" type="text/css" />
        </head>
        
        <body>
        <center><div class="content">
        <div class="top" align="right">
          <p>Today's Date:<?php echo(date("D,d M Y")); // output today's date ?></p>
          <!-- building the menu -->
          <table width="774" border="0" >
            <tr>
              <td width="82" align="center"><a href="mainpage.php">Home</a></td>
              <td width="151" align="center"><a href="missing.php">Missing Letters</a></td>
              <td width="91" align="center"><p>Report</p></td>
              <td width="184" align="center"><a href="changepass.php">Change Password</a></td>
              <td width="120" align="center"><a href="FAQ.php">FAQ</a></td>
              <td width="120" align="center"><a href="logout.php">Log Out</a></td>
            </tr>
          </table>
          <!-- end menu -->
        </div>
<?php 
		
		$date=date_format(date_create($_GET["date"]),"Y-m-d"); 
		// get date from daily.php and convert it change the date format
		
		$getdata="&date=$date"; // data to be passed to the next page		

		$absentees_search=mysql_query("SELECT absent_letter.date AS Date, studentlisttbl.Student_Name AS Name, classtbl.Class AS class 
								FROM absent_letter_sorter.absent_letter, school_db.studentlisttbl, school_db.classtbl
								WHERE absent_letter.Student_ID = studentlisttbl.Student_ID
								AND studentlisttbl.Class_id = classtbl.Class_ID
								AND absent_letter.date='$date' 
			   			  		ORDER BY class, Name"); // join the tables using primary keys and find 													absentees absent on $date


		$latecomers_search=mysql_query("SELECT studentlisttbl.Student_Name AS Name, classtbl.Class AS class, attendance_student_tbl.date AS date 
										FROM attendancedb.attendance_student_tbl, school_db.studentlisttbl, school_db.classtbl 
										WHERE attendance_student_tbl.Student_ID=studentlisttbl.Student_ID AND
										classtbl.Class_ID=studentlisttbl.Class_ID AND attendance_student_tbl.status='l'
										AND attendance_student_tbl.date='$date'
										ORDER BY class, Name"); // join the tables using primary keys and find 													latecomers who are late on $date
										
		$totallate=mysql_num_rows($latecomers_search); // find total no of latecomers 
		$totalabsent=mysql_num_rows($absentees_search); // find total no of absentees
		
		if($totalabsent==0 && $totallate==0) // if there are no late comers and absentees 
		{
			echo("<br><br><br><h2 align='center'>No data available yet</h2> <p align='center'>
				 <a href='report.php'>go back</a></p>"); // output no data available
		}
		else
		{
			$dataperpage=15; // determine no of records displalayed per page
			
			if($totalabsent>=$totallate) // if there are more absentees than latecomers
			{
				$totalpages=ceil($totalabsent/$dataperpage); // totalpages are determined from no of absentees 
			}
			else // if not 
			{
				$totalpages=ceil($totallate/$dataperpage); // totalpages are determined from no of latecomers
			}
			
		include("pagination.php");

		$absentees_search=mysql_query("SELECT absent_letter.date AS Date, studentlisttbl.Student_Name AS Name, classtbl.Class AS class 
										FROM absent_letter_sorter.absent_letter, school_db.studentlisttbl, school_db.classtbl
										WHERE absent_letter.Student_ID = studentlisttbl.Student_ID
										AND studentlisttbl.Class_id = classtbl.Class_ID
										AND absent_letter.date='$date' 
									  ORDER BY class, Name
									  LIMIT $offset, $dataperpage"); // control the amount of absentees 			  														 displayed per page


		$latecomers_search=mysql_query("SELECT studentlisttbl.Student_Name AS Name, classtbl.Class AS class, attendance_student_tbl.date AS date 
										FROM attendancedb.attendance_student_tbl, school_db.studentlisttbl, school_db.classtbl 
										WHERE attendance_student_tbl.Student_ID=studentlisttbl.Student_ID AND
										classtbl.Class_ID=studentlisttbl.Class_ID AND attendance_student_tbl.status='l'
										AND attendance_student_tbl.date='$date'
										ORDER BY class, Name
										LIMIT $offset, $dataperpage"); // control the amount of latecomers  		  														displayed per page
						
?>
      <center><div class="reportlayout">
      <p align="right"><?php echo(date_format(date_create($_GET["date"]),"D,d M Y")); // change date format ?> </p>    
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
			if($currentpage==$totalpages)
			{
      			echo("<tr><td align='right'>total:</td><td>".$totalabsent."</td></tr></table>"); 
				// output total absentees
				/* end of absentees table */
			}
		}
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
		?>
        
    	</tr>
  		</table>
  		<br />
  		<br />
  		<br />  
  
  		<p align="left">
  		<a href="printgeneratedailyrep.php?date=<?php echo($date); ?>" target="_blank">
        Print this report </a>
  		</p>
  
  		<p align="left"><a href="report.php">go back</a></p>
  		<p>&nbsp;</p>
        
    </div></center>
    </div>
    </center>
    <center><div class="bottom"></div></center>
    </body>
    </html>
<?php
	}
		
?>

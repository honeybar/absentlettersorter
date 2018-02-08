<?php
		include("discpline_session.php");		
	  	include("connection.php"); // link connection.php to this page
	  	include("defaultweeksettings.php"); // link generaterepsettings.php
		include("update_absentees.php"); // link this page update_absentees.php
		
		$d1=date("Y-m-d",$monday); // change the format of monday's date
	  	$d2=date("Y-m-d",$friday); // change the format of monday's date
	  
	  	$absentees_search=mysql_query("SELECT absent_letter.date AS date, studentlisttbl.Student_Name AS Name, classtbl.Class AS class, 
								absent_letter.letters_given AS status 
								FROM absent_letter_sorter.absent_letter, school_db.studentlisttbl, school_db.classtbl
								WHERE absent_letter.Student_ID = studentlisttbl.Student_ID
								AND studentlisttbl.Class_id = classtbl.Class_ID
								AND absent_letter.date>='$d1' AND absent_letter.date<='$d2'
						 		ORDER BY class, Name"); // join the database using primary keys and find the absentees between date 1 and 2
	  
	  $totalabsentees=mysql_num_rows($absentees_search); // no of absentees
	  $average=round($totalabsentees/5,1); // average no of absentees per day
	  $missingletters=0; // store the no of missing absent letters
?>
      
      <!-- begin report -->
      <h1 align="center">Absentees of the Week</h1>
      <p align="center"><?php echo($mondayformat." to ". $fridayformat);         ?></p>
      <table width="80%" border="1" class="table" cellpadding="0" cellspacing="0" align="center">
        <tr>
          <td width="37%"><strong>Name</strong></td>
          <td width="14%"><strong>Class</strong></td>
     
<?php
	  for($i=0;$i<5;$i++) // loop for intervals between two dates
		  {
			  $d=date("d M",strtotime("+$i day",$monday)); 
			  // increment the date by $i day and format the date into d-M
	
			  $absentperday[$i]=0; // initialize array to store no of absentees each day
	
				  echo("<td width='9%'><strong>$d</strong></td>"); // output the date in a table cell
		  }
		  
		  echo("</tr>"); // close table row
	
		  while($absentees=mysql_fetch_array($absentees_search)) // put data from database into array
		  {
				echo ("<tr><td>".$absentees['Name']."</td><td>".$absentees['class']."</td>"); 
				// output name and class in table cells
				
				for($i=0;$i<5;$i++) // loop for intervals between two dates
				{	
					$d=date("Y-m-d",strtotime("+$i day",$monday)); 
					// increment date by $i and format the date into Y-M-d
					
					if($absentees["date"]==$d) // in case of date of absence the same as $d
					{
						$absentperday[$i]=$absentperday[$i]+1; // store the no of absentees per day 
						if($absentees["status"]==0) // in case the letter has not been given
						{
								echo("<td align='center'>A</td>"); // output A
								$missingletters++; // increment missingletters by 1
						}
						else // if letter has been given
						{
							echo("<td align='center'>OK</td>");	// output OK
						}
					}
					else // if not absent on the date $d 
					{
						echo("<td>&nbsp;</td>"); // output empty cell
					}
				}
					echo("</tr>");
			}
		?>
			<!-- Output the calculation -->
            <tr><td colspan="2" align="right">No of absentees per day:</td>
        <?php
                for($i=0;$i<5;$i++) // loop the interval between two dates
                    {
                        echo("<td align='center'>".$absentperday[$i]."</td>");
                        // output the number of absentees each day
                    }
        ?> 	</tr>
          	<tr><td align="right" colspan="2">Average Absentees per day:</td> 
          	<td colspan="5"><?php echo($average); // output average absentees each day ?></td>
            </tr>
            <tr><td align="right" colspan="2">Total missing letters:</td> 
          	<td colspan="5"><?php echo($missingletters); // output total missing letters ?></td>
            </tr>
          	</table>
          	<!-- end calculation -->
          	<!-- end of report -->

 

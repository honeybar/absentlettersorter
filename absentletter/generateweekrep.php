<?php
		include("discpline_session.php");		

		$d1=$_GET["date1"]; // get date1 from weekly.php 
		$d2=$_GET["date2"]; // get date2 from weekly.php 
		$filename="generateweekrep"; // name of the page
		include("generaterepsettings.php"); // link generaterepsettings.php to this page
		include("connection.php"); // link connection.php to this page
		include("update_absentees.php"); // link this page update_absentees.php
		
?>

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>weekly report</title>
        <!-- attach stylesheet.css to this page -->
        <link href="stylesheet.css" rel="stylesheet" type="text/css" />
        </head>
        
        <body>
        <center><div class="content">
        <div class="top" align="right">
          <p>Today's Date: <?php echo(date("D,d M Y")); // output today's date ?></p>
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
        </div>
        
        <?php
       $absentees_search=mysql_query("SELECT absent_letter.date AS Date, studentlisttbl.Student_Name AS Name, classtbl.Class AS class,
	    						absent_letter.letters_given AS letters
								FROM absent_letter_sorter.absent_letter, school_db.studentlisttbl, school_db.classtbl
								WHERE absent_letter.Student_ID = studentlisttbl.Student_ID
								AND studentlisttbl.Class_id = classtbl.Class_ID
								AND absent_letter.date>='$startdate' AND absent_letter.date<='$enddate'"); // join the database using primary keys and find the absentees between date 1 and 2
	  
	  $totalabsentees=mysql_num_rows($absentees_search); // no of absentees
	  
	  if($totalabsentees>0) // in case of data found
	  {	 
		  $average=round($totalabsentees/$diff,1); // average absentees per day
		  $totalpages=ceil($totalabsentees/$dataperpage); // total no of pages required to display all the records
		
		  include("pagination.php"); 
	  ?>
          <!-- output report -->
          <center><div class="reportlayout">
          <h1 align="center">Absentees of the Week</h1>
          <p align="center"><?php echo($date1." to ". $date2);         ?></p>
          <table width="100%" border="1" class="table" cellpadding="0" cellspacing="0">
            <tr>
              <td width="37%"><strong>Name</strong></td>
              <td width="14%"><strong>Class</strong></td>
             
 <?php
	   
	  	$absentees_search=mysql_query("SELECT absent_letter.date AS Date, studentlisttbl.Student_Name AS Name, classtbl.Class AS class,
		 							absent_letter.letters_given AS letters
									FROM absent_letter_sorter.absent_letter, school_db.studentlisttbl, school_db.classtbl
									WHERE absent_letter.Student_ID = studentlisttbl.Student_ID
									AND studentlisttbl.Class_id = classtbl.Class_ID
									AND absent_letter.date>='$startdate' AND absent_letter.date<='$enddate'
									ORDER BY class, Name
						   			LIMIT $offset, $dataperpage"); // repeat the previous search, this time control the no of output per page
	  	  
		  $missingletters=0; // store the no of missing absent letters
		  
		  for($i=0;$i<$diff;$i++) // loop for intervals between two dates
		  {
			  $d=date("d M",strtotime("+$i day",$start)); 
			  // increment the date by $i day and format the date into d-M
	
			  $absentperday[$i]=0; // initialize array to store no of absentees each day
	
				  echo("<td width='9%'><strong>$d</strong></td>"); // output the date in a table cell
		  }
		  
		  echo("</tr>"); // close table row
	
		  while($absentees=mysql_fetch_array($absentees_search)) // put data from database into array
		  {
				echo ("<tr><td>".$absentees['Name']."</td><td>".$absentees['class']."</td>"); 
				// output name and class in table cells
				
				for($i=0;$i<$diff;$i++) // loop for intervals between two dates
				{	
					$d=date("Y-m-d",strtotime("+$i day",$start)); 
					// increment date by $i and format the date into Y-M-d
					
					if($absentees["Date"]==$d) // in case of date of absence the same as $d
					{
						$absentperday[$i]=$absentperday[$i]+1; // store the no of absentees per day 
						if($absentees["letters"]==0) // in case the letter has not been given
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
    
    
  <?php 
  		if($currentpage==$totalpages) // in case the user on the last page
  		{
  ?>
            <!-- Output the calculation -->
            <tr><td colspan="2" align="right">No of absentees per day:</td>
        <?php
                for($i=0;$i<$diff;$i++) // loop the interval between two dates
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
	 <?php
      	} 
		else
		{
			echo("</table>");
		}
      ?>
  		
        <p align="left"> 
        <a href="printgenerateweekrep.php?date1=<?php echo($startdate); ?>&date2=<?php echo($enddate); ?>" target="_blank">Print this report </a></p>
        <p align="left"><a href="report.php">go back</a></p>
        <br />
<?php
		echo("</div></center>");
	  }
	 else // in case no data available
	 {
			echo("<br><br><h3 align='center'> No available data</h3><p align='center'><a href='report.php'>go back</a></p>"); // output no data 
	 }
	  ?>
      </div>
      </center>
    </div>
    </center>
    <center><div class="bottom"></div></center>
    </body>
    </html>


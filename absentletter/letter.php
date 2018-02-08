<?php
	include("teacher_session.php"); // link this page to teacher_session.php
	include("update_absentees.php"); // link this page to update_absentees.php
	$date=$_GET["date"]; // obtain date from sort.php
	$absentdate=date_format(date_create($_GET["date"]),"D,d M Y"); //change format of the date
	include("connection.php"); // link this page to connection.php
?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>check letters</title>
        
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
      			<td width="112" align="center"><p>Sorting Letters</p></td>
      			<td width="130" align="center"><a href="missing2.php">Missing Letters</a></td>
      			<td width="146" align="center"><a href="changepass2.php">Change Password</a></td>
      			<td width="86" align="center"><a href="FAQ.php">FAQ</a></td>
      			<td width="86" align="center"><a href="logout.php">Log Out</a></td>
    		</tr>
		</table>
        </div>
          <h6 align="right">Date of Absence:<?php echo($absentdate); ?></h6>
         <div class="list"> <table width="100%" border="0">
            <tr>
              <td width="52%" align="center"><p>Name</p></td>
              <td width="22%" align="center"><p>Class</p></td>
              <td width="26%" align="center"><p>Absent Letter Given?</p></td>
            </tr>
          </table></div>
      <form action="lettersort.php" method="POST">
     <?php
      $searchdate=mysql_query("SELECT absent_letter.date AS date, studentlisttbl.Student_Name AS Name, classtbl.Class AS class,
	   						absent_letter.letters_given AS status, absent_letter.Student_ID AS studid
							FROM absent_letter_sorter.absent_letter, school_db.studentlisttbl, school_db.classtbl
							WHERE studentlisttbl.Student_ID = absent_letter.Student_ID
							AND studentlisttbl.Class_ID = classtbl.Class_ID  AND date='$date'
							AND studentlisttbl.Class_ID='$classid' ORDER BY class, Name"); 
				  // search for absentees on $date
				  
		$total=mysql_num_rows($searchdate); // find the no of records found
		$dataperpage=10; // determine no of records display per page
		$totalpages=ceil($total/$dataperpage); // find total no of pages 
		$getdata="&date=$date";
		include("pagination.php");
		
		$searchdate=mysql_query("SELECT absent_letter.date AS date, studentlisttbl.Student_Name AS Name, classtbl.Class AS class,
								absent_letter.letters_given AS status, absent_letter.Student_ID AS studid
								FROM absent_letter_sorter.absent_letter, school_db.studentlisttbl, school_db.classtbl
								WHERE studentlisttbl.Student_ID = absent_letter.Student_ID
								AND studentlisttbl.Class_ID = classtbl.Class_ID  AND date='$date'
								AND studentlisttbl.Class_ID='$classid' ORDER BY class, Name 
								LIMIT $offset,$dataperpage"); // repeat the previous query search, this time control the records displayed per page
					
		$ctr=0; // control the order 			
				
		while($absentees=mysql_fetch_array($searchdate)) 
		// store name and class of absentees in an array
		{
			echo("<input type='hidden' name='studid$ctr' value='$absentees[studid]'>"); 
			// send information regarding the status of absent letter
			?>
			<center> <div class="data">
				<table width="100%" border="0">
				  <tr>
					<td width="52%" align="center"><p><?php echo($absentees["Name"]);?></p></td>
					<td width="22%" align="center"><p><?php echo($absentees["class"]);?></p></td>
					<td width="25%" align="center">
					<?php
					if($absentees["status"]==1)
					{
						echo("<input type='checkbox' name='status$ctr'/ checked='checked' 
						value='1' >");
					}
					else
					{
						echo("<input type='checkbox' name='status$ctr' value='1' >");
					}
					$ctr++; // increment ctr by 1
					?>
					</td>
				  </tr>
				</table>
			  </div></center>	
      <?php
		}
  ?>
       <br /><center><input type="image" onclick="submit();" src="submitbutton.png" />
       </center>
    	<table align="center" width="80%"> 
    	<tr>
    	<td align="right"><p align="right"><a href="sort.php">choose other date...</a></p></td>
    	</tr>
        </table>
<?php
		
		echo("<input type='hidden' name='date' value='$date'>"); // send date to lettersort.php
		echo("<input type='hidden' name='count' value='$total'>"); // send total to lettersort.php
?>
        </div>
        </form>
        <center><div class="bottom"></div></center>
        </body>
        </html>


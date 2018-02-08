<?php
include("teacher_session.php");
include("update_absentees.php"); // link this page to update_absentees.php
?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>sort letters</title>
		<link href="stylesheet.css" rel="stylesheet" type="text/css" />
		</head>

		<body>
		<center><div class="content">
		<div class="top" align="right">
 		<p>Today's Date:<?php echo(date("D,d M Y")); ?></p>
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
        
        <!-- build search engine -->
		<form action="search.php" method="POST"> 
        <!-- this is the textbox for date input -->
    	<h2 align="right">Filter:<input type="date" name="date" placeholder="select a date..." />
      	<br />
		<input type="image" onClick="submit();" src="searchbutton.png" />
    	</h2>
		</form>
        <!-- end search engine -->
        
		<?php
		include("connection.php"); // link this page to connection.php
		
		$search=mysql_query("SELECT DISTINCT absent_letter.date AS date
							FROM absent_letter_sorter.absent_letter, school_db.studentlisttbl, school_db.classtbl
							WHERE studentlisttbl.Student_ID = absent_letter.Student_ID
							AND studentlisttbl.Class_ID = classtbl.Class_ID AND
							letters_given='1' AND studentlisttbl.Class_ID='$classid'
							ORDER by date DESC"); 
				// find the date where there are still missing letters
		
		$total=mysql_num_rows($search); // find the total records found

		if($total<1) // in case of no data found ...
		{
			echo("<p>No data available</p>"); // output no data available
		}
		else // in case of data found
		{ 
		?>
        
            <!-- output results -->
            <h1>Latest List:</h1>
            <center>
            <?php
            $dataperpage=5; // amount of data per page
            $totalpages=ceil($total/$dataperpage); // find total page
            
			include("pagination.php");
			
            $search=mysql_query("SELECT DISTINCT absent_letter.date AS date
								FROM absent_letter_sorter.absent_letter, school_db.studentlisttbl, school_db.classtbl
								WHERE studentlisttbl.Student_ID = absent_letter.Student_ID
								AND studentlisttbl.Class_ID = classtbl.Class_ID AND
								letters_given='1' AND studentlisttbl.Class_ID='$classid'
								AND studentlisttbl.Class_ID='$classid'
								ORDER by date DESC
								LIMIT $offset, $dataperpage");
				// repeat the previous query, this time, control the amount of data flow per page
            
            while($displaydate=mysql_fetch_array($search)) // put the query results into an array
            {
                $date=date_create($displaydate["date"]); // convert date into an object
            ?>
            
                <!-- construct the list -->
                <div class='list'>
                <table border='0' width='100%' cellspacing='0'><tr><td width='50%' align='center'>
                <br />
                <a href="letter.php?date=<?php echo($displaydate["date"]); ?>" class="link">
                <?php echo(date_format($date,"D,d M Y")); ?></a></td>
                <td align='center' width='50%' class='complete'><br />[complete]</td>
                </tr></table>
                </div>
                <br />
                <!-- end of construction -->
            <?php
            
            }
			include("paginationlink.php");
		}
	?>	<!-- show filter system -->
    	<table width="300" border="0" align="right" class="table">
      		<tr>
        		<td align="right">show:</td>
        		<td align="right"><a href="sort.php">all </a></td>
        		<td align="right"><a href="filtermissing.php">missing letters</a></td>
        		<td align="right">complete</td>
      		</tr>
    	</table>
        <!-- end filter system -->
		</center>	
		</div>
		</center>
		<center><div class="bottom"></div></center>
		</body>
		</html>

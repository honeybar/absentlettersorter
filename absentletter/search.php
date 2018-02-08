<?php
include("teacher_session.php");
include("update_absentees.php"); // link this page to update_absentees.php		
$date=date_format(date_create($_POST["date"]),"Y-m-d");

if(empty($_POST["date"]))
{
	header("location:searcherror.php");	
}
else
{
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>sort letter</title>
	<link href="stylesheet.css" rel="stylesheet" type="text/css" />
	</head>

	<body>
	<center><div class="content">
	<div class="top" align="right">
  	<p>Today's Date:<?php echo(date("D,d M Y")); ?></p>
     <!-- build menu -->
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
    <!-- end menu -->
	</div>
        
        <!-- building search engine -->
		<form action="search.php" method="POST"> 
        <!-- this is the inputbox for date search-->
    	<h2 align="right">Filter:<input type="date" name="date" placeholder="select a date..." />
      	<br />
        <!-- below is the submit button -->
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
				studentlisttbl.Class_ID='$classid'
				AND date='$date'");
		// search for absentees where the students belong to the user's class and date = $date
				
		$total=mysql_num_rows($search); // find the total no of records found 

		if($total<1) // if no record found...
		{
			echo("<h1 align='center'>No results found</h1>"); // output no results found
		}
		else // in case of records found
		{	
		?>
        
        <!-- output result -->
  		<h1>Search result:</h1>
		<center>
        
    	<?php
							
    	while($displaydate=mysql_fetch_array($search))
		{	
			$check=mysql_query("SELECT absent_letter.date FROM absent_letter_sorter.absent_letter, school_db.studentlisttbl, school_db.classtbl
								WHERE studentlisttbl.Student_ID = absent_letter.Student_ID
								AND studentlisttbl.Class_ID = classtbl.Class_ID  
								AND studentlisttbl.Class_ID='$classid'
								AND letters_given='0'
								AND absent_letter.date='$date'"); 
			// find whether a particular date has students forgot their absent letters
			
			$date=date_create($displaydate["date"]); // convert date into object
			
			$count=mysql_num_rows($check); 
			// count the no of missing absent letters on a particular date
		
			if($count>0) // in case of missing absent letters ...
			{ // output incomplete
		?>
            	<!-- construct a list -->
            	<div class='list'>
            	<table border='0' width='100%' cellspacing='0'><tr>
            	<td width='50%' align='center'>
                <br />
            	<a href="letter.php?date=<?php echo($displaydate["date"]); ?>" class="link">
				<?php echo(date_format($date,"D,d M Y")); // change the date format ?></a></td>
           		<td align='center' width='50%' class='incomplete'><br />[incomplete]</td>
            	</tr></table>
            	</div><br />
                <!-- end construction-->
        	<?php
			}
			else // if no missing letters ...
			{ // output complete
			?>
            	<!-- construct a list -->
				<div class='list'>
            	<table border='0' width='100%' cellspacing='0'><tr><td width='50%' align='center'>
                <br />
                <a href="letter.php?date=<?php echo($displaydate["date"]); ?>" class="link">
				<?php echo(date_format($date,"D,d M Y")); // change date format ?></a></td>
                <td align='center' class='complete'><br />[complete]</td>
                </tr></table>
                </div><br />
                 <!-- end construction-->
            <?php	
			}
		}
		}
		?>
		
    <!-- construct filter system to show the missing and complete missing letters date -->
    <table width="300" border="0" align="right" class="table">
      <tr>
        <td align="right">show:</td>
        <td align="right"><a href="sort.php">all</a></td>
        <td align="right"><a href="filtermissing.php">missing letters</a></td>
        <td align="right"><a href="filtercomplete.php">complete</a></td>
      </tr>
    </table>
    <!-- end construction -->
    </center>
	</center>	
	</div>
	</center>
	<center><div class="bottom"></div></center>
	</body>
	</html>
<?php
}
?>

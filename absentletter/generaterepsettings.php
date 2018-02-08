<?php
		
		$startdate=date_format(date_create($d1),"Y-m-d");	
		$enddate=date_format(date_create($d2),"Y-m-d");
	  	$start=strtotime($startdate);
	  	$end=strtotime($enddate);
	  	$diff=date("d",$end-$start);
		$date1=date_format(date_create($startdate),"D,d M Y");
		$date2=date_format(date_create($enddate),"D,d M Y");
		$dataperpage=15; // output 15 records in one page
		$getdata="&date1=$d1&date2=$d2"; // variables to be passed to other pages
		$deadline=date("D,d M Y",strtotime("this Friday")); // change the format of Friday
		
		/*** validation of $d1 and $d2 ***/

		if(empty($d1) OR empty($d2)) // in case both date1 and date2 empty
		{
			header("location:".$filename."error.php"); //direct to generateweekreperror.php
		}
		else
		{
			if($d1==$d2) // in case of both date entered the same
			{
				header("location:".$filename."error2.php"); 
				//direct to generateweekreperror2.php
			}
			else
			{
				if(strtotime($d1)>strtotime($d2)) 
				// in case of the first date entered is later than the second date
				{
						header("location:".$filename."error3.php");
						// direct to generateweekreperror3.php
				}
				else
				{
					if($diff>5) // if the interval between both dates greater than 5 days
						{
							header("location:".$filename."error4.php"); 
							// direct to generateweekreperror4.php
						}
				}
			}
		}
		/*** end of validation ***/
		
?>

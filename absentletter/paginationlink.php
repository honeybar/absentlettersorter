<?php
	/* build pagination link */

	echo("<table border='1' cellspacing='0' align='right' class='pagination'><tr><td 
	align='center'>page".$currentpage."of".$totalpages."</td>"); 
	// output table to contain the page no
	
  if(empty($getdata))
  {
	  $getdata="";
  }
	  if($currentpage>1) // if the user is not on page 1
  	  {
		 echo ("<td> <a href='{$_SERVER['PHP_SELF']}?currentpage=1".$getdata."'>first page
		 		</a></td>");  
		 // show link to go back to the first page	
	}
		$range=5; // indicate the no of page displayed
		
 		 for($i=$currentpage-$range;$i<($currentpage+$range)+1;$i++)
  		 {
			if($i>0 && $i<=$totalpages) // in case of valid page no
			{
				if($i==$currentpage) // if the currentpage is equal to $i
					{
						 echo ("<td><center><b>$i</b></td>"); //don't make the said page no a link
      				} 
	  				else 
	  				{    // if not current page
						
        				 echo("<td><a href='{$_SERVER['PHP_SELF']}?currentpage=$i".$getdata."'>$i</a></td>");
						 // make it a link
					}	
			}
	   }
       
	if($currentpage != $totalpages) // if not on lastpage 
	{
		echo("<td><a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages".$getdata."'>last page</a></td></tr>
		</table>"); //show link for the last page
	} 
  echo("</tr></table>"); // close table
  /* end pagination link */

?>
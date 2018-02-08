<?php
$today=date("Y-m-d"); 
$data2=mysql_query("SELECT absent_tbl.date AS date, absent_tbl.letters_given AS status, studentlisttbl.Student_Name AS Name, classtbl.Class AS class FROM absent_tbl, studentlisttbl, classtbl WHERE absent_tbl.student_id=studentlisttbl.Student_ID AND absent_tbl.class_id=classtbl.Class_ID AND date='$today' ORDER BY class, Name");

mysql_select_db("paper4",$con);

$data1=mysql_query("SELECT form_table.Date AS date, student_table.Student_name AS Name, class_table.Class_name AS class FROM student_table, class_table, form_table WHERE student_table.Student_id=form_table.Student_id AND student_table.Class_id=class_table.Class_id AND date='$today' ORDER BY class, Name");

$totallate=mysql_num_rows($data1);
$totalabsent=mysql_num_rows($data2);
if($totalabsent==0 && $totallate==0)
	{
		echo("<br><br><br><h2 align='center'>No data available yet</h2> <p align='center'><a href='report.php'>go back</a></p>");
	}
	else
	{
mysql_select_db("attendancedb",$con);

$data2=mysql_query("SELECT absent_tbl.date AS date, absent_tbl.letters_given AS status, studentlisttbl.Student_Name AS Name, classtbl.Class AS class FROM absent_tbl, studentlisttbl, classtbl WHERE absent_tbl.student_id=studentlisttbl.Student_ID AND absent_tbl.class_id=classtbl.Class_ID AND date='$today' ORDER BY class, Name LIMIT $offset, $dataperpage");

mysql_select_db("paper4",$con);

$data1=mysql_query("SELECT form_table.Date AS date, student_table.Student_name AS Name, class_table.Class_name AS class FROM student_table, class_table, form_table WHERE student_table.Student_id=form_table.Student_id AND student_table.Class_id=class_table.Class_id AND date='$today' ORDER BY class, Name LIMIT $offset, $dataperpage");
?>
  <p align="right"><?php echo(date("D,d M Y")); ?> </p>   
   <?php
	if($totallate>0)
	{
	?>
    <table width="45%" border="1" cellpadding="0" cellspacing="0" class="table" style="float:left">
        <tr>
     <td colspan="2" align="center"> <p>Late Comers</p></td></tr>
     <tr>
        
          <td width="71%"><strong>Name</strong></td>
          <td width="29%"><strong>Class</strong></td>
        </tr>
        <?php
		while($row=mysql_fetch_array($data1))
		{
			?>
        <tr>
          <td><?php echo($row["Name"]); ?></td>
          <td><?php echo($row["class"]); ?></td>
        </tr>
        <?php
		}
      echo("</table>");
	}
	else
	{?>
    	    <table width="45%" border="1" cellpadding="0" cellspacing="0" class="table" style="float:left" align="center"><tr>
		<td align='center'><p>No Late comers</p></td></tr></table>
        <?php	
	}
	if($totalabsent>0)
	{
	?>
      <table width="45%" border="1" cellpadding="0" cellspacing="0" class="table" >
      <tr>
      <td colspan="2" align="center"><p>Absentees</p></td></tr>
        <tr>
          <td width="71%"><strong>Name</strong></td>
          <td width="29%"><strong>Class</strong></td>
        </tr>
        <?php
		while($row=mysql_fetch_array($data2))
			{
					
		?>
        <tr>
          <td><?php echo($row["Name"]); ?></td>
          <td><?php echo($row["class"]); ?></td>
        </tr>
 		<?php
			}
      echo("</table></td>");
	}
	else
	{
		?>
        <table width="45%" border="1" cellpadding="0" cellspacing="0" class="table" align="center">
        <tr>
		<td align='center'><p>No absentees</p></td></tr></table>
        <?php
	}
	
	?>
    </tr>
  </table>
</body>
</html>
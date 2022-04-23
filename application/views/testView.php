<style type="text/css">
	table,th,td{
		border: 1px solid black;
	}
	td{
		text-align: center;
	}
</style>
<h3>Student Details</h3>
<a href="http://localhost/TestProject/index.php/testController/addData"><button>Add New Student</button></a>
<br><br>
<table>
	<tr>
		<th>Roll No</th>
		<th>Name</th>
		<th>Class</th>
		<th>Section</th>
		<th>Action</th>
	</tr>
		<?php  
         foreach ($data->result() as $row)  
         {  
            ?><tr>  
		        <td><?php echo $row->student_roll_no;?></td>  
		        <td><?php echo $row->student_name;?></td>  
		        <td><?php echo $row->student_class;?></td>
		        <td><?php echo $row->student_section;?></td>
		        <td><a href="http://localhost/TestProject/index.php/testController/editDataView?rollno=<?php echo $row->student_roll_no ; ?>"><button name="edit">EDIT</button></a>
		        	<a href="http://localhost/TestProject/index.php/testController/deleteData<?php $row->student_roll_no; ?>"><button name="delete">DELETE</button></a></td>
            </tr>  
         <?php }  
         ?>
</table>
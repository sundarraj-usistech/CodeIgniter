<style type="text/css">
	table,th,td{
		border: solid black;
	}
	td{
		text-align: center;
	}
	.method{
		display: flex;
		justify-content: space-between;
	}
</style>
<h3>Student Details</h3>
<a href="http://localhost/CodeIgniter/index.php/testController/addDataView"><button>Add New Student</button></a>
<br><br>
<div class="method">
	<form method="post" action="http://localhost/CodeIgniter/index.php/testController/pagination">
			<label>Number of Rows to display</label>
			<input type="number" name="page">
			<button type name="submit">SELECT</button>
	</form>
</div>
<table width="50%" align="center">
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
		        <td><a href="http://localhost/CodeIgniter/index.php/testController/editDataView?rollno=<?php echo $row->student_roll_no ; ?>"><button name="edit">EDIT</button></a>
		        	<a href="http://localhost/CodeIgniter/index.php/testController/deleteDataView?rollno=<?php echo $row->student_roll_no; ?>"><button name="delete">DELETE</button></a></td>
            </tr>  
         <?php }  
         ?>
</table>
<br>
<div align="center"><?php echo $this->pagination->create_links(); ?></div>

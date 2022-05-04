
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<title>Students Details</title>
</head>
<body>
	
	<style type="text/css">
		table,th,td{
			border: 1px solid black;
		}
		th,td{
			text-align: center;
		}
		.method{
			display: flex;
			justify-content: space-between;
		}
	</style>
</body>
</html>
<h3>Student Details</h3>
<a href="http://localhost/CodeIgniter/index.php/testController/addDataView"><button class="btn btn-primary">Add New Student</button></a>
<br><br>
<div class="method">
	<form method="get" action="http://localhost/CodeIgniter/index.php/testController/index">
			<label>Number of Rows to display</label>
			<input type="number" name="page">
			<button  type="submit" name="submitrows" class="btn btn-success">SELECT</button>
	</form>
	<form method="post" action="http://localhost/CodeIgniter/index.php/testController/sortTable">
		<label>Choose a Sorting Method</label>
		<select name="sort">
			<option></option>
			<option value="sortrollnoasc">Sort by Roll Number in ascending</option>
			<option value="sortrollnodesc">Sort by Roll Number in descending</option>
			<option value="sortnameasc">Sort by Name in ascending</option>
			<option value="sortnamedesc">Sort by Name in descending</option>
			<option value="sortclassasc">Sort by Class in ascending</option>
			<option value="sortclassdesc">Sort by Class in descending</option>
		</select>
		<button type="submit" name="submitsort" class="btn btn-success">SUBMIT</button>
	</form>
	<!-- <form method="post" action="http://localhost/CodeIgniter/index.php/testController/">
		<label>Choose a Filter Method</label>
		<select name="filter">
			<option></option>
			<option value="filterbyclass">Class</option>
			<option value="filterbysection">section</option>
		</select>
		<button type="submit" name="submitfilter" class="btn btn-success">SUBMIT</button>
	</form> -->
</div>
<table width="100%" align="center" id="student_details" class="table table-bordered table-striped table-hover">
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
		        <td><a href="http://localhost/CodeIgniter/index.php/testController/fileUploadView?rollno=<?php echo $row->student_roll_no ; ?>"><button name="fileupload" class="btn btn-info">FILE UPLOAD</button></a>
		        	<a href="http://localhost/CodeIgniter/index.php/testController/editDataView?rollno=<?php echo $row->student_roll_no ; ?>"><button name="edit" class="btn btn-warning">EDIT</button></a>
		        	<a href="http://localhost/CodeIgniter/index.php/testController/deleteDataView?rollno=<?php echo $row->student_roll_no; ?>"><button name="delete" class="btn btn-danger">DELETE</button></a></td>
            </tr>  
         <?php }  
         ?>
</table>
<br>
<div align="center"><?php echo $this->pagination->create_links(); ?></div>

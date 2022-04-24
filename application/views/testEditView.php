<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Details</title>
</head>
<body>
	<form method="post" action="http://localhost/CodeIgniter/index.php/testController/editData">
		<table>
			<?php 
				foreach($data->result() as $row){ ?>
					<tr><td><input type="hidden" name="old_roll_no" value="<?php echo $row->student_roll_no ?>" readonly ></td></tr>
					<tr><td><label>Roll Number</label></td>
					<td><input type="text" name="roll_no" value="<?php echo $row->student_roll_no ?>"></td></tr>
					<tr><td><label>Name</label></td>
					<td><input type="text" name="name" value="<?php echo $row->student_name ?>"></td></tr>
					<tr><td><label>Class</label></td>
					<td><input type="text" name="class" value="<?php echo $row->student_class ?>"></td></tr>
					<tr><td><label>Section</label></td>
					<td><input type="text" name="section" value="<?php echo $row->student_section ?>"></td></tr>
		<?php	}
			?>			
		</table>
		<br><br>
		<button type="submit" name="update">UPDATE</button>
	</form>
</body>
</html>
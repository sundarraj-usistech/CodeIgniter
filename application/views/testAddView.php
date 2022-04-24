<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Details</title>
</head>
<body>
	<form method="post" action="http://localhost/CodeIgniter/index.php/testController/addData">
		<table>
					<tr><td><label>Roll Number</label></td>
					<td><input type="text" name="roll_no"></td></tr>
					<tr><td><label>Name</label></td>
					<td><input type="text" name="name"></td></tr>
					<tr><td><label>Class</label></td>
					<td><input type="text" name="class"></td></tr>
					<tr><td><label>Section</label></td>
					<td><input type="text" name="section"></td></tr>	
		</table>
		<br><br>
		<button type="submit" name="add">ADD</button>
	</form>
</body>
</html>
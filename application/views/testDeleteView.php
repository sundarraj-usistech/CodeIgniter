<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<title>Delete Details</title>
</head>
<body>
	<style type="text/css">
		.btn-custom3 {
    		color: #212529;
    		background-color: #adb5bd;
    		border-color: #adb5bd;
		}
	</style>
	<div class="alert alert-danger">
    	<strong>You are about to Delete this Person's Details !</strong>
  	</div>
	<form method="post" action="<?= base_url(); ?>index.php/testController/deleteData">
		<table class="table table-bordered">
			<?php 
				foreach($data->result() as $row){ ?>
					<tr><td><label>Roll Number</label></td>
					<td><input type="text" name="roll_no" value="<?php echo $row->student_roll_no ?>" readonly></td></tr>
					<tr><td><label>Name</label></td>
					<td><input type="text" name="name" value="<?php echo $row->student_name ?>" readonly></td></tr>
					<tr><td><label>Class</label></td>
					<td><input type="text" name="class" value="<?php echo $row->student_class ?>" readonly></td></tr>
					<tr><td><label>Section</label></td>
					<td><input type="text" name="section" value="<?php echo $row->student_section ?>" readonly></td></tr>
		<?php	}
			?>			
		</table>
		<br>
		<div>
			<button type="submit" name="delete" class="btn btn-danger">DELETE</button>
		</div>
	</form>
</body>
</html>
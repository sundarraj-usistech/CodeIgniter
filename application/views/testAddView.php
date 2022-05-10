<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<title>Add Details</title>
</head>
<style type="text/css">
	.btn-custom1 {
    		color: #212529;
    		background-color: #6b8504a3;
    		border-color: #6b8504a3;
	}
	.btn-custom3 {
    		color: #212529;
    		background-color: #adb5bd;
    		border-color: #adb5bd;
		}
	.border-hide{
		outline: none;
		border: none;
		background-color: #f7f7f775;
	}
	.container{
		width: 50%;
	}
</style>
<body>
	<div class="container">
		<div class="alert alert-info mt-5">
    	<strong>You are about to create a New Person's Details !</strong>
  	</div>
	<form method="post" action="<?= base_url(); ?>index.php/testController/addData">
		<?php echo validation_errors(); ?>  
        <?php echo form_open('form'); ?>  
		<table class="table">
					<tr><td><label>Roll Number</label></td>
					<td><input class="border-hide" type="text" name="roll_no" ></td></tr>
					<tr><td><label>Name</label></td>
					<td><input class="border-hide" type="text" name="name" ></td></tr>
					<tr><td><label>Class</label></td>
					<td><input class="border-hide" type="text" name="class" ></td></tr>
					<tr><td><label>Section</label></td>
					<td><input class="border-hide" type="text" name="section" ></td></tr>	
		</table>
		<br>
		<div>
			<button type="submit" name="add" class="btn btn-custom1">ADD</button>
		</div>
	</form>
	</div>
</body>
</html>

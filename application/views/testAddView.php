<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<title>Add Details</title>
</head>
<style type="text/css">
	td {
  			text-align: center;
 			vertical-align: middle;
	}
	.btn-custom1 {
    		color: #212529;
    		background-color: #fd7e14;
    		border-color: #fd7e14;
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
		width: 30%;
	}
	
</style>
<body>
	<div class="container">
		<div class="alert alert-info mt-5" align="center">
    		<strong>You are about to create a New User Details !</strong>
  		</div>
  		<div align="right">
	  		<a href="javascript:window.history.go(-1);"><button name="back" class="btn btn-dark">BACK</button></a>
	  	</div>
		<form method="post" action="<?= base_url(); ?>index.php/testController/addData">
			<?php echo validation_errors(); ?>  
	        <?php echo form_open('form'); ?>  
			<table class="table table-borderless mt-5" align="center">
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
			<div align="center">
				<button type="submit" name="add" class="btn btn-custom1">ADD</button>
			</div>
		</form>
	</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<title>Edit Details</title>
</head>
<body>
	<style type="text/css">
		td {
  			text-align: center;
 			vertical-align: middle;
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
	<div class="container">
		<div class="alert alert-warning mt-5" align="center">
    		<strong>You are about to Edit this Person's Details !</strong>
  		</div>
  		<div align="right">
	  		<a href="javascript:window.history.go(-1);"><button name="back" class="btn btn-dark">BACK</button></a>
	  	</div>
		<form method="post" action="<?= base_url(); ?>index.php/testController/editData">
			<table class="table table-borderless mt-5" align="center">
				<?php 
					foreach($data->result() as $row){ ?>
						<tr><td><input class="border-hide" type="hidden" name="old_roll_no" value="<?php echo $row->student_roll_no ?>" readonly ></td></tr>
						<tr><td><label>Roll Number</label></td>
						<td><input class="border-hide" type="text" name="roll_no" value="<?php echo $row->student_roll_no ?>" required></td></tr>
						<tr><td><label>Name</label></td>
						<td><input class="border-hide" type="text" name="name" value="<?php echo $row->student_name ?>" required></td></tr>
						<tr><td><label>Class</label></td>
						<td><input class="border-hide" type="text" name="class" value="<?php echo $row->student_class ?>" required></td></tr>
						<tr><td><label>Section</label></td>
						<td><input class="border-hide" type="text" name="section" value="<?php echo $row->student_section ?>" required></td></tr>
			<?php	}
				?>			
			</table>
			<br>
			<div align="center">
				<button type="submit" name="update" class="btn btn-warning">UPDATE</button>
			</div>
		</form>
	</div>
	
</body>
</html>
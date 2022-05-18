<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<title>Sign Up</title>

</head>

<body>

	<style type="text/css">

		td {
  			text-align: center;
 			vertical-align: middle;
		}

		.btn-custom1 {
    		color: #212529;
    		background-color: #6b8504a3;
    		border-color: #6b8504a3;
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

	<div class="container">
		<?php
			if (isset($data)) {

		?>		<div class="alert alert-warning mt-5" align="center">
	    			<strong><?php echo $data; ?></strong>
	  			</div>

		<?php	}
			else{
				$data="";
			}
		?>
		<form method="post" action="<?= base_url(); ?>index.php/mainController/signup">

			<table class="table table-borderless mt-5" align="center">
						<tr><td><label>UserName</label></td>
						<td><input class="border-hide" type="text" name="username" required></td></tr>
						<tr><td><label>Password</label></td>
						<td><input class="border-hide" type="password" name="password" required></td></tr>
						<tr><td><label>Confirm Password</label></td>
						<td><input class="border-hide" type="password" name="confirmpassword" required></td></tr>
			</table>

			<div align="center">
				<button type="submit" name="login" class="btn btn-primary">SIGNUP</button>
			</div>

		</form>

		<br><br>

		<p align="center"><b>Existing User &nbsp? &nbsp Login Here &nbsp</b><a href="<?= base_url(); ?>index.php/mainController/loginView" style="text-decoration: none;"><button type="submit" name="login" class="btn btn-success">LOGIN</button></a></p>

	</div>
	
</body>
</html>
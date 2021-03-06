<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<title>Login</title>

</head>

<body>

	<style type="text/css">

		td {
  			text-align: center;
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
		
		<div class="container">
		<?php
			if (isset($err_msg)) {

		?>		<div class="alert alert-warning mt-5">
	    			<strong><?php echo $err_msg; ?></strong>
	  			</div>

		<?php	}
			else{
				$err_msg="";
			}
		?>
		<form method="post" action="<?= base_url(); ?>mainController/loginCheck">

			<table class="table table-borderless mt-5" align="center">
						<tr><td><label>User Name</label></td>
						<td><input class="border-hide" type="text" name="username" required></td></tr>
						<tr><td><label>Password</label></td>
						<td><input class="border-hide" type="password" name="password" required></td></tr>	
			</table>

			<div align="center">
				<button type="submit" name="login" class="btn btn-success">LOGIN</button>
		</form>
			</div>

			<br><br>

			<p align="center"><b>New User &nbsp? &nbsp SignUp Here &nbsp</b><a href="<?= base_url(); ?>mainController/signupView" style="text-decoration: none;"><button type="submit" name="signup" class="btn btn-primary">SIGNUP</button></a></p>

		</div>

	</div>
	
</body>
</html>
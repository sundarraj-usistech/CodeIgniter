<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<title>Login</title>
</head>
<body>
	<style type="text/css">
		.btn-custom1 {
    		color: #212529;
    		background-color: #6b8504a3;
    		border-color: #6b8504a3;
		}
	</style>
	<?php
		if (isset($data)) {
	?>		<div class="alert alert-warning">
    			<strong><?php echo $data; ?></strong>
  			</div>
	<?php	}
		else{
			$data="";
		}
	?>
	<form method="post" action="<?= base_url(); ?>index.php/testController/loginCheck">
		<table class="table table-bordered">
					<tr><td><label>UserName</label></td>
					<td><input type="text" name="username" required></td></tr>
					<tr><td><label>Password</label></td>
					<td><input type="text" name="password" required></td></tr>	
		</table>
		<div>
			<button type="submit" name="login" class="btn btn-success">LOGIN</button>
		</div>
	</form>
</body>
</html>
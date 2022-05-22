<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

		<?php echo validation_errors(); 
				echo form_open(); ?>

		<h5>Username</h5>
		<input type="text" name="username" value="" size="50" />

		<h5>Password</h5>
		<input type="text" name="password" value="" size="50" />

		<h5>Password Confirm</h5>
		<input type="text" name="passconf" value="" size="50" />

		<div><input type="submit" value="Submit" /></div>
		<?php echo form_close(); ?>
</body>
</html>
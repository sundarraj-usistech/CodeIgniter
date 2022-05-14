<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Picture Upload</title>
</head>
<body>
	<form method="post" action="<?= base_url(); ?>index.php/testController/pictureUpload" enctype="multipart/form-data">
		<label>Choose a Picture</label>
		<input type="file" name="picture"><br>
		<input type="submit" name="submit" value="Upload">
	</form>
</body>
</html>
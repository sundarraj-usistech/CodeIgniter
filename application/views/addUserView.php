
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
<?php 	if ($this->session->userdata('username')) { ?>
	
			<div class="container">

				<div class="alert alert-info mt-5" align="center">
		    		<strong>You are about to create a New User Details !</strong>
		  		</div>

		  		<div align="right">
			  		<a href="javascript:window.history.go(-1);" style="text-decoration: none;"><button name="back" class="btn btn-dark">BACK</button></a>
			  	</div>

			  <!-- 	<nav class="pb-5" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns= 'http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath' d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34';);" aria-label="breadcrumb">
			      <ol class="breadcrumb">
			        <li class="breadcrumb-item"><a class="fw-bold text-dark" href="<?= base_url(); ?>mainController/view">HOME</a></li>
			        <li class="breadcrumb-item active" aria-current="page">Add Details</li>
			      </ol>
			    </nav>
 -->
				<form method="post" action="<?= base_url(); ?>mainController/addUser">

					<table class="table table-borderless mt-5" align="center">          
								<tr><td><label>Roll Number</label></td>
								<td><input class="border-hide" type="text" name="roll_no" required></td></tr>
								<tr><td><label>Name</label></td>
								<td><input class="border-hide" type="text" name="name" required></td></tr>
								<tr><td><label>Class</label></td>
								<td><input class="border-hide" type="text" name="class" required></td></tr>
								<tr><td><label>Section</label></td>
								<td><input class="border-hide" type="text" name="section" required></td></tr>	
					</table>

					<br>

					<div align="center">
						<button type="submit" name="add" class="btn btn-primary">ADD</button>
					</div>

				</form>

			</div>
<?php   }
		else{ ?>

			<div class="container" align="center">

				<div class="alert alert-danger mt-5">
					<strong><?php echo "Not Logged in !"?></strong>
				</div>

				<div align="center">
					<a href="<?= base_url(); ?>mainController/loginView" style="text-decoration: none;"><button name="login" class="btn btn-success">LOGIN</button></a>

					<br><br>

					<b>New User &nbsp? &nbsp SignUp Here &nbsp</b><a href="<?= base_url(); ?>mainController/signupView" style="text-decoration: none;"><button type="submit" name="signup" class="btn btn-primary">SIGNUP</button></a>
				</div>

			</div>

<?php 	} ?>	


</body>
</html>

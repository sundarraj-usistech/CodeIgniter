<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<title>View Details</title>

</head>

<body>

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
			width: 50%;
		}
	</style>

<?php 	if ($this->session->userdata('username')) { ?>

			<div class="container">

				<form method="post" action="">

				<table class="table table-borderless mt-5" align="center">
					<?php 
						foreach($data->result() as $row){ ?>
							<tr><td><label>Roll Number</label></td>
							<td><input class="border-hide" type="text" name="roll_no" value="<?php echo $row->student_roll_no ?>" readonly></td></tr>
							<tr><td><label>Name</label></td>
							<td><input class="border-hide" type="text" name="name" value="<?php echo $row->student_name ?>" readonly></td></tr>
							<tr><td><label>Class</label></td>
							<td><input class="border-hide" type="text" name="class" value="<?php echo $row->student_class ?>" readonly></td></tr>
							<tr><td><label>Section</label></td>
							<td><input class="border-hide" type="text" name="section" value="<?php echo $row->student_section ?>" readonly></td></tr>
							<tr><td><label>Document</label></td>
							<td>
								<?php
									if ($row->student_document==null) { ?>

										<input  class="border-hide"type="text" name="file" value="<?php echo "No Document found" ?>" readonly>
										<a href="<?= base_url(); ?>mainController/fileUploadView?rollno=<?php echo $row->student_roll_no ; ?>" style="text-decoration: none;"><span class="btn btn-primary">UPLOAD</span></a>
							<?php	}
									else{ ?>
										<input  class="border-hide"type="text" name="file" value="<?php echo $row->student_document ?>" readonly>
										<a href="\CodeIgniter\student_document\<?php echo $row->student_document; ?>" target="_blank"><span class="btn btn-primary">VIEW</span></a>
							<?php	}
								?>
							</td></tr>

							<tr><td><label>Image</label></td>
							<td>
								<?php
									if ($row->student_image==null) { ?>
										<input  class="border-hide"type="text" name="image" value="<?php echo "No Image found" ?>" readonly>
										<a href="<?= base_url(); ?>mainController/imageUploadView?rollno=<?php echo $row->student_roll_no ; ?>" style="text-decoration: none;"><span class="btn btn-primary">UPLOAD</span>
							<?php	}
									else{ ?>
										<input  class="border-hide"type="text" name="image" value="<?php echo $row->student_image ?>" readonly>
										<a href="\CodeIgniter\student_image\<?php echo $row->student_image; ?>" target="_blank"><span class="btn btn-primary">VIEW</span></a>
							<?php	}
								?>
							<td></tr>
				<?php	}
					?>			
				</table>

			</form>

				<div align="center">
					<a href="javascript:window.history.go(-1);"><span name="back"  class="btn btn-dark">BACK</span></a>
				</div>

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
<?php   } ?>  

	
</body>
</html>

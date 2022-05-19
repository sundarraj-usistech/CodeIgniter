
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<script defer src="https://use.fontawesome.com/releases/v6.1.1/js/all.js" integrity="sha384-xBXmu0dk1bEoiwd71wOonQLyH+VpgR1XcDH3rtxrLww5ajNTuMvBdL5SOiFZnNdp" crossorigin="anonymous"></script>

	<title>Student Details</title>
</head>

<body>
	
	<style type="text/css">

		table,th,td{
			border: 1px solid black;
		}

		th,td{
			text-align: center;
		}

		.method{
			display: flex;
			justify-content: space-between;
		}

		.btn-custom1 {
    		color: #ffffff;
    		background-color: #fd7e14;
    		border-color: #fd7e14;
		}

		.btn-custom2 {
    		color: #ffffff;
    		background-color: #3ddf9494;
    		border-color: #3ddf9494;
		}

		.btn-custom3 {
    		color: #ffffff;
    		background-color: #adb5bd;
    		border-color: #adb5bd;
		}

		.btn-custom4{
			color: #ffffff;
    		background-color: #dc3535ed;
    		border-color: #dc3535ed;
		}

		.btn-warning{
			color: #ffffff;
		}

		.btn-info{
			color: #ffffff;
		}

		.container{
			width: 50%;
		}

	</style>

	<?php 

		if ($this->session->userdata('username')) { ?>

			<div class="container">
				<h3 class="mt-5">Student Details</h3>

				<br>

				<div align="right">Logged in as 
					<span class="badge bg-success" style="padding: 10px;">
						<b><?php echo $this->session->userdata('username'); ?></b>
					</span>

					<br>

					<span>
						Logged in on <b><?php echo $this->session->userdata('last_login'); ?></b>
					</span>
				</div>

				<br>

				<div class="method">
					<a href="<?= base_url(); ?>index.php/mainController/addUserView" style="text-decoration: none;"><button class="btn btn-custom1">Add New Student&nbsp&nbsp<i class="fa-solid fa-plus"></i></button></a>

					<a href="<?= base_url(); ?>index.php/mainController/logout" style="text-decoration: none;"><button class="btn btn-custom3">LOGOUT&nbsp&nbsp<i class="fa-solid fa-right-from-bracket"></i></button></a>
				</div>

				<br><br>

				<div class="method">

					<form method="get" action="<?= base_url(); ?>index.php/mainController/customPagination">
							<label>Display</label>
							<select name="perPage" required>
								<option></option>
								<option>5</option>
								<option>10</option>
								<option>15</option>
							</select>
							<label>Entries&nbsp</label>
							<button  type="submit" name="submitrows" class="btn btn-success">SELECT</button>
					</form>

			   <!-- <form method="post" action="http://localhost/CodeIgniter/index.php/mainController/sortTable">
						<label>Choose a Sorting Method</label>
						<select name="sort">
							<option></option>
							<option value="sortrollnoasc">Sort by Roll Number in ascending</option>
							<option value="sortrollnodesc">Sort by Roll Number in descending</option>
							<option value="sortnameasc">Sort by Name in ascending</option>
							<option value="sortnamedesc">Sort by Name in descending</option>
							<option value="sortclassasc">Sort by Class in ascending</option>
							<option value="sortclassdesc">Sort by Class in descending</option>
						</select>
						<button type="submit" name="submitsort" class="btn btn-success">SUBMIT</button>
					</form> -->

					<form method="post" action="<?= base_url(); ?>index.php/mainController/searchData">
						<input type="text" name="keyword" placeholder="Search " required>

						<button type="submit" name="submitfilter" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
					</form>

					<a target="_blank" href="<?= base_url(); ?>index.php/mainController/GeneratePdf" style="text-decoration: none;"><button name="pdf" class="btn btn-custom4"><i class="fa-solid fa-file-pdf"></i></button></a>

					<a target="_blank" href="<?= base_url(); ?>index.php/mainController/datatable" style="text-decoration: none;"><button name="datatable" class="btn btn-success"><i class="fa-solid fa-table-cells"></i>&nbspDATATABLES</button></a>

					<?php 
					if ($flag) {
					?>
	  					<a href="javascript:window.history.go(-1);" style="text-decoration: none;"><button name="back" class="btn btn-dark">BACK</button></a>
	  			<?php	
					}
				?>
				</div>

				<br>
				<?php
						if (isset($err_msg)) {

					?>		<div class="alert alert-danger mt-5" align="center">
				    			<strong>
				    				<?php echo $err_msg; 
				    				die();
				    			?>
				    			</strong>
				  			</div>

					<?php	}

						else{
							$msg="";
						}
					?>

				<div class="table-responsive">

					<table align="center" id="student_details" class="table table-border table-striped table-hover" >

					<tr>

						<?php 

							$action=$this->input->get('action');

							if($action=='asc'){
							      $action='desc';
							}
							else{
							      $action='asc';
							}

						 ?>

						<th><a href="<?= base_url(); ?>index.php/mainController/sortByName?action=<?= $action ?>" class="text-decoration-none text-dark">NAME</th>
						<th>ACTION</th>
						<th>UPLOAD</th>
					</tr>

						<?php  
				         foreach ($data->result() as $row)  
				         {  
				            ?><tr>
						        <td><?php echo $row->student_name;?></td>  
						        <td>
						        	<a href="<?= base_url(); ?>index.php/mainController/editUserView?rollno=<?php echo $row->student_roll_no ; ?>" style="text-decoration: none;"><button name="edit" class="btn btn-warning">EDIT</button></a>
						        	<a href="<?= base_url(); ?>index.php/mainController/deleteUserView?rollno=<?php echo $row->student_roll_no; ?>" style="text-decoration: none;"><button name="delete" class="btn btn-danger">DELETE</button></a>
						        	<a href="<?= base_url(); ?>index.php/mainController/viewUserDetails?rollno=<?php echo $row->student_roll_no ; ?>" style="text-decoration: none;"><button name="view" class="btn btn-primary">VIEW</button></a>
						        </td>						       
						        	<td><a href="<?= base_url(); ?>index.php/mainController/fileUploadView?rollno=<?php echo $row->student_roll_no ; ?>" style="text-decoration: none;"><button name="fileupload" class="btn btn-info">FILE</button></a>
						        		<a href="<?= base_url(); ?>index.php/mainController/imageUploadView?rollno=<?php echo $row->student_roll_no ; ?>" style="text-decoration: none;"><button name="imageupload" class="btn btn-custom2">IMAGE</button>
						        </td>
				           	</tr>  
				         <?php }  
				         ?>
					</table>

				</div>	

				<br>

				<?php 
					if($custompage){
				?>		

						<div align="center">

				<?php		for ($i=1; $i<=$totalPages; $i++) {
					?>
   								<a href="<?= base_url(); ?>index.php/mainController/customPagination?page=<?= $i ?>&perPage=<?= $perPage ?>" style="text-decoration: none;"><span class="btn btn-primary"><?= $i ?></span></a> 							
				<?php		}

				?>
						</div>

			<?php	}
					else{
				?>
						<div align="center"><?php echo $this->pagination->create_links(); ?></div>

			<?php	}

				
		}

		else{ ?>

			<div class="container" align="center">

				<div class="alert alert-danger mt-5">
					<strong><?php echo "Not Logged in !"?></strong>
				</div>

				<div align="center">
					<a href="<?= base_url(); ?>index.php/mainController/loginView" style="text-decoration: none;"><button name="login" class="btn btn-success">LOGIN</button></a>

					<br><br>

					<b>New User &nbsp? &nbsp SignUp Here &nbsp</b><a href="<?= base_url(); ?>index.php/mainController/signupView" style="text-decoration: none;"><button type="submit" name="signup" class="btn btn-primary">SIGNUP</button></a>
				</div>

			</div>

<?php 	} ?>	
	</div>

</body>
</html>


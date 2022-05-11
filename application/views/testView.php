
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<title>Students Details</title>
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
    		color: #212529;
    		background-color: #fd7e14;
    		border-color: #fd7e14;
		}
		.btn-custom2 {
    		color: #212529;
    		background-color: #3ddf9494;
    		border-color: #3ddf9494;
		}
		.btn-custom3 {
    		color: #212529;
    		background-color: #adb5bd;
    		border-color: #adb5bd;
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
				<div align="right">
					Logged in as <b> <?php echo $this->session->userdata('username'); ?> </b>
				</div>
				<br>
				<div class="method">
					<a href="<?= base_url(); ?>index.php/testController/addDataView"><button class="btn btn-custom1">Add New Student</button></a>
					<a href="<?= base_url(); ?>index.php/testController/logout"><button class="btn btn-custom3">LOGOUT</button></a>
				</div>
				<br><br>
				<div class="method">
					<!-- <form method="post" action="http://localhost/CodeIgniter/index.php/testController/index">
							<label>Number of Rows to display</label>
							<select name="per_page">
								<option>5</option>
								<option>10</option>
								<option>15</option>
							</select>
							<button  type="submit" name="submitrows" class="btn btn-success">SELECT</button>
					</form> -->
			   <!-- <form method="post" action="http://localhost/CodeIgniter/index.php/testController/sortTable">
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
					<form method="post" action="<?= base_url(); ?>index.php/testController/searchData">
						<input type="text" name="keyword" placeholder="Enter the text here " required>
						<button type="submit" name="submitfilter" class="btn btn-success">SEARCH</button>
					</form>
					<a href="<?= base_url(); ?>index.php/testController/pdfDownload"><button>PDF</button></a>
					<?php 
					if ($flag) {
					?>
	  					<a href="javascript:window.history.go(-1);"><button name="back" class="btn btn-dark">BACK</button></a>
	  			<?php	
					}
				?>
				</div>
				<br>
				<?php
						if (isset($err_msg)) {
					?>		<div class="alert alert-danger mt-5" align="center">
				    			<strong><?php echo $err_msg; 
				    				die();
				    		?></strong>
				  			</div>
					<?php	}
						else{
							$msg="";
						}
					?>
				<table align="center" id="student_details" class="table table-border table-striped table-hover">
					<tr>
						<th>NAME</th>
						<th>ACTION</th>
						<th>UPLOAD</th>
					</tr>
						<?php  
				         foreach ($data->result() as $row)  
				         {  
				            ?><tr>
						        <td><?php echo $row->student_name;?></td>  
						        <td><a href="<?= base_url(); ?>index.php/testController/viewAllDetails?rollno=<?php echo $row->student_roll_no ; ?>"><button name="view" class="btn btn-primary">VIEW</button></a>
						        	<a href="<?= base_url(); ?>index.php/testController/editDataView?rollno=<?php echo $row->student_roll_no ; ?>"><button name="edit" class="btn btn-warning">EDIT</button></a>
						        	<a href="<?= base_url(); ?>index.php/testController/deleteDataView?rollno=<?php echo $row->student_roll_no; ?>"><button name="delete" class="btn btn-danger">DELETE</button></a></td>
						        	<td><a href="<?= base_url(); ?>index.php/testController/fileUploadView?rollno=<?php echo $row->student_roll_no ; ?>"><button name="fileupload" class="btn btn-info">FILE</button></a>
						        		<a href="<?= base_url(); ?>index.php/testController/imageUploadView?rollno=<?php echo $row->student_roll_no ; ?>"><button name="imageupload" class="btn btn-custom2">IMAGE</button></td>
				            </tr>  
				         <?php }  
				         ?>
				</table>
				<br>
				<div align="center"><?php echo $this->pagination->create_links(); ?></div>
<?php	}
		else{ ?>
			<div class="container" align="center">
				<div class="alert alert-danger mt-5">
					<strong><?php echo "Not Logged in..!"?></strong>
				</div>
				<div align="center">
					<a href="<?= base_url(); ?>index.php/testController/loginView"><button name="login" class="btn btn-success">LOGIN</button></a>
					<br>
					<b>New User &nbsp? &nbsp SignUp Here &nbsp</b><a href="<?= base_url(); ?>index.php/testController/signupView"><button type="submit" name="signup" class="btn btn-primary">SIGNUP</button></a>
				</div>
			</div>
<?php 	} ?>	
	</div>

</body>
</html>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>Students Details-PDF</title>

</head>

<body>

    <style type="text/css">

        table,th,td{
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,td{
            text-align: center;
        }

        th{
            height: 50px;
        }

        td{
            height: 35px;
        }
    </style>

<?php   if ($this->session->userdata('username')) { ?>

            <h3 class="mt-5">Student Details</h3>

            <div class="container">
                
                <table align="center" id="student_details" class="table table-border table-striped table-hover" width="100%" cellpadding="5">

                <tr>
                    <th>ROLL NO</th>
                    <th>NAME</th>
                    <th>CLASS</th>
                    <th>SECTION</th>
                    <th>DOCUMENT</th>
                    <th>IMAGE</th>
                </tr>

                    <?php  
                     foreach ($data->result() as $row){  
                        ?><tr>
                            <td><?php echo $row->student_roll_no;?></td>
                            <td><?php echo $row->student_name;?></td>  
                            <td><?php echo $row->student_class;?></td>
                            <td><?php echo $row->student_section;?></td>
                            <td><a href="/CodeIgniter/student_document/<?php echo $row->student_document; ?>" target="_blank" style="text-decoration: none;"><?php echo $row->student_document;?></a></td>
                            <td><a href="/CodeIgniter/student_image/<?php echo $row->student_image; ?>" target="_blank" style="text-decoration: none;"><?php echo $row->student_image;?></a></td>
                        </tr>  
                     <?php }  
                     ?>
                </table>
                
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
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

        /*.container{
            width: 50%;
        }*/
    </style>
            <h3>Student Details</h3>
            <table align="center" id="student_details" class="table table-border table-striped table-hover" width="100%">
                <tr>
                    <th>ROLL NO</th>
                    <th>NAME</th>
                    <th>CLASS</th>
                    <th>SECTION</th>
                    <th>DOCUMENT</th>
                    <th>IMAGE</th>
                </tr>
                    <?php  
                     foreach ($data->result() as $row)  
                     {  
                        ?><tr>
                            <td><?php echo $row->student_roll_no;?></td>
                            <td><?php echo $row->student_name;?></td>  
                            <td><?php echo $row->student_class;?></td>
                            <td><?php echo $row->student_section;?></td>
                            <td><a href="\CodeIgniter\student_document<?php echo $row->student_document; ?>" target="_blank"><?php echo $row->student_document;?></a></td>
                            <td><a href="\CodeIgniter\student_image\<?php echo $row->student_image; ?>" target="_blank"><?php echo $row->student_image;?></a></td>
                        </tr>  
                     <?php }  
                     ?>
            </table>

</body>
</html>
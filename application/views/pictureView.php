<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<table>
		<?php  
         foreach ($data->result() as $row){  
            ?><tr>
                <td><?php echo $row->image_id;?></td>
                <td><div style="background-color:black; text-align:center; padding: 5px;">
  						 <img src="data:image/jpg;base64,<?php echo base64_encode($row->image) ?>">
					</div>
					</td>
                <td><?php echo $row->created_time;?></td>
            </tr>  
         <?php }  
         ?>
	</table>
</body>
</html>
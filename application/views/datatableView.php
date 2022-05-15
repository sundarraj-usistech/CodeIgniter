<html>
<head>
  <title>Student Details-Datatables</title>
  <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>
  <link rel="stylesheet"type="text/css"href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
</head>
<body>

<div class="container">
  <h2>Student Details</h2>
  <table id="student-list"class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>Roll No</th>
        <th>Name</th>
        <th>Class</th>
        <th>Section</th>
        <th>Document</th>
        <th>Image</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
<script type="text/javascript"src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript"src="http://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script>

    $('#student-list').DataTable({
        "ajax": {
            url :"<?php echo base_url(); ?>index.php/testController/get_datatable",
            type :'GET'
        },
    });

</script>

</body>

</html>
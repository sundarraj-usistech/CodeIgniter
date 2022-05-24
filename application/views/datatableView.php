<html>
<head>
  <title>Student Details-Datatables</title>
  <!-- Datatable CDN -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.12.0/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.3/sb-1.3.3/datatables.min.css"/>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.12.0/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.3/sb-1.3.3/datatables.min.js"></script>

<!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!--------------------------------------------------------------------------------------------------------->

</head>

<body>
  <style type="text/css">
    
    .container{
        width: 50%;
      }

  </style>

<?php if ($this->session->userdata('username')) { ?>

          <div class="container">

            <h3 class="mt-5">Student Details</h3>

            <br>

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

          <script>
              $('#student-list').DataTable({
                  "ajax": {
                      url :"<?php echo base_url(); ?>index.php/mainController/get_datatable",
                      type :'GET'
                  },
              });
          </script>

<?php }

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

  <?php   } ?>    

</body>
</html>
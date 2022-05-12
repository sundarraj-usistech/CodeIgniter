<html>
    <head>
        <title>Code Igniter Flash Session</title>
    </head>
    <body>
        <p>Logged in as <b> <?=$this->session->userdata('name');?> </b></p>
        <p>This is a session message <?=$this->session->flashdata('msg');?></p>
    </body>
</html>
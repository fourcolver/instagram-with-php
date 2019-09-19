<?php
session_start();
require_once('session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
  </head>
  <body>
<?php
 $file=getSession();
if($file!='0'){
  $filename=$file;
}else{
  $filename="results";
}
if (file_exists('data/'.$filename.'.json')) {
   $jsonString = file_get_contents('data/'.$filename.'.json');
} else {
   $jsonString = '';
}

$data = json_decode($jsonString, true);
             ?>
<br><br><br>
          <div class="container">
          <div class="row">
          <div class="col-md-12">
          <div class="panel with-nav-tabs panel-info">
          <div class="panel-heading">
          <a href="index.php" class="btn btn-info btn-sm">
          <span class="glyphicon glyphicon-chevron-left"></span> Back
        </a>
          <center><label>View Messages</label></center>

<table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>SL No</th>
                <th>Phone Number</th>
                <th>Name</th>
                <th>Msg Content</th>
                <th>Publshdate</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
      
        <tbody>
        <?php
        $i=0;
if(count($data['msg'])>0){
        foreach ($data['msg'] as $key => $value) {
          	$i++;
        ?>
            <tr>
            <td><?php echo $i;?></td>
                <td><?php echo $value['to_number'];?></td>
                <td><?php echo $value['name'];?></td>
                <td><?php echo $value['message'];?></td>
                <td><?php echo $value['publishdate'];?></td>
                <td><?php echo $value['status'];?></td>
                <td><?php echo $value['created_at'];?></td>
                <td>
                <?php if($value['status']!="Send successfully"){?><a href="send_message.php?id=<?php echo $value['id'];?>" class="btn btn-default btn-sm" >
          <span class="glyphicon glyphicon-send"></span> Send 
        </a><?php }?></td>
            </tr>
            <?php
        }}
      ?>
        </tbody>
    </table>
    </div></div></div></div>
<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable();
} );


</script>
</body>
</html>
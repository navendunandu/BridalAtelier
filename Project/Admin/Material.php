<?php 
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
if(isset($_POST['btn_submit']))
{
	$met=$_POST['txt_name'];
	$id=$_POST['txt_id'];
	$selMet="select * from tbl_material where material_name='".$met."'";
	$resMet=$con->query($selMet);
	if($resMet->num_rows>0){
		?>
		  <script>
		    alert("Material Already Exists");
		  </script>
		  <?php	
	}
	else{
	if($id!='')
	{
		$upQry=" update tbl_material set material_name='$met' where material_id='$id'";
		if($con->query($upQry))
		{
		echo "Updated";
		}
		else
		{
		echo "Error";
		}
	}
	else
	{
	$insQry  ="insert into tbl_material(material_name) values('".$met."')";
	if($con->query($insQry))
	{
		echo "Inserted";
	}
	else
	{
		echo "Error";
	}
}
}
}
 if(isset($_GET["mid"]))
  {
	  $delQry= "delete from tbl_material where material_id=".$_GET["mid"];
	  if($con->query($delQry))
	  {
		  ?>
          <script>
		  window.location = "Material.php";
		 </script>
         <?php
	  }
  }
  $mid='';
  $mname='';
  if(isset($_GET['eid']))
  {
	  $selQry=" select * from tbl_material where material_id='".$_GET['eid']."' ";
	  $row=$con->query($selQry);
	  $data=$row->fetch_assoc();
	  $mid=$data['material_id'];
	  $mname=$data['material_name'];
  }
	  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            color: #333;
        }
        .container {
            margin-top: 50px;
        }
        .form-title {
            margin-bottom: 30px;
            text-align: center;
            font-weight: bold;
        }
        label {
            font-weight: bold;
        }
        .form-control {
            font-weight: bold;
        }
        .table th, .table td {
            font-weight: bold;
            vertical-align: middle;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .btn {
            font-weight: bold;
        }
        .action-links a {
            margin-right: 10px;
        }
    </style>
</head>

<body>
<div class="container">
    <h2 class="form-title">Material Management</h2>
    <form id="form1" name="form1" method="post" action="">
        <div class="form-group">
            <label for="txt_name">Material</label>
            <input type="text" required class="form-control" name="txt_name" id="txt_name" value="<?php echo htmlspecialchars($mname); ?>"/>
            <input type="hidden" name="txt_id" id="txt_id" value="<?php echo htmlspecialchars($mid); ?>"/>
        </div>
        <div class="form-group text-center">
            <input type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="Submit" />
            <input type="reset" class="btn btn-secondary" name="btn_clear" id="btn_clear" value="Clear" />
        </div>
    </form>

    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Material</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $selQry = "SELECT * FROM tbl_material";
            $result = $con->query($selQry);
            while ($row = $result->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo htmlspecialchars($row["material_name"]); ?></td>
                <td class="action-links">
                    <a href="Material.php?mid=<?php echo $row["material_id"]; ?>" class="btn btn-danger btn-sm">Delete</a>
                    <a href="Material.php?eid=<?php echo $row["material_id"]; ?>" class="btn btn-warning btn-sm">Edit</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
<?php
            include("Foot.php");
            ob_flush();
?>
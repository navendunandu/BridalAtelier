<?php 
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
if(isset($_POST['btn_submit']))
{
	$mcat=$_POST['txt_name'];
	$id=$_POST['txt_id'];
	$selMcat="select * from tbl_maincategory where mcategory_name='".$mcat."'";
	$resMcat=$con->query($selMcat);
	if($resMcat->num_rows>0){
		?>
		  <script>
		    alert("Main Category Already Exists");
		  </script>
		  <?php	
	}
	else{
	if($id!='')
	{
		$upQry=" update tbl_maincategory set mcategory_name='$mcat' where mcategory_id='$id'";
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
	$insQry  ="insert into tbl_maincategory(mcategory_name) values('".$mcat."')";
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
 if(isset($_GET["mcid"]))
  {
	  $delQry= "delete from tbl_maincategory where mcategory_id=".$_GET["mcid"];
	  if($con->query($delQry))
	  {
		  ?>
          <script>
		  window.location = "MainCategory.php";
		 </script>
         <?php
	  }
  }
  $mcid='';
  $mcname='';
  if(isset($_GET['eid']))
  {
	  $selQry=" select * from tbl_maincategory where mcategory_id='".$_GET['eid']."' ";
	  $row=$con->query($selQry);
	  $data=$row->fetch_assoc();
	  $mcid=$data['mcategory_id'];
	  $mcname=$data['mcategory_name'];
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
            color: #333; /* Darker text color for better visibility */
        }
        .container {
            margin-top: 50px;
        }
        .form-title {
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold; /* Make title bold */
        }
        label {
            font-weight: bold; /* Make labels bold */
        }
        .form-control {
            font-weight: bold; /* Make input text bold */
        }
        .table th, .table td {
            font-weight: bold; /* Make table header and cells bold */
            vertical-align: middle; /* Align text in the middle */
        }
        .table th {
            background-color: #007bff; /* Bootstrap primary color for header */
            color: white; /* White text for contrast */
        }
        .btn {
            font-weight: bold; /* Make button text bold */
        }
    </style>
</head>

<body>
<div class="container">
    <h2 class="form-title">Main Category Management</h2>
    <form id="form1" name="form1" method="post" action="">
        <div class="form-group">
            <label for="txt_name">Main Category Name</label>
            <input required type="text" class="form-control" name="txt_name" id="txt_name" value="<?php echo htmlspecialchars($mcname); ?>"/>
            <input type="hidden" name="txt_id" id="txt_id" value="<?php echo htmlspecialchars($mcid); ?>"/>
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
                <th>Main Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $selQry = "SELECT * FROM tbl_maincategory";
            $result = $con->query($selQry);
            while ($row = $result->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo htmlspecialchars($row["mcategory_name"]); ?></td>
                <td>
                    <a href="MainCategory.php?mcid=<?php echo $row["mcategory_id"]; ?>" class="btn btn-danger btn-sm">Delete</a>
                    <a href="MainCategory.php?eid=<?php echo $row["mcategory_id"]; ?>" class="btn btn-warning btn-sm">Edit</a>
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
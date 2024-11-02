<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
if(isset($_POST['btn_add']))
{
	$sub=$_POST['txt_subcategory'];
	$id=$_POST['txt_subcategoryid'];
	$catid=$_POST['sel_category'];
	$selScat="select * from tbl_subcategory where subcategory_name='".$sub."'";
	$resScat=$con->query($selScat);
	if($resScat->num_rows>0){
		?>
		  <script>
		    alert("Subcategory Already Exists");
		  </script>
		  <?php	
	}
	else{
	if($id!='')
	{
		$upQry=" update tbl_subcategory set subcategory_name='$sub' where subcategory_id='$id' ";
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
	
	$insQry  ="insert into tbl_subcategory(subcategory_name,category_id) values('$sub','$catid')";
	if($con->query($insQry))
	{
		echo "inserted";
	}
	else
	{
		echo "Error";
	}
	}
}
}
  if(isset($_GET["did"]))
  {
	  $delQry= "delete from tbl_subcategory where subcategory_id=".$_GET["did"];
	  if($con->query($delQry))
	  {
		  ?>
          <script>
		  window.location = "subcategory.php";
		 </script>
         <?php
	  }
  }

$sname='';
 $sid='';
 if(isset($_GET['eid'])) 
 {
	 $SelQry=" select * from tbl_subcategory where subcategory_id=".$_GET['eid'];
	  $row=$con->query($SelQry);
	  $data=$row->fetch_assoc();
	  $sname=$data['subcategory_name'];
	  $sid=$data['subcategory_id'];
	  
	  
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
    <h2 class="form-title">Subcategory Management</h2>
    <form id="form1" name="form1" method="post" action="">
        <div class="form-group">
            <label for="sel_category">Category</label>
            <select required class="form-control" name="sel_category" id="sel_category">
                <option value="">-- Select --</option>
                <?php 
                $selQry = "SELECT * FROM tbl_category";
                $row = $con->query($selQry);
                while ($data = $row->fetch_assoc()) {
                ?>
                <option value="<?php echo $data['category_id']; ?>"><?php echo htmlspecialchars($data['category_name']); ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="txt_subcategory">Subcategory</label>
            <input required type="text" class="form-control" name="txt_subcategory" id="txt_subcategory" value="<?php echo htmlspecialchars($sname); ?>" />
            <input type="hidden" name="txt_subcategoryid" id="txt_subcategoryid" value="<?php echo htmlspecialchars($sid); ?>" />
        </div>
        <div class="form-group text-center">
            <input type="submit" class="btn btn-primary" name="btn_add" id="btn_add" value="Add" />
        </div>
    </form>

    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>SI No</th>
                <th>Main Category</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $selQry = "SELECT * FROM tbl_subcategory s 
                        INNER JOIN tbl_category c ON s.category_id = c.category_id 
                        INNER JOIN tbl_maincategory m ON c.mcategory_id = m.mcategory_id";
            $result = $con->query($selQry);
            while ($row = $result->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo htmlspecialchars($row["mcategory_name"]); ?></td>
                <td><?php echo htmlspecialchars($row["category_name"]); ?></td>
                <td><?php echo htmlspecialchars($row["subcategory_name"]); ?></td>
                <td class="action-links">
                    <a href="subcategory.php?did=<?php echo $row["subcategory_id"]; ?>" class="btn btn-danger btn-sm">Delete</a>
                    <a href="subcategory.php?eid=<?php echo $row["subcategory_id"]; ?>" class="btn btn-warning btn-sm">Edit</a>
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
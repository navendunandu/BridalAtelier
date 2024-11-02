<?php 
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
if(isset($_POST['btn_submit']))
{
	$cat=$_POST['txt_name'];
	$id=$_POST['txt_id'];
	$mcat=$_POST['sel_mcategory'];
	$selCat="select * from tbl_category where category_name='".$cat."'";
	$resCat=$con->query($selCat);
	if($resCat->num_rows>0){
		?>
		  <script>
		    alert("Category Already Exists");
		  </script>
		  <?php	
	}
	else{
	if($id!='')
	{
		$upQry=" update tbl_category set category_name='$cat' where category_id='$id'";
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
	$insQry  ="insert into tbl_category(category_name,mcategory_id) values('$cat','$mcat')";
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
 if(isset($_GET["cid"]))
  {
	  $delQry= "delete from tbl_category where category_id=".$_GET["cid"];
	  if($con->query($delQry))
	  {
		  ?>
          <script>
		  window.location = "Category.php";
		 </script>
         <?php
	  }
  }
  $cid='';
  $cname='';
  if(isset($_GET['eid']))
  {
	  $selQry=" select * from tbl_category where category_id='".$_GET['eid']."' ";
	  $row=$con->query($selQry);
	  $data=$row->fetch_assoc();
	  $cid=$data['category_id'];
	  $cname=$data['category_name'];
  }
	  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
        body {
            background-color: #f8f9fa; /* Light background color */
            color: #343a40; /* Dark text color */
        }

        .container {
            margin-top: 30px;
            padding: 20px;
            background-color: black; /* White background for the form */
            border-radius: 0.5rem;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .table img {
            width: 50px; /* Fixed width for images */
            height: auto; /* Maintain aspect ratio */
            border-radius: 5px; /* Rounded corners for images */
        }

        .table th {
            background-color: #007bff; /* Primary color for header */
            color: #ffffff; /* White text for header */
        }

        .action-link {
            color: #dc3545; /* Danger color for delete link */
            text-decoration: none;
        }

        .action-link:hover {
            text-decoration: underline; /* Underline on hover */
        }

        .form-control {
            border-radius: 0.25rem; /* Rounded corners for inputs */
        }

        .btn {
            border-radius: 0.25rem; /* Rounded corners for buttons */
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4 text-center">Manage Categories</h2>
        <form id="form1" name="form1" method="post" action="">
            <table class="table table-bordered">
                <tr>
                    <td>Main Category</td>
                    <td>
                        <select required name="sel_mcategory" id="sel_mcategory" class="form-control">
                            <option value="">--select--</option>
                            <?php 
                            $selQry = "SELECT * FROM tbl_maincategory";
                            $row = $con->query($selQry);
                            while ($data = $row->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $data['mcategory_id']; ?>"><?php echo htmlspecialchars($data['mcategory_name']); ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Category Name</td>
                    <td>
                        <input required type="text" name="txt_name" id="txt_name" class="form-control" value="<?php echo htmlspecialchars($cname); ?>" />
                        <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $cid; ?>" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <input type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary" value="Submit" />
                        <input type="reset" name="btn_clear" id="btn_clear" class="btn btn-secondary" value="Clear" />
                    </td>
                </tr>
            </table>
        </form>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Main Category</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $selQry = "SELECT * FROM tbl_category c INNER JOIN tbl_maincategory m ON c.mcategory_id = m.mcategory_id";
                $result = $con->query($selQry);
                while ($row = $result->fetch_assoc()) {
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo htmlspecialchars($row["mcategory_name"]); ?></td>
                        <td><?php echo htmlspecialchars($row["category_name"]); ?></td>
                        <td>
                            <a class="action-link" href="Category.php?cid=<?php echo $row["category_id"]; ?>">Delete</a> |
                            <a class="action-link" href="Category.php?eid=<?php echo $row["category_id"]; ?>">Edit</a>
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
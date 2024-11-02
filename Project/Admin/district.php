<?php 
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
if(isset($_POST['btn_submit']))
{
	$dis=$_POST['txt_name'];
	$id=$_POST['txt_id'];
	$selDis="select * from tbl_district where district_name='".$dis."'";
	$resDis=$con->query($selDis);
	if($resDis->num_rows>0){
		?>
		  <script>
		    alert("District Already Exists");
		  </script>
		  <?php	
	}
	else{
	if($id!='')
	{
		$upQry=" update tbl_district set district_name='$dis' where district_id='$id' ";
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
	
	$insQry  ="insert into tbl_district(district_name) values('".$dis."')";
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
	  $delQry= "delete from tbl_district where district_id=".$_GET["did"];
	  if($con->query($delQry))
	  {
		  ?>
          <script>
		  window.location = "district.php";
		 </script>
         <?php
	  }
  }
  $did='';
  $dname='';
 if(isset($_GET['eid'])) 
 {
	 $SelQry=" select * from tbl_district where district_id='".$_GET['eid']."' ";
	  $row=$con->query($SelQry);
	  $data=$row->fetch_assoc();
	  $did=$data['district_id'];
	  $dname=$data['district_name'];
	  
	  
 }
?>
<!D
}OCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
        body {
            background-color: #f8f9fa; /* Light background color */
            color: #ffffff; /* Dark text color */
        }

        .container {
            margin-top: 30px;
            padding: 20px;
            background-color: black; /* White background for the form */
            border-radius: 0.5rem;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff; /* Custom primary button color */
            border: none;
        }

        .btn-secondary {
            background-color: #6c757d; /* Custom secondary button color */
            border: none;
        }

        .table {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4">District Management</h2>
        <form id="form1" name="form1" method="post" action="">
            <div class="mb-3">
                <label for="txt_name" class="form-label">District Name</label>
                <input type="text" required name="txt_name" id="txt_name" class="form-control" value="<?php echo htmlspecialchars($dname); ?>" />
                <input type="hidden" name="txt_id" id="txt_id" value="<?php echo htmlspecialchars($did); ?>" />
            </div>
            <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
            <button type="reset" name="btn_clear" id="btn_clear" class="btn btn-secondary">Clear</button>
        </form>

        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>District Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $selQry = "SELECT * FROM tbl_district";
                $result = $con->query($selQry);
                while ($row = $result->fetch_assoc()) {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo htmlspecialchars($row["district_name"]); ?></td>
                    <td>
                        <a href="District.php?eid=<?php echo $row["district_id"]; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="District.php?did=<?php echo $row["district_id"]; ?>" class="btn btn-danger btn-sm">Delete</a>
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
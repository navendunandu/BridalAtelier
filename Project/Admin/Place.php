<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
if(isset($_POST['btn_submit']))
{
	$pname=$_POST['txt_place'];
	$did=$_POST['sel_dis'];
	$selPlace="select * from tbl_place where place_name='".$pname."'";
	$resPlace=$con->query($selPlace);
	if($resPlace->num_rows>0){
		?>
		  <script>
		    alert("Place Already Exists");
		  </script>
		  <?php	
	}
	else{
	$insQry="insert into tbl_place (place_name,district_id) values('$pname','$did')";
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
        <h2 class="mb-4 text-center">Place Management</h2>
        <form name="form1" method="post" action="">
            <div class="mb-3">
                <label for="sel_dis" class="form-label">Select District:</label>
                <select required name="sel_dis" id="sel_dis" class="form-select">
                    <option>--Select--</option>
                    <?php 
                    $selQry = "SELECT * FROM tbl_district";
                    $row = $con->query($selQry);
                    while ($data = $row->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $data['district_id']; ?>"><?php echo htmlspecialchars($data['district_name']); ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="txt_place" class="form-label">Place:</label>
                <input required type="text" name="txt_place" id="txt_place" class="form-control" />
            </div>
            <div class="text-center">
                <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
                <button type="reset" name="btn_clear" id="btn_clear" class="btn btn-secondary">Clear</button>
            </div>
        </form>

        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>District Name</th>
                    <th>Place Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $selQry = "SELECT tbl_place.*, tbl_district.district_name FROM tbl_place INNER JOIN tbl_district ON tbl_place.district_id = tbl_district.district_id";
                $result = $con->query($selQry);
                while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['district_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['place_name']); ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</html>
<?php
            include("Foot.php");
            ob_flush();
?>
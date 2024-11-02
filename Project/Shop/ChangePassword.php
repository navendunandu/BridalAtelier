
<?php 
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
session_start();

$selQry="select shop_password from tbl_shop where shop_id=".$_SESSION['sid'];
$result= $con->query($selQry);
$row =$result-> fetch_assoc();
if(isset($_POST['btn_change']))
{
	$old=$_POST['txt_opassword'];
	$new=$_POST['txt_npassword'];
	$retype=$_POST['txt_rpassword'];
	if($row['shop_password']!=$old)
	{
		echo "Incorrect Password";
	}
	else if($new!=$retype)
	{
		echo "Password doesn't match";
	}
	else
	{
		$upQry="update tbl_shop set shop_password='$new' where shop_id=".$_SESSION['sid'];
		if($con->query($upQry))
		{
			echo "Updated";
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
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Change Password</title>
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .btn {
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="container mt-5">
    <form id="form1" name="form1" method="post" action="">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Change Password</h5>
                <div class="form-group">
                    <label for="txt_opassword">Old Password</label>
                    <input required type="password" class="form-control" name="txt_opassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,8}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" id="txt_opassword" />
                </div>
                <div class="form-group">
                    <label for="txt_npassword">New Password</label>
                    <input required type="password" class="form-control" name="txt_npassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,8}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" id="txt_npassword" />
                </div>
                <div class="form-group">
                    <label for="txt_rpassword">Re-Type Password</label>
                    <input required type="password" class="form-control" name="txt_rpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,8}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" id="txt_rpassword" />
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" name="btn_change" id="btn_change" value="Change Password" />
                    <input type="submit" class="btn btn-secondary" name="btn_cancel" id="btn_cancel" value="Cancel" />
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>	
<?php
            include("Foot.php");
            ob_flush();
?>


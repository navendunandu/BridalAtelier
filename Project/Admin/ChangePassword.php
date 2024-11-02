<?php 
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
session_start();

$selQry="select admin_password from tbl_adminreg where admin_id=".$_SESSION['aid'];
$result= $con->query($selQry);
$row =$result-> fetch_assoc();
if(isset($_POST['btn_change']))
{
	$old=$_POST['txt_opassword'];
	$new=$_POST['txt_npassword'];
	$retype=$_POST['txt_rpassword'];
	if($row['admin_password']!=$old)
	{
		echo "Incorrect Password";
	}
	else if($new!=$retype)
	{
		echo "Password doesn't match";
	}
	else
	{
		$upQry="update tbl_adminreg set admin_password='$new' where admin_id=".$_SESSION['aid'];
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Light background */
        }
        .form-container {
            margin-top: 50px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            height: 50px; /* Larger height for input fields */
            font-size: 16px; /* Larger font size */
        }
        .btn-custom {
            height: 50px; /* Match height of input fields */
            font-size: 16px; /* Larger font size */
        }
    </style>
</head>

<body>
    <div class="container form-container">
        <h2 class="text-center">Change Password</h2>
        <form id="form1" name="form1" method="post" action="">
            <div class="form-group">
                <label for="txt_opassword">Old Password</label>
                <input required type="password" name="txt_opassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,8}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" id="txt_opassword" />
            </div>
            <div class="form-group">
                <label for="txt_npassword">New Password</label>
                <input required type="password" name="txt_npassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,8}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" id="txt_npassword" />
            </div>
            <div class="form-group">
                <label for="txt_rpassword">Re-Type Password</label>
                <input required type="password" name="txt_rpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,8}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" id="txt_rpassword" />
            </div>
            <div class="form-group text-center">
                <input type="submit" name="btn_change" id="btn_change" class="btn btn-primary btn-custom" value="Change Password" />
                <input type="submit" name="btn_cancel" id="btn_cancel" class="btn btn-secondary btn-custom" value="Cancel" />
            </div>
        </form>
    </div>
</body>
</html>
<?php
            include("Foot.php");
            ob_flush();
?>
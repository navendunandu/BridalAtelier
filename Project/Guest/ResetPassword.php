<?php
include("../Assets/Connection/connection.php");
session_start();
if(isset($_POST['btn_change'])){
if(isset($_SESSION['rsid']))
{
	$new=$_POST['txt_pass'];
	$retype=$_POST['txt_cpass'];
	if($new!=$retype)
	{
		echo "Password doesn't match";
	}
	else
  {
		$upQry="update tbl_shop set shop_password='$new' where shop_id=".$_SESSION['rsid'];
		if($con->query($upQry)){
		?>
		<script>
			alert("Password Updated")
			window.location="LogOut.php"
			</script>
			clearSession();
		<?php
		}
	}
}
else if(isset($_SESSION['ruid']))
{
	$new=$_POST['txt_pass'];
	$retype=$_POST['txt_cpass'];
	 if($new!=$retype)
	{
		echo "Password doesn't match";
	}
	else
	{
		$upQry="update tbl_user set user_password='$new' where user_id=".$_SESSION['ruid'];
		if($con->query($upQry)){
		?>
		<script>
			alert("Password Updated")
			window.location="LogOut.php"
			</script>
			clearSession();
		<?php
}
}
}
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Link to custom CSS -->
    <style>
        body {
            background-color: #f8f9fa; /* Light background */
        }
        .form-container {
            max-width: 400px;
            margin: auto;
            padding: 2rem;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .btn-custom {
            background-color: #007bff; /* Bootstrap primary color */
            color: white;
        }
        .btn-custom:hover {
            background-color: #0056b3; /* Darker shade on hover */
            transition: background-color 0.3s ease; /* Smooth transition */
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Change Password</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="txt_pass">New Password</label>
            <input type="password" class="form-control" name="txt_pass" id="txt_pass" required>
        </div>
        <div class="form-group">
            <label for="txt_cpass">Confirm Password</label>
            <input type="password" class="form-control" name="txt_cpass" id="txt_cpass" required>
        </div>
        <button type="submit" class="btn btn-custom btn-block" name="btn_change">Change Password</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

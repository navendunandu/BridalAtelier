<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
session_start();
    $selQry= "select * from tbl_user where user_id=".$_SESSION['uid'];
	$result= $con->query($selQry);
	$row =$result-> fetch_assoc();
	

 if(isset($_POST['btn_edit']))
 {
	 $name=$_POST['txt_name'];
	 $email=$_POST['txt_email'];
	 $contact=$_POST['txt_contact'];
	 $address=$_POST['txt_address'];
	 $uid=$_SESSION['uid'];
	 $upQry=" update tbl_user set user_name='$name',user_email='$email',user_contact='$contact',user_address='$address' where user_id='$uid' "; 
		if($con->query($upQry))
		{
		echo "Updated";
		?>
        <script>
		window.location="EditProfile.php";
		</script>
        <?php
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
        h1 {
            color: #343a40; /* Dark color for heading */
            margin-top: 20px;
            text-align: center;
        }
        .form-container {
            margin-top: 30px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            height: 50px; /* Larger height for input fields */
            font-size: 16px; /* Larger font size */
        }
        .btn-edit {
            height: 50px; /* Match height of input fields */
            font-size: 16px; /* Larger font size */
            background-color: #007bff; /* Bootstrap primary color */
            color: white; /* White text */
        }
        .btn-edit:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        textarea {
            resize: none; /* Prevent resizing */
        }
    </style>
</head>

<body>
    <div class="container form-container">
        <h1>Edit Profile</h1>
        <form id="form1" name="form1" method="post" action="">
            <div class="form-group">
                <label for="txt_name">Name</label>
                <input type="text" class="form-control" name="txt_name" title="Name Allows Only Alphabets, Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" id="txt_name" value="<?php echo $row['user_name'];?>" required />
            </div>
            <div class="form-group">
                <label for="txt_email">Email</label>
                <input type="email" class="form-control" name="txt_email" id="txt_email" value="<?php echo $row['user_email'];?>" required />
            </div>
            <div class="form-group">
                <label for="txt_contact">Contact</label>
                <input type="text" class="form-control" name="txt_contact" pattern="[7-9]{1}[0-9]{9}" title="Phone number with 7-9 and remaining 9 digits with 0-9" id="txt_contact" value="<?php echo $row['user_contact'];?>" required />
            </div>
            <div class="form-group">
                <label for="txt_address">Address</label>
                <textarea class="form-control" name="txt_address" id="txt_address" cols="45" rows="5" required><?php echo $row['user_address'];?></textarea>
            </div>
            <div class="form-group text-center">
                <input type="submit" name="btn_edit" id="btn_edit" class="btn btn-edit" value="Edit" />
            </div>
        </form>
    </div>
</body>
</html>
<?php
            include("Foot.php");
            ob_flush();
?>
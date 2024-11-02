
ob_start();
include("Head.php");<?php
include("../Assets/Connection/connection.php");
session_start();
    $selQry= "select * from tbl_shop where shop_id=".$_SESSION['sid'];
	$result= $con->query($selQry);
	$row =$result-> fetch_assoc();
	

 if(isset($_POST['btn_edit']))
 {
	 $name=$_POST['txt_name'];
	 $email=$_POST['txt_email'];
	 $contact=$_POST['txt_contact'];
	 $address=$_POST['txt_address'];
	 $sid=$_SESSION['sid'];
	 $upQry=" update tbl_shop set shop_name='$name',shop_email='$email',shop_contact='$contact',shop_address='$address' where shop_id='$sid' "; 
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
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            margin-bottom: 10px;
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
                <h5 class="card-title text-center">Edit Shop Details</h5>
                <div class="form-group">
                    <label for="txt_name">Name</label>
                    <input type="text" class="form-control" name="txt_name" title="Name allows only alphabets, spaces, and the first letter must be capital letter" pattern="^[A-Z]+[a-zA-Z ]*$" id="txt_name" value="<?php echo $row['shop_name'];?>" required />
                </div>
                <div class="form-group">
                    <label for="txt_email">Email</label>
                    <input type="email" class="form-control" name="txt_email" id="txt_email" value="<?php echo $row['shop_email'];?>" required />
                </div>
                <div class="form-group">
                    <label for="txt_contact">Contact</label>
                    <input type="text" class="form-control" name="txt_contact" pattern="[7-9]{1}[0-9]{9}" title="Phone number should start with 7-9 followed by 9 digits (0-9)" id="txt_contact" value="<?php echo $row['shop_contact'];?>" required />
                </div>
                <div class="form-group">
                    <label for="txt_address">Address</label>
                    <textarea class="form-control" name="txt_address" id="txt_address" rows="5" required><?php echo $row['shop_address'];?></textarea>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" name="btn_edit" id="btn_edit" value="Edit" />
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
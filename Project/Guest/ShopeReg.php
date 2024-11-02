<?php
include("../Assets/Connection/connection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';
if(isset($_POST['btn_register']))
{
	$name=$_POST['txt_name'];
	$email=$_POST['txt_email'];
	$contact=$_POST['txt_contact'];
	$address=$_POST['txt_address'];
	$district=$_POST['sel_district'];
	$place=$_POST['sel_place'];
	$logo=$_FILES['file_logo']['name'];
	$templogo=$_FILES['file_logo']['tmp_name'];
	move_uploaded_file($templogo, '../Assets/Files/Shop/Logo/'.$logo);
	$proof=$_FILES['file_proof']['name']; 
	$tempproof=$_FILES['file_proof']['tmp_name']; 
	move_uploaded_file($tempproof, '../Assets/Files/Shop/Proof/'.$proof);
	$password=$_POST['txt_password'];
	$cpassword=$_POST['txt_cpassword'];
	
	$selUser="select * from tbl_user where user_email='".$email."'";
	$selAdmin="select * from tbl_adminreg where admin_email='".$email."'";
	$selShop="select * from tbl_shop where shop_email='".$email."'";
	$resUser=$con->query($selUser);
	$resAdmin=$con->query($selAdmin);
	$resShop=$con->query($selShop);
	
	if($resUser->num_rows>0 || $resAdmin->num_rows>0 || $resShop->num_rows>0){
		?>
		  <script>
		    alert("Email Already Exists");
		  </script>
		  <?php	
	}
	else{
	  $insQry= "insert into tbl_shop(shop_name,shop_email,shop_contact,shop_address,place_id,shop_logo,shop_proof,shop_doj,shop_password) values('$name','$email','$contact','$address','$place','$logo','$proof',curdate(),'$password')";
	 if($con->query($insQry))
	 {
     $mail = new PHPMailer(true);

     $mail->isSMTP();
     $mail->Host = 'smtp.gmail.com';
     $mail->SMTPAuth = true;
     $mail->Username = 'thebridalatelierr@gmail.com'; // Your gmail
     $mail->Password = 'rczm knjv itvu tqix'; // Your gmail app password
     $mail->SMTPSecure = 'ssl';
     $mail->Port = 465;
   
     $mail->setFrom('thebridalatelierr@gmail.com'); // Your gmail
   
     $mail->addAddress($email);
   
     $mail->isHTML(true);
   
     $mail->Subject = "Greetings ";  //Your Subject goes here
     $mail->Body = "Welcome to The Bridal Atelier"; //Mail Body goes here
   if($mail->send())
   {
     ?>
 <script>
     alert("Email Send")
 </script>
     <?php
   }
   else
   {
     ?>
 <script>
     alert("Something went wrong")
 </script>
     <?php
   }
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
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
        }
        .form-title {
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="form-title">Registration Form</h2>
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <div class="form-group">
            <label for="txt_name">Name</label>
            <input required type="text" class="form-control" name="txt_name" title="Name allows only alphabets and spaces. First letter must be capital." pattern="^[A-Z][a-zA-Z ]*$" id="txt_name" />
        </div>
        <div class="form-group">
            <label for="txt_email">Email</label>
            <input type="email" required class="form-control" name="txt_email" id="txt_email" />
        </div>
        <div class="form-group">
            <label for="txt_contact">Contact</label>
            <input type="text" required class="form-control" name="txt_contact" pattern="[7-9]{1}[0-9]{9}" title="Phone number must start with 7-9 followed by 9 digits." id="txt_contact" />
        </div>
        <div class="form-group">
            <label for="txt_address">Address</label>
            <textarea name="txt_address" class="form-control" id="txt_address" cols="45" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="sel_district">District</label>
            <select required class="form-control" name="sel_district" id="sel_district" onChange="getPlace(this.value)">
                <option value="" disabled selected>--Select--</option>
                <?php 
                $selQry="SELECT * FROM tbl_district";
                $row=$con->query($selQry);
                while($data=$row->fetch_assoc()) {
                ?>
                <option value="<?php echo $data['district_id'] ?>"><?php echo $data['district_name']; ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="sel_place">Place</label>
            <select required class="form-control" name="sel_place" id="sel_place">
                <option value="" disabled selected>--Select--</option>
            </select>
        </div>
        <div class="form-group">
            <label for="file_logo">Logo</label>
            <input type="file" class="form-control-file" name="file_logo" id="file_logo" />
        </div>
        <div class="form-group">
            <label for="file_proof">Proof</label>
            <input required type="file" class="form-control-file" name="file_proof" id="file_proof" />
        </div>
        <div class="form-group">
            <label for="txt_password">Password</label>
            <input type="password" required class="form-control" name="txt_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,8}" title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters" id="txt_password" />
        </div>
        <div class="form-group">
            <label for="txt_cpassword">Confirm Password</label>
            <input type="password" required class="form-control" name="txt_cpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,8}" title="Must match the password above" id="txt_cpassword" />
        </div>
        <div class="form-group text-center">
            <input type="submit" class="btn btn-primary" name="btn_register" id="btn_register" value="Register" />
        </div>
    </form>
</div>
<script>
    function getPlace(districtId) {
        // Implement AJAX call to fetch places based on selected district
    }
</script>
</body>
 <script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getPlace(did) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
      success: function (result) {

        $("#sel_place").html(result);
      }
    });
  }

</script>
</html>
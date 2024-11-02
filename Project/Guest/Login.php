<?php 
include("../Assets/Connection/connection.php");
session_start();
if(isset($_POST['btn_login']))
{
	$Email =$_POST['txt_email'];
	$Password =$_POST['txt_password'];
	
	$selAdmin= "select * from tbl_adminreg where admin_email= '$Email' and admin_password= '$Password'";
	$ResultAdmin=$con->query($selAdmin);
	
	
	$selShop= "select * from tbl_shop where shop_email= '$Email' and shop_password= '$Password'";
	$ResultShop=$con->query($selShop);
	
	$selUser= "select * from tbl_user where user_email= '$Email' and user_password= '$Password'";
	$ResultUser=$con->query($selUser);
	
	if($data= $ResultAdmin-> fetch_assoc())
	{
		$_SESSION['aid'] = $data['admin_id'];
		$_SESSION['aname'] = $data['admin_name'];
		header("location:../Admin/HomePage.php");
		
	}
	else if($data= $ResultShop-> fetch_assoc())
	{   
	    if($data['shop_vstatus']==1)
		{
		$_SESSION['sid'] = $data['shop_id'];
		$_SESSION['sname'] = $data['shop_name'];
		header("location:../Shop/Homepage.php");
	    }
		else if($data['shop_vstatus']==2)
		{
			?>
            <script>
			alert("Rejected");
			</script>
            <?php
		}
		else
		{
			?>
            <script>
			alert("Pending");
			</script>
            <?php
		}
		
	}
		else if($data= $ResultUser-> fetch_assoc())
	   {
		$_SESSION['uid'] = $data['user_id'];
		$_SESSION['uname'] = $data['user_name'];
		header("location:../User/HomePage.php");
	   }
	   else{
		?>
			<script>
			alert("Invalid Credentials")
			</script>
		<?php	
		}
}
	
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../Assets/Templates/Login/fonts/icomoon/style.css">

    <link rel="stylesheet" href="../Assets/Templates/Login/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Login/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="../Assets/Templates/Login/css/style.css">

    <title>Login #2</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('../Assets/Templates/Login/images/bg_3.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <h3>Login to <strong>The Bridal Atelier</strong></h3>
            <p class="mb-4"></p>
            <form action="#" method="post">
              <div class="form-group first">
                <label for="username">Email</label>
                <input type="email" name="txt_email" class="form-control" placeholder="your-email@gmail.com" id="username">
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" name="txt_password" class="form-control" placeholder="Your Password" id="password">
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="ForgotPassword.php" class="forgot-pass">Forgot Password</a></span> 
              </div>

              <input type="submit" name="btn_login" value="Log In" class="btn btn-block btn-primary">

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="../Assets/Templates/Login/js/jquery-3.3.1.min.js"></script>
    <script src="../Assets/Templates/Login/js/popper.min.js"></script>
    <script src="../Assets/Templates/Login/js/bootstrap.min.js"></script>
    <script src="../Assets/Templates/Login/js/main.js"></script>
  </body>
</html>
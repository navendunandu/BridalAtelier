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
		header("location:../Admin/HomePage.php");
		
	}
	else if($data= $ResultShop-> fetch_assoc())
	{   
	    if($data['shop_vstatus']==1)
		{
		$_SESSION['sid'] = $data['shop_id'];
		header("location:../Shop/Homepage.php");
	    }
		else If($data['shop_vstatus']==2)
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
		header("location:../User/Homepage.php");
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td colspan="2" align="center">Login</td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="email" required name="txt_email" id="txt_email"></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
      <input type="password" name="txt_password" id="txt_password"></td>
    </tr>
    <tr>
	<td colspan="2">
		<a href="ForgotPassword.php">Forgot Password?</a>
    </tr>	
	<tr>
      <td colspan="2" align="center"><input type="submit" name="btn_login" id="btn_login" value="Login" />
      <input type="reset" name="btn_clear" id="btn_clear" value="Clear" /></td>
    </tr>
  </table>
</form>
</body>
</html>
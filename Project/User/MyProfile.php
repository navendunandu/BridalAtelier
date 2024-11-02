<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
session_start();

  $selQry="select * from tbl_user u inner join tbl_place p on u.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where user_id =".$_SESSION['uid'];
  $result=$con->query($selQry);
  $row=$result->fetch_assoc()
  
  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
  body {
    background-color: #f8f9fa;
  }
  h2 {
    color: #343a40;
  }
</style>

</head>

<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">User Profile</h2>
    
    <form id="form1" name="form1" method="post" action="">
      <div class="card">
        <div class="card-body">
          <div class="text-center mb-4">
            <img src="../Assets/Files/User/Photo/<?php echo $row['user_photo']; ?>" class="img-fluid rounded-circle" style="height: 200px; width: 200px;" alt="User Photo" />
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Name</label>
            <div class="col-sm-8">
              <p class="form-control-plaintext"><?php echo $row['user_name']; ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Email</label>
            <div class="col-sm-8">
              <p class="form-control-plaintext"><?php echo $row['user_email']; ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Contact</label>
            <div class="col-sm-8">
              <p class="form-control-plaintext"><?php echo $row['user_contact']; ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Address</label>
            <div class="col-sm-8">
              <p class="form-control-plaintext"><?php echo $row['user_address']; ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">District</label>
            <div class="col-sm-8">
              <p class="form-control-plaintext"><?php echo $row['district_name']; ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Place</label>
            <div class="col-sm-8">
              <p class="form-control-plaintext"><?php echo $row['place_name']; ?></p>
            </div>
          </div>
          <div class="text-center mt-4">
            <a href="EditProfile.php" class="btn btn-primary">Edit Profile</a>
            <a href="ChangePassword.php" class="btn btn-secondary">Change Password</a>
          </div>
        </div>
      </div>
    </form>
  </div>
</body>
</html>
<?php
            include("Foot.php");
            ob_flush();
?>
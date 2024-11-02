<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';
session_start();
if(isset($_GET['cid']))
{
	$id=$_GET['cid'];
	$stat=$_GET['stat'];
	
	$upQry="update tbl_cart set cart_status='$stat' where cart_id='$id'";
	if($con->query($upQry)){
		if($stat==3){
      $SelUser="select user_email from tbl_user where user_id=".$_GET['uid'];
	$result=$con->query($SelUser);
	$row=$result->fetch_assoc();
	$email=$row['user_email'];
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
     $mail->Body = "Your order has been shipped"; //Mail Body goes here
   if($mail->send())
   {
     ?>
 <script>
     alert("Email Send");
 </script>
     <?php
   }
   else
   {
     ?>
 <script>
     alert("Something went wrong");
 </script>
     <?php
		}
	}
  else{
    ?>
    <script>
      alert("Updated");
    </script>
    <?php
  }
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Seller Orders</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
  body {
    background-color: #f8f9fa;
  }
  h2 {
    color: #343a40;
  }
  .table th, .table td {
    vertical-align: middle;
  }
</style>

</head>

<body>
  <form id="form1" name="form1" method="post" action="">
    <div class="container mt-5">
      <h2 class="text-center mb-4">Product Booking Details</h2>
      <table class="table table-bordered table-striped">
        <thead class="thead-dark">
          <tr>
            <th>SI No</th>
            <th>Photo</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Foredate</th>
            <th>Return Date</th>
            <th>Price</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;
          $selQry = "SELECT * FROM tbl_booking b 
                     INNER JOIN tbl_cart c ON c.booking_id = b.booking_id 
                     INNER JOIN tbl_product p ON p.product_id = c.product_id 
                     INNER JOIN tbl_shop s ON s.shop_id = p.shop_id 
                     WHERE p.shop_id = " . $_SESSION['sid'];
          $result = $con->query($selQry);
          while ($row = $result->fetch_assoc()) {
            $i++;
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><img src="../Assets/Files/Product/Photos/<?php echo $row['product_photo']; ?>" class="img-fluid" style="max-width: 100px; height: auto;" /></td>
              <td><?php echo $row['product_name']; ?></td>
              <td><?php echo $row['cart_quantity']; ?></td>
              <td><?php echo $row['booking_foredate']; ?></td>
              <td><?php echo $row['booking_returningdate']; ?></td>
              <td><?php echo number_format($row['product_price'], 2); ?></td>
              <td><?php echo number_format($row['cart_quantity'] * $row['product_price'], 2); ?></td>
              <td>
                <?php
                if ($row['cart_status'] == 1) {
                    echo "Payment Received";
                } elseif ($row['cart_status'] == 2) {
                    echo "Order Packed";
                } elseif ($row['cart_status'] == 3) {
                    echo "Order Shipped";
                } elseif ($row['cart_status'] == 4) {
                    echo "Delivered";
                } elseif ($row['cart_status'] == 5) {
                    $selDate = "SELECT 
                        DATEDIFF(CURDATE(), STR_TO_DATE(booking_foredate, '%Y-%m-%d')) AS date_difference 
                        FROM tbl_booking 
                        WHERE booking_id = " . $row['booking_id'];
                    $date = $con->query($selDate);
                    $data = $date->fetch_assoc();
                    $days = $data['date_difference'] > 1 ? $data['date_difference'] - 1 : 0;
                    $totalRent = $days * $row['product_price'];
                    
                    echo $days . ' days used' . "<br>";
                    echo "Total Rent (after 1 day deduction): " . number_format($totalRent, 2) . "<br>";
                    echo "Return Requested";
                } elseif ($row['cart_status'] == 6) {
                    echo "Return Completed";
                }
                ?>
              </td>
              <td>
                <?php
                if ($row['cart_status'] == 1) {
                    ?>
                    <a href="Booking.php?cid=<?php echo $row['cart_id']; ?>&stat=2" class="btn btn-warning btn-sm">Packed</a>
                    <?php
                } elseif ($row['cart_status'] == 2) {
                    ?>
                    <a href="Booking.php?cid=<?php echo $row['cart_id']; ?>&uid=<?php echo $row['user_id'] ?>&stat=3" class="btn btn-info btn-sm">Shipped</a>
                    <?php
                } elseif ($row['cart_status'] == 3) {
                    ?>
                    <a href="Booking.php?cid=<?php echo $row['cart_id']; ?>&stat=4" class="btn btn-success btn-sm">Delivered</a>
                    <?php
                } elseif ($row['cart_status'] == 4) {
                    ?>
                    <a href="Booking.php?cid=<?php echo $row['cart_id']; ?>&stat=5" class="btn btn-danger btn-sm">Return Requested</a>
                    <?php
                } elseif ($row['cart_status'] == 5) {
                    echo "Return Requested";
                }
                ?>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </form>
</body>
</html>
<?php
            include("Foot.php");
            ob_flush();
?>
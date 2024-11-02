<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
session_start();
if(isset($_GET['cid']))
{
    $upQry="update tbl_cart set cart_status='".$_GET['stat']."' where cart_id=".$_GET['cid'];
    if($con->query($upQry))
    {
        ?>
        <script>
            alert("Return Requested")
            window.location="Booking.php"
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
  <div class="container mt-5">
    <h2 class="text-center mb-4">My Bookings</h2>
    
    <form id="form1" name="form1" method="post" action="">
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="thead-dark">
            <tr>
              <th>SINo</th>
              <th>Photo</th>
              <th>Name</th>
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
                          INNER JOIN tbl_cart c ON b.booking_id = c.booking_id 
                          INNER JOIN tbl_product p ON p.product_id = c.product_id 
                          WHERE b.booking_status >= '2' AND b.user_id = " . $_SESSION['uid'];
              $result = $con->query($selQry);
              while ($row = $result->fetch_assoc()) {
                $i++;
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><img src="../Assets/Files/Product/Photos/<?php echo $row['product_photo']; ?>" class="img-fluid" style="max-width: 100px; max-height: 100px;" /></td>
              <td><?php echo $row['product_name']; ?></td>
              <td><?php echo $row['cart_quantity']; ?></td>
              <td><?php echo $row['booking_foredate']; ?></td>
              <td><?php echo $row['booking_returningdate']; ?></td>
              <td><?php echo $row['product_price']; ?></td>
              <td><?php echo $row['cart_quantity'] * $row['product_price']; ?></td>
              <td>
                <?php 
                  if ($row['cart_status'] == 1) {
                      echo "Order is being packed";
                  } else if ($row['cart_status'] == 2) {
                      echo "Order packed";
                  } else if ($row['cart_status'] == 3) {
                      echo "Order Shipped";
                  } else if ($row['cart_status'] == 4) {
                      echo "Delivered";
                      ?>
                      <a href="Booking.php?cid=<?php echo $row['cart_id']; ?>&stat=5" class="btn btn-warning btn-sm">Request Return</a>
                      <?php
                  } else if ($row['cart_status'] == 5) {
                      $selDate = "SELECT DATEDIFF(CURDATE(), STR_TO_DATE(booking_foredate, '%Y-%m-%d')) AS date_difference 
                                  FROM tbl_booking WHERE booking_id = " . $row['booking_id'];
                      $date = $con->query($selDate);
                      $data = $date->fetch_assoc();
                      $days = $data['date_difference'] > 1 ? $data['date_difference'] - 1 : 0; 
                      echo $days . ' days<br>';
                      $totalRent = $days * $row['product_price'];
                      echo "Total Rent (after 1 day deduction): " . $totalRent . "<br>";
                      if($days!=0){
                      ?>
                      <a href="Payment.php?cid=<?php echo $row['cart_id']; ?>" class="btn btn-primary btn-sm">Proceed to pay</a>
                      <?php
                      }else{
                        ?>
                        <a href="Booking.php?cid=<?php echo $row['cart_id']; ?>&stat=6" class="btn btn-primary btn-sm">Return</a>
                        <?php
                      }
                  } else if ($row['cart_status'] == 6) {
                      echo "Return Completed";
                  }
                ?>
              </td>
              <td>
                <a href="PostComplaint.php?pid=<?php echo $row['product_id']; ?>" class="btn btn-danger btn-sm">Complaint</a>
                <a href="Rating.php?pid=<?php echo $row['product_id']; ?>" class="btn btn-info btn-sm">Rating</a>
                <a href="Bill.php?id=<?php echo $row['cart_id']; ?>" class="btn btn-info btn-sm">Bill</a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </form>
  </div>
</body>
</html>
<?php
            include("Foot.php");
            ob_flush();
?>
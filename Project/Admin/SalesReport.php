<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
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
  /* Print-specific styles */
  @media print {
    body * {
      visibility: hidden;
    }
    .printable-area, .printable-area * {
      visibility: visible;
    }
    .printable-area {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
    }
    .no-print {
      display: none;
    }
  }
</style>
<script>
  function printData() {
    window.print();
  }
</script>
</head>

<body>
  <form id="form1" name="form1" method="post" action="">
    <div class="container mt-5">
      <h2 class="text-center mb-4">Product Booking Details</h2>

      <div class="row mb-4 no-print">
        <div class="col-md-5">
          <label for="start-date">Start Date:</label>
          <input type="date" name="start_date" id="start-date" class="form-control" value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>">
        </div>
        <div class="col-md-5">
          <label for="end-date">End Date:</label>
          <input type="date" name="end_date" id="end-date" class="form-control" value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>">
        </div>
        <div class="col-md-2">
          <label>&nbsp;</label>
          <button type="submit" name="filter" class="btn btn-primary btn-block">Filter</button>
        </div>
      </div>

      <div class="text-right mb-3 no-print">
        <button type="button" class="btn btn-secondary" onclick="printData()">Print</button>
      </div>

      <div class="printable-area">
        <table class="table table-bordered table-dark">
          <thead class="thead-dark">
            <tr>
              <th>SI No</th>
              <th>Product Name</th>
              <th>User</th>
              <th>Shop</th>
              <th>Quantity</th>
              <th>Foredate</th>
              <th>Return Date</th>
              <th>Price</th>
              <th>Total Price</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 0;
            $selQry = "SELECT * FROM tbl_booking b 
                       INNER JOIN tbl_cart c ON c.booking_id = b.booking_id 
                       INNER JOIN tbl_user u ON u.user_id = b.user_id
                       INNER JOIN tbl_product p ON p.product_id = c.product_id 
                       INNER JOIN tbl_shop s ON s.shop_id = p.shop_id";

            // Check if start and end dates are set
            if (isset($_POST['filter'])) {
              $start_date = $_POST['start_date'];
              $end_date = $_POST['end_date'];

              if (!empty($start_date) && !empty($end_date)) {
                $selQry .= " WHERE b.booking_foredate BETWEEN '$start_date' AND '$end_date'";
              }
            }
            $result = $con->query($selQry);
            while ($row = $result->fetch_assoc()) {
              $i++;
              ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['user_name']; ?></td>
                <td><?php echo $row['shop_name']; ?></td>
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
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </form>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>

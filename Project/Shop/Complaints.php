<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
session_start();
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
  <form id="form1" name="form1" method="post" action="">
    <div class="container mt-5">
      <h2 class="text-center mb-4">Complaints Management</h2>
      <table class="table table-bordered table-striped">
        <thead class="thead-dark">
          <tr>
            <th>Sl No.</th>
            <th>Date</th>
            <th>Title</th>
            <th>User</th>
            <th>Product</th>
            <th>File</th>
            <th>Description</th>
            <th>Reply</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;
          $selQry = "SELECT * FROM tbl_shop s 
                      INNER JOIN tbl_product p ON s.shop_id = p.shop_id 
                      INNER JOIN tbl_complaint c ON c.product_id = p.product_id 
                      INNER JOIN tbl_user u ON c.user_id = u.user_id 
                      WHERE s.shop_id = " . $_SESSION['sid'];
          $result = $con->query($selQry);
          while ($row = $result->fetch_assoc()) {
              $i++;
          ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['complaint_date']; ?></td>
            <td><?php echo $row['complaint_title']; ?></td>
            <td><?php echo $row['user_name']; ?></td>
            <td><?php echo $row['product_name']; ?></td>
            <td>
              <img src="../Assets/Files/User/Complaint/<?php echo $row['complaint_file']; ?>" class="img-fluid" style="max-width: 100px; height: auto;" alt="Complaint File"/>
            </td>
            <td><?php echo $row['complaint_content']; ?></td>
            <td>
              <a href="Reply.php?cid=<?php echo $row['complaint_id']; ?>" class="btn btn-primary btn-sm">Reply</a>
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
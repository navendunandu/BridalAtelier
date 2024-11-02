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
</style>

</head>

<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">User Complaints</h2>
    
    <form id="form1" name="form1" method="post" action="">
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>Sl No.</th>
            <th>Title</th>
            <th>Description</th>
            <th>Product</th>
            <th>File</th>
            <th>Reply</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;
          $selQry = "SELECT * FROM tbl_complaint c 
                      INNER JOIN tbl_product p ON c.product_id = p.product_id 
                      WHERE c.user_id = " . $_SESSION['uid'];
          $result = $con->query($selQry);
          while ($row = $result->fetch_assoc()) {
              $i++;
          ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $row['complaint_title']; ?></td>
              <td><?php echo $row['complaint_content']; ?></td>
              <td><?php echo $row['product_name']; ?></td>
              <td>
                <img src="../Assets/Files/User/Complaint/<?php echo $row['complaint_file']; ?>" class="img-fluid" style="max-width: 100px; height: auto;" alt="Complaint File"/>
              </td>
              <td>
                <?php
                if ($row['complaint_status'] == 0) {
                    echo "Your complaint is not reviewed yet";
                } else if ($row['complaint_status'] == 1) {
                    echo $row['complaint_reply'];
                }
                ?>
              </td>
              <td><?php echo $row['complaint_date']; ?></td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </form>
  </div>
</body>
</html>
<?php
            include("Foot.php");
            ob_flush();
?>
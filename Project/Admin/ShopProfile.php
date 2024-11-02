<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
session_start();

  $selQry="select * from tbl_shop u inner join tbl_place p on u.place_id=p.place_id inner join tbl_district d on p.district_id where shop_id =".$_GET['sid'];
  $result=$con->query($selQry);
  $row=$result->fetch_assoc()
  
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
        .btn {
            margin: 5px;
        }
    </style>
</head>

<body>

<div class="container mt-5">
    <form id="form1" name="form1" method="post" action="">
        <div class="card">
            <div class="card-body">
                <div class="text-center mb-4">
                    <img src="../Assets/Files/Shop/Logo/<?php echo $row['shop_logo']; ?>" class="img-fluid" style="max-height: 200px;" alt="Shop Logo"/>
                </div>
                <h4 class="card-title text-center">Shop Details</h4>
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td><?php echo $row['shop_name']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td><?php echo $row['shop_email']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Contact:</strong></td>
                        <td><?php echo $row['shop_contact']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Address:</strong></td>
                        <td><?php echo $row['shop_address']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>District:</strong></td>
                        <td><?php echo $row['district_name']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Place:</strong></td>
                        <td><?php echo $row['place_name']; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
      <div class="card-body">
        <h4 class="card-title">Product List</h4>
        <table class="table table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>Si No</th>
              <th>Product Photo</th>
              <th>Product Name</th>
              <th>Product Description</th>
              <th>Product Price</th>
              <th>Main Category</th>
              <th>Category</th>
              <th>Subcategory</th>
              <th>Shop Name</th>
              <th>Material Name</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $i = 0;
              $selQry = "SELECT * FROM tbl_product p 
                          INNER JOIN tbl_subcategory s ON p.subcategory_id = s.subcategory_id 
                          INNER JOIN tbl_category c ON s.category_id = c.category_id 
                          INNER JOIN tbl_shop sp ON sp.shop_id = p.shop_id 
                          INNER JOIN tbl_material m ON p.material_id = m.material_id 
                          INNER JOIN tbl_maincategory mc ON mc.mcategory_id = c.mcategory_id 
                          WHERE sp.shop_id = " . $_GET['sid'];
              $result = $con->query($selQry);
              while ($row = $result->fetch_assoc()) {
                $i++;
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><img src="../Assets/Files/Product/Photos/<?php echo $row['product_photo']; ?>" class="img-fluid" style="max-width: 100px; height: auto;" alt="Product Photo" /></td>
              <td><?php echo $row["product_name"]; ?></td>
              <td><?php echo $row["product_description"]; ?></td>
              <td><?php echo $row["product_price"]; ?></td>
              <td><?php echo $row["mcategory_name"]; ?></td>
              <td><?php echo $row["category_name"]; ?></td>
              <td><?php echo $row["subcategory_name"]; ?></td>
              <td><?php echo $row["shop_name"]; ?></td>
              <td><?php echo $row["material_name"]; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
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
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
  h2, h4 {
    color: #343a40;
  }
  .table th, .table td {
    vertical-align: middle;
  }
</style>

</head>

<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Product List</h2>
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
              <th>Action</th>
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
                          WHERE sp.shop_id = " . $_SESSION['sid'];
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
              <td>
                <a href="Product.php?did=<?php echo $row['product_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                <a href="Stock.php?pid=<?php echo $row['product_id']; ?>" class="btn btn-warning btn-sm">Add Stock</a>
                <a href="Gallery.php?pid=<?php echo $row['product_id']; ?>" class="btn btn-info btn-sm">Add Pictures</a>
                <a href="Rating.php?pid=<?php echo $row['product_id']; ?>" class="btn btn-info btn-sm">View Review</a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getCat(mid) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxCategory.php?mid=" + mid,
      success: function (result) {

        $("#sel_cat").html(result);
      }
    });
  }

  function getSubcat(cid) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxSubcategory.php?cid=" + cid,
      success: function (result) {

        $("#sel_subcat").html(result);
      }
    });
  }

</script>

</html>
<?php
            include("Foot.php");
            ob_flush();
?>
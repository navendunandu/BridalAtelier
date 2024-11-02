<?php 
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
session_start();
if(isset($_POST['btn_submit']))
{
	$id=$_GET['pid'];
	$stockqty=$_POST['txt_stockqty'];
    $insQry  ="insert into tbl_stock(stock_quantity,stock_date,product_id) values('$stockqty',curdate(),'$id')";
	if($con->query($insQry))
	{
		?>
        <script>
		alert("Inserted");
		</script>
        <?php
	}
	else
	{
		?>
        <script>
		alert("Error");
		</script>
        <?php

	  }
  }
  if(isset($_GET["did"]))
  {
	  $delQry= "delete from tbl_stock where stock_id=".$_GET["did"];
	  if($con->query($delQry))
	  {
		  ?>
          <script>
		  window.location = "Stock.php";
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
    <h2 class="text-center mb-4">Stock Management</h2>
    
    <form id="form1" name="form1" method="post" action="">
      <div class="card mb-4">
        <div class="card-body">
          <table class="table table-bordered">
            <tr>
              <td><label for="txt_stockqty">Stock Quantity</label></td>
              <td>
                <input required type="text" name="txt_stockqty" id="txt_stockqty" class="form-control" />
              </td>
            </tr>
            <tr>
              <td colspan="2" class="text-center">
                <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-primary" />
              </td>
            </tr>
          </table>
        </div>
      </div>
    </form>

    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Current Stock</h4>
        <table class="table table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>SI No</th>
              <th>Product Name</th>
              <th>Stock Quantity</th>
              <th>Stock Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $i = 0;
              $selQry = "SELECT * FROM tbl_stock s INNER JOIN tbl_product p ON s.product_id = p.product_id WHERE p.product_id = " . $_GET['pid'];
              $result = $con->query($selQry);
              while ($row = $result->fetch_assoc()) {
                $i++;
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $row["product_name"]; ?></td>
              <td><?php echo $row["stock_quantity"]; ?></td>
              <td><?php echo $row["stock_date"]; ?></td>
              <td>
                <a href="Stock.php?did=<?php echo $row["stock_id"]; ?>" class="btn btn-danger btn-sm">Delete</a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php
        $selStock="SELECT SUM(stock_quantity) as sum from tbl_stock where product_id =".$_GET['pid'];
        $resStock=$con->query($selStock);
        $dataStock=$resStock->fetch_assoc();
        $totalStock=$dataStock['sum'];
        $selCart="SELECT SUM(cart_quantity) as sum from tbl_cart where cart_status>=1 AND cart_status<6";
        $resCart=$con->query($selCart);
        $dataCart=$resCart->fetch_assoc();
        $cartStock=$dataCart['sum'];
        $remStock=$totalStock-$cartStock;
        ?>
        <div class="container">
          <p>Total Stock:<?php echo $totalStock ?></p>
          <p>Remaining Stock:<?php echo $remStock ?></p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php
            include("Foot.php");
            ob_flush();
?>
<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
session_start();
if(isset($_POST['btn_submit']))
{
	
	$pname=$_POST['txt_pname'];
	$pdescription=$_POST['txt_pdescription'];
	$pprice=$_POST['txt_pprice'];
	$pphoto=$_FILES['file_pphoto']['name'];
	$temppphoto=$_FILES['file_pphoto']['tmp_name'];
	move_uploaded_file($temppphoto, '../Assets/Files/Product/Photos/'.$pphoto);
	$subcat=$_POST['sel_subcat'];
	$shop=$_POST['sel_shop'];
	$mat=$_POST['sel_material'];
	
	$insQry= "insert into tbl_product(product_name,product_description,product_price,product_photo,subcategory_id,shop_id,material_id) values('$pname','$pdescription','$pprice','$pphoto','$subcat','$shop','$mat')";
	 if($con->query($insQry))
	 {
		 echo "Inserted";
	 }
	 else
	 {
		echo "Error"; 
	 }
	 
}
if(isset($_GET['did'])) 
 {
	 $delQry=" delete from tbl_product where product_id=".$_GET['did'];
	  if($con->query($delQry))
	  {
	  ?>
      <script>
	  window.location="Product.php";
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
    <h2 class="text-center mb-4">Product Management</h2>
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
      <div class="card mb-4">
        <div class="card-body">
          <table class="table table-bordered">
            <tr>
              <td><label for="txt_pname">Product Name</label></td>
              <td><input required type="text" name="txt_pname" title="Name Allows Only Alphabets, Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" id="txt_pname2" class="form-control" /></td>
            </tr>
            <tr>
              <td><label for="txt_pdescription">Product Description</label></td>
              <td><textarea required name="txt_pdescription" id="txt_pdescription" class="form-control" rows="5"></textarea></td>
            </tr>
            <tr>
              <td><label for="txt_pprice">Product Price</label></td>
              <td><input required type="text" name="txt_pprice" id="txt_pprice" class="form-control" /></td>
            </tr>
            <tr>
              <td><label for="file_pphoto">Product Photo</label></td>
              <td><input required type="file" name="file_pphoto" id="file_pphoto" class="form-control-file" /></td>
            </tr>
            <tr>
              <td><label for="sel_mcat">Main Category</label></td>
              <td>
                <select required name="sel_mcat" id="sel_mcat" class="form-control" onChange="getCat(this.value)">
                  <option>--Select--</option>
                  <?php 
                    $selQry = "SELECT * FROM tbl_maincategory";
                    $row = $con->query($selQry);
                    while ($data = $row->fetch_assoc()) {
                  ?>
                  <option value="<?php echo $data['mcategory_id']; ?>"><?php echo $data['mcategory_name']; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><label for="sel_cat">Category</label></td>
              <td>
                <select required name="sel_cat" id="sel_cat" class="form-control" onChange="getSubcat(this.value)">
                  <option>--Select--</option>
                </select>
              </td>
            </tr>
            <tr>
              <td><label for="sel_subcat">Subcategory</label></td>
              <td>
                <select required name="sel_subcat" id="sel_subcat" class="form-control">
                  <option>--Select--</option>
                </select>
              </td>
            </tr>
            <tr>
              <td><label for="sel_shop">Shop</label></td>
              <td>
                <select required name="sel_shop" id="sel_shop" class="form-control">
                  <option>--Select--</option>
                  <?php 
                    $selQry = "SELECT * FROM tbl_shop";
                    $row = $con->query($selQry);
                    while ($data = $row->fetch_assoc()) {
                  ?>
                  <option value="<?php echo $data['shop_id']; ?>"><?php echo $data['shop_name']; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><label for="sel_material">Material</label></td>
              <td>
                <select required name="sel_material" id="sel_material" class="form-control">
                  <option>--Select--</option>
                  <?php 
                    $selQry = "SELECT * FROM tbl_material";
                    $row = $con->query($selQry);
                    while ($data = $row->fetch_assoc()) {
                  ?>
                  <option value="<?php echo $data['material_id']; ?>"><?php echo $data['material_name']; ?></option>
                  <?php } ?>
                </select>
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
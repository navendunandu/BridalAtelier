<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
if(isset($_GET['rid']))
	{
	$UpQry="update tbl_product set product_vstatus=2 where product_vstatus=1 and product_id=".$_GET['rid'];
	if($con->query($UpQry))
	{
		echo "Updated";
	}
	else
	{
		echo "Error";
	}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
        body {
            background-color: #f8f9fa; /* Light background color */
            color: #343a40; /* Dark text color */
        }

        .container {
            margin-top: 30px;
            padding: 20px;
            background-color: black; /* White background for the form */
            border-radius: 0.5rem;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .table img {
            width: 100%; /* Responsive image */
            height: auto; /* Maintain aspect ratio */
        }

        .table th {
            background-color: #007bff; /* Primary color for header */
            color: #ffffff; /* White text for header */
        }

        .table td {
            vertical-align: middle; /* Center align content vertically */
        }

        .action-link {
            color: #dc3545; /* Bootstrap danger color for reject link */
            text-decoration: none;
        }

        .action-link:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4 text-center">Product List</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SI No</th>
                    <th>Product Photo</th>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Product Price</th>
                    <th>Main Category</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Material</th>
                    <th>Shop</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $selQry = "SELECT * FROM tbl_product p 
                            INNER JOIN tbl_subcategory s ON p.subcategory_id=s.subcategory_id 
                            INNER JOIN tbl_category c ON s.category_id=c.category_id 
                            INNER JOIN tbl_shop sp ON sp.shop_id=p.shop_id 
                            INNER JOIN tbl_material m ON p.material_id=m.material_id 
                            INNER JOIN tbl_maincategory mc ON mc.mcategory_id=c.mcategory_id 
                            WHERE p.product_vstatus=1";
                $result = $con->query($selQry);
                while ($row = $result->fetch_assoc()) {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><img src="../Assets/Files/Product/Photos/<?php echo $row['product_photo']; ?>" alt="Product Photo" /></td>
                    <td><?php echo htmlspecialchars($row["product_name"]); ?></td>
                    <td><?php echo htmlspecialchars($row["product_description"]); ?></td>
                    <td><?php echo htmlspecialchars($row["product_price"]); ?></td>
                    <td><?php echo htmlspecialchars($row["mcategory_name"]); ?></td>
                    <td><?php echo htmlspecialchars($row["category_name"]); ?></td>
                    <td><?php echo htmlspecialchars($row["subcategory_name"]); ?></td>
                    <td><?php echo htmlspecialchars($row["material_name"]); ?></td>
                    <td><?php echo htmlspecialchars($row["shop_name"]); ?></td>
                    <td>
                        <a class="action-link" href="AcceptProductList.php?rid=<?php echo $row['product_id']; ?>">Reject</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
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
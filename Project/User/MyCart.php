<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
session_start();
if(isset($_POST['btncheckout']))
{
	$fdate=$_POST['txt_fdate'];
	$rdate=$_POST['txt_rdate'];
	$rate=$_POST['txt_rate'];
	$id=$_POST['txt_id'];
	$upQry="update tbl_booking set booking_status='1',booking_foredate='$fdate',booking_returningdate='$rdate', booking_amount='$rate',booking_date=curdate() where booking_id=".$id;
	$con->query($upQry);
	echo $upQry="update tbl_cart set cart_status='1' where booking_id=".$id;
	$con->query($upQry);
  header("location:Payment.php?bid=".$id);
}
if(isset($_GET['cid']))
{
	$delQry="delete from tbl_cart where cart_id=".$_GET['cid'];
	if($con->query($delQry))
	{
		?>
        <script>
		window.location="MyCart.php";
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
            background-color: #f8f9fa; /* Light background for better contrast */
        }
        h1 {
            color: #343a40; /* Dark color for heading */
            margin-top: 20px;
        }
        .table {
            border-radius: 0.5rem;
            overflow: hidden;
            margin-bottom: 30px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .form-control {
            height: 50px; /* Larger height for input fields */
            font-size: 16px; /* Larger font size */
        }
        .btn-checkout {
            height: 50px; /* Match the height of input fields */
            font-size: 16px; /* Larger font size */
            background-color: #007bff; /* Bootstrap primary color */
            color: white; /* White text */
        }
        .btn-checkout:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        .cart-image {
            max-width: 100px; /* Set a max width for product images */
            height: auto;
        }
    </style>
</head>

</head>

<body>
<form id="form1" name="form1" method="post" action="">
    <?php
    $selQry = "SELECT * FROM tbl_cart c 
                INNER JOIN tbl_booking b ON c.booking_id = b.booking_id 
                INNER JOIN tbl_product p ON c.product_id = p.product_id  
                WHERE b.booking_status = 0 AND c.cart_status = 0 AND b.user_id = " . $_SESSION['uid'];
    $result = $con->query($selQry);
    if ($result->num_rows > 0) {
    ?>
    <div class="container mt-5">
        <h1 class="text-center">My Cart</h1>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>SI No</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            $bid = '';
            $checkout = 0;

            while ($row = $result->fetch_assoc()) {
                $bid = $row['booking_id'];
                $i++;
            ?> 
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><img src="../Assets/Files/Product/Photos/<?php echo $row['product_photo']; ?>" class="cart-image" /></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td>
                        <input required type="number" class="form-control" name="txt_quantity[]" id="txt_quantity_<?php echo $row['cart_id']; ?>" value="<?php echo $row['cart_quantity']; ?>" onChange="Totalprice(this.value,'<?php echo $row['cart_id'] ?>')"/>
                    </td>
                    <td><?php echo number_format($row['product_price'], 2); ?></td>
                    <td><?php $total = $row['product_price'] * $row['cart_quantity']; echo number_format($total, 2); ?></td>
                    <td><a href="MyCart.php?cid=<?php echo $row['cart_id'];?>" class="btn btn-danger btn-sm">Delete</a></td>
                </tr>
            <?php
                $checkout += $total;
            }
            ?>
                <input type="hidden" name="txt_rate" id="txt_rate" value="<?php echo $checkout; ?>" />
                <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $bid; ?>"/>
                <tr>
    <td colspan="5">Booking Foredate</td>
    <td>
        <input required type="date" class="form-control" name="txt_fdate" id="txt_fdate" onChange="calculateTotal()" />
    </td>
</tr>
<tr>
    <td colspan="5">Booking Return Date</td>
    <td>
        <input required type="date" class="form-control" name="txt_rdate" id="txt_rdate" onChange="calculateTotal()" />
    </td>
</tr>
                <tr>
                    <td colspan="5">Bill Amount Price</td>
                    <td id="checkout-price"><?php echo number_format($checkout, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="5">Checkout Price</td>
                    <td><?php echo number_format($checkout, 2); ?></td>
                    <td><input type="submit" name="btncheckout" class="btn-checkout" value="Checkout" /></td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
    } else {
        echo "<h1 class='text-center'>No Items In Cart</h1>";
    }
    ?>
</form>
</body>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function Totalprice(qty,cid) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxTPrice.php?qty="+qty+"&cid="+cid,
      success: function (result) {

        //$("#txt_quantity").html(result);
		window.location.reload()
      }
    });
  }
</script>
<script>
function calculateTotal() {
    const fdate = new Date(document.getElementById('txt_fdate').value);
    const rdate = new Date(document.getElementById('txt_rdate').value);
    
    // Calculate the number of days
    if (fdate && rdate && fdate < rdate) {
        const timeDiff = rdate - fdate;
        const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Convert milliseconds to days
        const rate = parseFloat(document.getElementById('txt_rate').value);
        
        // Calculate total
        const totalAmount = daysDiff * rate;
        
        // Update the total in the table
        document.getElementById('checkout-price').textContent = totalAmount.toFixed(2);
    } else {
        document.getElementById('checkout-price').textContent = '0.00';
    }
}
</script>

</html>
<?php
            include("Foot.php");
            ob_flush();
?>
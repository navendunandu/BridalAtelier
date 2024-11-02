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
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Light background for contrast */
            font-family: Arial, sans-serif;
            color: #343a40; /* Dark color for text */
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff; /* Color for the heading */
        }
        .table img {
            max-width: 100px; /* Control image size */
            max-height: 100px;
            border-radius: 5%; /* Optional: make images rounded */
        }
        .table th, .table td {
            vertical-align: middle; /* Align content vertically */
        }
        .status-pending {
            color: orange;
        }
        .status-packed {
            color: blue;
        }
        .status-shipped {
            color: green;
        }
        .status-delivered {
            color: purple;
        }
        .status-returned {
            color: red;
        }
    </style>
</head>

<body>
<div class="container">
    <h2>Booking List</h2>
    <table class="table table-bordered table-striped">
        <thead>
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
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $selQry = "SELECT * FROM tbl_booking b 
                        INNER JOIN tbl_cart c ON b.booking_id = c.booking_id 
                        INNER JOIN tbl_product p ON p.product_id = c.product_id 
                        WHERE b.booking_status >= '2'";
            $result = $con->query($selQry);
            while ($row = $result->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><img src="../Assets/Files/Product/Photos/<?php echo htmlspecialchars($row['product_photo']); ?>" alt="Product Photo" /></td>
                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                <td><?php echo htmlspecialchars($row['cart_quantity']); ?></td>
                <td><?php echo htmlspecialchars($row['booking_foredate']); ?></td>
                <td><?php echo htmlspecialchars($row['booking_returningdate']); ?></td>
                <td><?php echo htmlspecialchars($row['product_price']); ?></td>
                <td><?php echo htmlspecialchars($row['cart_quantity'] * $row['product_price']); ?></td>
                <td class="<?php 
                    switch ($row['cart_status']) {
                        case 1: echo 'status-pending'; echo 'Order is being packed'; break;
                        case 2: echo 'status-packed'; echo 'Order packed'; break;
                        case 3: echo 'status-shipped'; echo 'Order Shipped'; break;
                        case 4: echo 'status-delivered'; echo 'Delivered'; break;
                        case 5: echo 'status-returned'; echo 'Returned'; break;
                        default: echo 'status-pending'; echo 'Unknown Status'; break;
                    } 
                ?>">
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
<?php
            include("Foot.php");
            ob_flush();
?>
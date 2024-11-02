<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
?>


            <!-- Sale & Revenue Start -->
            <!-- <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Sale</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Sale</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- Sale & Revenue End -->


            


            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Recent Salse</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="table-responsive">
    <table class="table text-start align-middle table-bordered table-hover mb-0">
        <thead class="text-white">
            <tr>
                <th scope="col">SINo</th>
                <th scope="col">Photo</th>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Foredate</th>
                <th scope="col">Return Date</th>
                <th scope="col">Price</th>
                <th scope="col">Total Price</th>
                <th scope="col">Status</th>
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
                <td><img src="../Assets/Files/Product/Photos/<?php echo $row['product_photo']; ?>" class="img-fluid" style="max-width: 100px; max-height: 100px;" /></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['cart_quantity']; ?></td>
                <td><?php echo $row['booking_foredate']; ?></td>
                <td><?php echo $row['booking_returningdate']; ?></td>
                <td><?php echo $row['product_price']; ?></td>
                <td><?php echo $row['cart_quantity'] * $row['product_price']; ?></td>
                <td>
                    <?php 
                    if ($row['cart_status'] == 1) {
                        echo "Order is being packed";
                    } else if ($row['cart_status'] == 2) {
                        echo "Order packed";
                    } else if ($row['cart_status'] == 3) {
                        echo "Order Shipped";
                    } else if ($row['cart_status'] == 4) {
                        echo "Delivered";
                       
                    } else if ($row['cart_status'] == 5) {
                        $selDate = "SELECT DATEDIFF(CURDATE(), STR_TO_DATE(booking_foredate, '%Y-%m-%d')) AS date_difference 
                                    FROM tbl_booking WHERE booking_id = " . $row['booking_id'];
                        $date = $con->query($selDate);
                        $data = $date->fetch_assoc();
                        $days = $data['date_difference'] > 1 ? $data['date_difference'] - 1 : 0; 
                        echo $days . ' days<br>';
                        $totalRent = $days * $row['product_price'];
                        echo "Total Rent (after 1 day deduction): " . $totalRent . "<br>";
                       
                    } else if ($row['cart_status'] == 6) {
                        echo "Return Completed";
                    }
                    ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

                </div>
            </div>
            <!-- Recent Sales End -->




            <!-- Footer Start -->
            
            <?php
            include("Foot.php");
            ob_flush();
?>
            
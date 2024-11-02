<div class="container mt-4">
    <div class="row">
        <?php
        include("../Connection/connection.php");
        $txt = $_GET['txt'];
        $mcat = $_GET['mcat'];
        $cat = $_GET['cat'];
        $subcat = $_GET['subcat'];
        $mat = $_GET['mat'];
        $minprice = $_GET['minprice'];
        $maxprice = $_GET['maxprice'];
        
        $selQry = "SELECT * FROM tbl_product p 
                    INNER JOIN tbl_subcategory s ON p.subcategory_id=s.subcategory_id 
                    INNER JOIN tbl_category c ON s.category_id=c.category_id 
                    INNER JOIN tbl_material m ON p.material_id=m.material_id 
                    INNER JOIN tbl_maincategory mc ON mc.mcategory_id=c.mcategory_id 
                    WHERE TRUE";
        
        if ($txt != "") {
            $selQry .= " AND product_name LIKE '%$txt%'";
        }
        if ($mcat != "") {
            $selQry .= " AND mc.mcategory_id=" . $mcat;
        }
        if ($cat != "") {
            $selQry .= " AND c.category_id=" . $cat;
        }
        if ($subcat != "") {
            $selQry .= " AND s.subcategory_id=" . $subcat;
        }
        if ($mat != "") {
            $selQry .= " AND m.material_id=" . $mat;
        }
        if ($minprice != "") {
            $selQry .= " AND product_price>=" . $minprice;
        }
        if ($maxprice != "") {
            $selQry .= " AND product_price<=" . $maxprice;
        }
        
        $result = $con->query($selQry);
        
        while ($data = $result->fetch_assoc()) {
            $id = $data['product_id'];
            $cart = "SELECT SUM(cart_quantity) AS cart_total FROM tbl_cart WHERE product_id='$id' AND cart_status BETWEEN 1 AND 5";
            $cresult = $con->query($cart);
            $cdata = $cresult->fetch_assoc();
            $stock = "SELECT SUM(stock_quantity) AS total_stock FROM tbl_stock WHERE product_id='$id'";
            $sresult = $con->query($stock);
            $sdata = $sresult->fetch_assoc();
            $rem = $sdata['total_stock'] - $cdata['cart_total'];
            ?>

            <div class="col-md-3 mb-4">
                <div class="card product-card">
                    <img src="../Assets/Files/Product/Photos/<?php echo $data['product_photo'] ?>" class="card-img-top" alt="<?php echo $data['product_name'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $data['product_name'] ?></h5>
                        <p class="card-text">Price: $<?php echo number_format($data['product_price'], 2) ?></p>
                        <p class="card-text">
                            <?php if ($rem <= 0) {
                                echo "<span class='text-danger'>Out of stock</span>";
                            } else { ?>
                                <a href='#' class="btn btn-primary" onClick="addCart('<?php echo $data['product_id'] ?>')">Add to Cart</a>
                            <?php } ?>
                        </p>
                        <a href="ViewMore.php?pid=<?php echo $data['product_id'] ?>" class="btn btn-secondary">View More</a>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
</div>

<style>
        .product-card {
            height: 100%; /* Ensures all cards have the same height */
        }
        .card-img-top {
            height: 300px;
            object-fit: cover;
        }
    </style>
<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
session_start();
$id = $_GET['pid'];
$selQry = "SELECT * FROM tbl_product p 
            INNER JOIN tbl_subcategory s ON p.subcategory_id = s.subcategory_id 
            INNER JOIN tbl_category c ON s.category_id = c.category_id 
            INNER JOIN tbl_shop sp ON sp.shop_id = p.shop_id 
            INNER JOIN tbl_material m ON p.material_id = m.material_id 
            INNER JOIN tbl_maincategory mc ON mc.mcategory_id = c.mcategory_id 
            WHERE p.product_id = " . $id;
$result = $con->query($selQry);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Product Details</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background-color: #f8f9fa;
        padding: 20px;
        font-family: 'Arial', sans-serif;
    }
    table {
        margin-bottom: 30px;
        border-collapse: collapse;
    }
    .gallery {
        display: flex;
        flex-wrap: wrap; /* Allows images to wrap */
        margin-top: 15px; /* Space above the gallery */
    }
    .gallery img {
        border-radius: 5px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer; /* Change cursor to pointer on hover */
        margin-right: 10px; /* Space between images */
        margin-bottom: 10px; /* Space below images */
        max-width: calc(20% - 10px); /* Adjust this to fit your layout */
        max-height: 300px; /* Uniform height for thumbnails */
        height: auto; /* Maintain aspect ratio */
    }
    .gallery img:hover {
        transform: scale(1.05); /* Scale image up */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); /* Shadow on hover */
    }
    .main-image {
        max-width: 100%; /* Full width for the main image */
        max-height: 400px; /* Increased maximum height for the main image */
        object-fit: cover; /* Maintain aspect ratio */
        margin-bottom: 15px; /* Space below the main image */
        border-radius: 5px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .main-image:hover {
        transform: scale(1.05); /* Scale main image on hover */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5); /* Shadow on hover */
    }
</style>
</head>

<body>

    <div class="container">
        <h2 class="text-center mb-4">Product Details</h2>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <td><strong>Product Name</strong></td>
                        <td><?php echo $row['product_name']?></td>
                    </tr>
                    <tr>
                        <td><strong>Product Description</strong></td>
                        <td><?php echo $row['product_description']?></td>
                    </tr>
                    <tr>
                        <td><strong>Price</strong></td>
                        <td><?php echo $row['product_price']?></td>
                    </tr>
                    <tr>
                        <td><strong>Subcategory</strong></td>
                        <td><?php echo $row['subcategory_name']?></td>
                    </tr>
                    <tr>
                        <td><strong>Category</strong></td>
                        <td><?php echo $row['category_name']?></td>
                    </tr>
                    <tr>
                        <td><strong>Main Category</strong></td>
                        <td><?php echo $row['mcategory_name']?></td>
                    </tr>
                    <tr>
                        <td><strong>Material</strong></td>
                        <td><?php echo $row['material_name']?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h3>Gallery</h3>
                <?php
                $selGal = "SELECT * FROM tbl_gallery WHERE product_id='$id'";
                $gresult = $con->query($selGal);
                $firstImageSrc = ""; // To store the first image source
                $first = true;

                while ($pic = $gresult->fetch_assoc()) {
                    if ($first) {
                        // Display the first image on the right with an increased maximum height
                        $firstImageSrc = "../Assets/Files/Gallery/" . $pic['gallery_image'];
                        echo '<img src="' . $firstImageSrc . '" class="main-image img-fluid" id="mainImage" alt="Gallery Image">';
                        $first = false; // Set flag to false after first image
                    }
                }
                ?>
            </div>
        </div>
        
        <div class="gallery">
            <?php
            // Reset query to get thumbnails
            $gresult->data_seek(0); // Reset the result set pointer
            while ($pic = $gresult->fetch_assoc()) {
                // Display thumbnails
                echo '<img src="../Assets/Files/Gallery/' . $pic['gallery_image'] . '" class="img-fluid" onclick="changeMainImage(this.src)" alt="Gallery Image">';
            }
            ?>
        </div>
    </div>

    <script>
        function changeMainImage(src) {
            // Change the main image source
            document.getElementById('mainImage').src = src;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>

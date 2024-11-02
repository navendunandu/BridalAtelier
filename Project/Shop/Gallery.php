<?php 
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
if(isset($_POST['btn_submit']))
{
	$id=$_GET['pid'];
    $galimg=$_FILES['file_image']['name']; 
	$tempgalimg=$_FILES['file_image']['tmp_name']; 
	move_uploaded_file($tempgalimg,'../Assets/Files/Gallery/'.$galimg);
    $insQry="insert into tbl_gallery(gallery_image,product_id) values('$galimg','$id')";
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
	  $delQry= "delete from tbl_gallery where gallery_id=".$_GET["did"];
	  if($con->query($delQry))
	  {
		  ?>
          <script>
		  window.location = "Gallery.php";
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
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
        body {
            background-color: #f8f9fa; /* Light background color */
        }
        .container {
            margin-top: 20px;
            padding: 20px;
            border-radius: 8px;
            background-color: #ffffff; /* White background for the container */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow effect */
        }
        h2 {
            color: #343a40; /* Darker heading color */
        }
        .img-thumbnail {
            max-width: 100px; /* Limit thumbnail size */
            height: auto; /* Maintain aspect ratio */
        }
        .btn-danger {
            transition: background-color 0.3s ease; /* Smooth transition for button */
        }
        .btn-danger:hover {
            background-color: #dc3545; /* Darker red on hover */
            color: white; /* White text on hover */
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4">Upload Gallery Image</h2>
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <div class="form-group">
                <label for="file_image">Gallery Image</label>
                <input required type="file" class="form-control-file" name="file_image" id="file_image" />
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" id="btn_submit" value="Submit" name="btn_submit" />
            </div>
        </form>

        <h2 class="mt-5">Gallery Images</h2>
        <table class="table table-bordered mt-3">
            <thead class="thead-light">
                <tr>
                    <th>SI No</th>
                    <th>Product Name</th>
                    <th>Gallery Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $selQry = "SELECT * FROM tbl_gallery g INNER JOIN tbl_product p ON g.product_id = p.product_id where g.product_id=".$_GET['pid'];
                $result = $con->query($selQry);
                while ($row = $result->fetch_assoc()) {
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row["product_name"]; ?></td>
                        <td><img src="../Assets/Files/Gallery/<?php echo $row['gallery_image'];?>" class="img-thumbnail" ></td>
                        <td><a href="Gallery.php?did=<?php echo $row["gallery_id"]; ?>" class="btn btn-danger btn-sm">Delete</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
            include("Foot.php");
            ob_flush();
?>

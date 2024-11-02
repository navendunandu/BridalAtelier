<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
session_start();
if(isset($_POST['btn_submit']))
{
	$title=$_POST['txt_title'];
	$des=$_POST['txt_des'];
	$file=$_FILES['file_complaint']['name'];
	$tempfile=$_FILES['file_complaint']['tmp_name'];
	move_uploaded_file($tempfile, '../Assets/Files/User/Complaint/'.$file);
	$pid=$_GET['pid'];
	$uid=$_SESSION['uid'];
	$insQry="insert into tbl_complaint(complaint_title,complaint_content,complaint_date,user_id,product_id,complaint_file) values('$title','$des',curdate(),'$uid','$pid','$file')";
	if($con->query($insQry))
	{
	}
	else{
		echo "ERROR";
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
            background-color: #f8f9fa;
            padding: 20px;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

<div class="container">
    <div class="form-container">
        <h2 class="text-center">Submit Your Details</h2>
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <div class="form-group">
                <label for="txt_title">Title</label>
                <input required type="text" class="form-control" name="txt_title" id="txt_title" />
            </div>
            <div class="form-group">
                <label for="txt_des">Description</label>
                <textarea required class="form-control" name="txt_des" id="txt_des" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="file_complaint">File</label>
                <input required type="file" class="form-control-file" name="file_complaint" id="file_complaint" />
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="Submit" />
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
            include("Foot.php");
            ob_flush();
?>
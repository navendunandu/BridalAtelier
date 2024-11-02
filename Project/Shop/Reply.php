<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
if(isset($_POST['btn_reply']))
{
	$reply=$_POST['txt_reply'];
	$upQry="update tbl_complaint set complaint_reply='$reply',complaint_status='1' where complaint_id=".$_GET['cid'];
	if($con->query($upQry))
	{		
	}
	else
	{
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
    <title>Reply Form</title>
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .btn {
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="container mt-5">
    <form id="form1" name="form1" method="post" action="">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Reply</h5>
                <div class="form-group">
                    <label for="txt_reply">Your Reply</label>
                    <input required type="text" class="form-control" name="txt_reply" id="txt_reply" />
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" name="btn_reply" id="btn_reply" value="Reply" />
                </div>
            </div>
        </div>
    </form>
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
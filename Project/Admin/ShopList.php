<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
$selQry="select * from tbl_shop";
$Result=$con->query($selQry);
$row=$Result->fetch_assoc();

if(isset($_GET['aid']))
	{ 
		$UpQry="update tbl_shop set shop_vstatus=1 where shop_vstatus=0 and  shop_id=".$_GET['aid'];
		if($con->query($UpQry))
	{
		?>
            <script>
                alert("Shop Accepted");
                window.location="MailMessage.php?aid=<?php echo $_GET['aid'] ?>"
            </script>
 <?php
	}
	else
	?>
		<script>
                alert("Something went wrong!");
            </script>
	<?php
	}
	 if(isset($_GET['rid']))
	{
	$UpQry="update tbl_shop set shop_vstatus=2 where shop_vstatus=0 and shop_id=".$_GET['rid'];
	if($con->query($UpQry))
	{
		?>
            <script>
                alert("Shop Rejected");
                window.location="MailMessage.php?aid=<?php echo $_GET['rid'] ?>"
            </script>
 <?php
	}
	else
	?>
		<script>
                alert("Something went wrong!");
            </script>
	<?php
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
            font-family: Arial, sans-serif;
            color: #ffffff;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .table img {
            max-width: 50px; /* Adjusts image size */
            max-height: 50px; /* Adjusts image size */
        }
        .action-links a {
            margin-right: 10px;
        }
    </style>
</head>

<body>
<div class="container">
    <h2>Shop List</h2>
    <form id="form1" name="form1" method="post" action="">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SI No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Place</th>
                    <th>District</th>
                    <th>Logo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $selQry = "SELECT * FROM tbl_shop s 
                           INNER JOIN tbl_place p ON s.place_id = p.place_id 
                           INNER JOIN tbl_district d ON p.district_id = d.district_id 
                           WHERE shop_vstatus = 0";
                $result = $con->query($selQry);
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo htmlspecialchars($row['shop_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['shop_email']); ?></td>
                    <td><?php echo htmlspecialchars($row['shop_contact']); ?></td>
                    <td><?php echo htmlspecialchars($row['shop_address']); ?></td>
                    <td><?php echo htmlspecialchars($row['place_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['district_name']); ?></td>
                    <td>
                        <img src="../Assets/Files/Shop/Logo/<?php echo htmlspecialchars($row['shop_logo']); ?>" alt="Shop Logo" />
                    </td>
                    <td class="action-links">
                        <a href="ShopList.php?aid=<?php echo $row['shop_id']; ?>" class="btn btn-success btn-sm">Accept</a>
                        <a href="ShopList.php?rid=<?php echo $row['shop_id']; ?>" class="btn btn-danger btn-sm">Reject</a>
                        <a href="ShopProfile.php?sid=<?php echo $row['shop_id']; ?>" class="btn btn-danger btn-sm">View Profile</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </form>
</div>
</body>
</html>
<?php
            include("Foot.php");
            ob_flush();
?>
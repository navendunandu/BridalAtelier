S<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
$selQry="select * from tbl_shop";
$Result=$con->query($selQry);
$row=$Result->fetch_assoc();

if(isset($_GET['aid']))
	{ 
		$UpQry="update tbl_shop set shop_vstatus=1 where shop_vstatus=2 and  shop_id=".$_GET['aid'];
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
            width: 50px; /* Fixed width for logos */
            height: auto; /* Maintain aspect ratio */
            border-radius: 5px; /* Rounded corners for images */
        }

        .table th {
            background-color: #007bff; /* Primary color for header */
            color: #ffffff; /* White text for header */
        }

        .table td {
            vertical-align: middle; /* Center align content vertically */
        }

        .action-link {
            color: #dc3545; /* Danger color for reject link */
            text-decoration: none;
        }

        .action-link:hover {
            text-decoration: underline; /* Underline on hover */
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
                            WHERE shop_vstatus = '2'";
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
                        <a href="RejectShopList.php?aid=<?php echo $row['shop_id']; ?>" class="btn btn-success btn-sm">Accept</a>
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
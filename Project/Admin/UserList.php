<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
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
            max-width: 80px; /* Control image size */
            max-height: 80px;
            border-radius: 50%; /* Optional: make images circular */
        }
        .table th, .table td {
            vertical-align: middle; /* Align content vertically */
        }
    </style>
</head>

<body>
<div class="container">
    <h2>User List</h2>
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
                <th>Photo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $selQry = "SELECT * FROM tbl_user u 
                        INNER JOIN tbl_place p ON u.place_id = p.place_id 
                        INNER JOIN tbl_district d ON p.district_id = d.district_id";
            $result = $con->query($selQry);
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                <td><?php echo htmlspecialchars($row['user_email']); ?></td>
                <td><?php echo htmlspecialchars($row['user_contact']); ?></td>
                <td><?php echo htmlspecialchars($row['user_address']); ?></td>
                <td><?php echo htmlspecialchars($row['place_name']); ?></td>
                <td><?php echo htmlspecialchars($row['district_name']); ?></td>
                <td><img src="../Assets/Files/User/Photo/<?php echo htmlspecialchars($row['user_photo']); ?>" alt="User Photo" /></td>
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
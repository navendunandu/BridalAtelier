mail message<?php
include("../Assets/Connection/connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';

if (isset($_POST['btn_submit'])) {
    if (isset($_GET['aid'])) {
        $id = $_GET['aid'];
        $title = "Shop Verification Approved!";
    } else {
        $id = $_GET['rid'];
        $title = "Shop Verification Unsuccessful!";
    }

    $selQry = "SELECT * from tbl_Shop where Shop_id=" . $id;
    $res = $con->query($selQry);
    $data = $res->fetch_assoc();
    $name = $data['shop_name'];
    $email = $data['shop_email'];

    $msg = $_POST['txt_msg'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'thebridalatelierr@gmail.com'; // Your Gmail address
        $mail->Password = 'rczm knjv itvu tqix'; // Your Gmail app password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('thebridalatelierr@gmail.com', 'Bridal Atelier Team'); // Your Gmail
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = $title;
        $mail->Body = "Dear {$name} Team,<br><br>{$msg}<br><br>Best regards,<br>Bridal Atelier Team"; // Mail body

        if ($mail->send()) {
            echo "<script>
                    alert('Email Sent');
                    window.location = 'Homepage.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Email Failed');
                  </script>";
        }
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Custom styling */
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <form action="" method="post">
                <div class="form-group">
                    <label for="txt_msg">Message</label>
                    <textarea name="txt_msg" id="txt_msg" rows="5" class="form-control" placeholder="Enter your message here"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="btn_submit">Send</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

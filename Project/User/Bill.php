<?php
include("../Assets/Connection/connection.php"); 
$selqry="select * from tbl_cart c inner join tbl_booking b on b.booking_id=c.booking_id inner join tbl_user u on u.user_id=b.user_id inner join tbl_product p on p.product_id=c.product_id inner join tbl_shop k on k.shop_id=p.shop_id where c.cart_id='".$_GET["id"]."'";
$result=$con->query($selqry);
$data=$result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Tax Invoice</title>
    <link rel="shortcut icon" type="image/png" href="./favicon.png" />
    <style>
      * {
        box-sizing: border-box;
      }

      .table-bordered td,
      .table-bordered th {
        border: 1px solid #ddd;
        padding: 10px;
        word-break: break-all;
      }

      body {
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        font-size: 16px;
      }
      .h4-14 h4 {
        font-size: 12px;
        margin-top: 0;
        margin-bottom: 5px;
      }
      .img {
        margin-left: "auto";
        margin-top: "auto";
        height: 30px;
      }
      pre,
      p {
        /* width: 99%; */
        /* overflow: auto; */
        /* bpicklist: 1px solid #aaa; */
        padding: 0;
        margin: 0;
      }
      table {
        font-family: arial, sans-serif;
        width: 100%;
        border-collapse: collapse;
        padding: 1px;
      }
      .hm-p p {
        text-align: left;
        padding: 1px;
        padding: 5px 4px;
      }
      td,
      th {
        text-align: left;
        padding: 8px 6px;
      }
      .table-b td,
      .table-b th {
        border: 1px solid #ddd;
      }
      th {
        /* background-color: #ddd; */
      }
      .hm-p td,
      .hm-p th {
        padding: 3px 0px;
      }
      .cropped {
        float: right;
        margin-bottom: 20px;
        height: 100px; /* height of container */
        overflow: hidden;
      }
      .cropped img {
        width: 400px;
        margin: 8px 0px 0px 80px;
      }
      .main-pd-wrapper {
        box-shadow: 0 0 10px #ddd;
        background-color: #fff;
        border-radius: 10px;
        padding: 15px;
      }
      .table-bordered td,
      .table-bordered th {
        border: 1px solid #ddd;
        padding: 10px;
        font-size: 14px;
      }
    </style>
  </head>
  <body>
 <br /><br /><br /><br /><br /><br />
  <button id="cmd" onClick="printDiv('content')" style="float:right;color:#FFF;background:#0C0;border:none;margin:20px;padding:10px;border-radius:10px" >Download Bill</button>
    <section class="main-pd-wrapper" style="width: 1000px; margin: auto" id="content">
      <div style="display: table-header-group">
        <h4 style="text-align: center; margin: 0">
          <b>Tax Invoice</b>
        </h4>

        <table style="width: 100%; table-layout: fixed">
          <tr>
            <td
              style="border-left: 1px solid #ddd; border-right: 1px solid #ddd"
            >
              <div
                style="
                  text-align: center;
                  margin: auto;
                  line-height: 1.5;
                  font-size: 14px;
                  color: #4a4a4a;
                "
              >
              	<span
                style="color:#F93;font-size:56px">Bridal Atelier</span>

                <p style="font-weight: bold; margin-top: 15px">
                  GST TIN : 06AAFCD6498P1ZT
                </p>
                <p style="font-weight: bold">
                  Toll Free No. :
                  <a href="tel:018001236477" style="color: #00bb07"
                    >1800-123-6477</a
                  >
                </p>
              </div>
            </td>
            <td
              align="right"
              style="
                text-align: right;
                padding-left: 50px;
                line-height: 1.5;
                color: #323232;
              "
            >
              <div>
                <h4 style="margin-top: 5px; margin-bottom: 5px">
                  Bill to/ Ship to
                </h4>
                <p style="font-size: 14px">
                  <?php echo $data["user_address"] ?>
                  <br />
                  Tel:<?php echo $data["user_contact"] ?>
                </p>
              </div>
            </td>
          </tr>
        </table>
      </div>
      <table
        class="table table-bordered h4-14"
        style="width: 100%; -fs-table-paginate: paginate; margin-top: 15px"
      >
        <thead style="display: table-header-group">
          <tr
            style="
              margin: 0;
              background: #fcbd021f;
              padding: 15px;
              padding-left: 20px;
              -webkit-print-color-adjust: exact;
            "
          >
            <td colspan="4">
              <p>Booking Date:- <?php echo $data["booking_date"] ?></p>
              <p style="margin: 5px 0">Invoice Generated:- <?php echo date("Y-m-d"); ?></p>
            </td>
            <td colspan="4" style="width: 300px">
              <h4 style="margin: 0">Sold By:</h4>
              <p>
                <?php echo $data["shop_name"] ?>
              </p>
            </td>
          </tr>

          <tr>
            <th style="width: 50px">#</th>
            <th style="width: 150px">Product</th>
            <th style="width: 100px">Photo</th>
            <th style="width: 150px">Price</th>
            <th style="width: 80px">Qty</th>
            <th style="width: 80px">From Date</th>
            <th style="width: 80px">To Date</th>
            <th style="width: 120px"><h4>TOTAL Value</h4></th>
          </tr>
        </thead>
        <tbody>
        <?php
$selqry1 = "SELECT * FROM tbl_cart c 
             INNER JOIN tbl_booking b ON b.booking_id=c.booking_id 
             INNER JOIN tbl_user u ON u.user_id=b.user_id 
             INNER JOIN tbl_product p ON p.product_id=c.product_id 
             INNER JOIN tbl_shop k ON k.shop_id=p.shop_id 
             WHERE c.cart_id='" . $_GET["id"] . "'";
$result1 = $con->query($selqry1);
$grandTotal = 0;

while ($data1 = $result1->fetch_assoc()) {
    $total = $data1["product_price"] * $data1["cart_quantity"];

    $sdate = $data1["booking_foredate"];
    $edate = $data1["booking_returningdate"];

    // Create DateTime objects
    $startDate = new DateTime($sdate);
    $endDate = new DateTime($edate);

    // Calculate the difference
    $interval = $startDate->diff($endDate);

    // Get the total number of days in the interval
    $totalDays = $interval->days;

    // Calculate the total price based on the number of days
    $totalPrice = $total * ($totalDays > 0 ? $totalDays : 1); // Prevent multiplying by zero

    $grandTotal += $totalPrice;
    ?>
    <tr>
        <td>01</td>
        <td><?php echo $data1["product_name"] ?></td>
        <td><img src="../Assets/Files/Product/Photos/<?php echo $data1["product_photo"]; ?>" width="119" height="92" /></td>
        <td><?php echo $data1["product_price"] ?></td>
        <td><?php echo $data1["cart_quantity"] ?></td>
        <td><?php echo $data1["booking_foredate"] ?></td>
        <td><?php echo $data1["booking_returningdate"] ?></td>
        <td><?php echo $totalPrice ?></td>
    </tr>
    <?php
}
?>

        </tbody>
        <tfoot></tfoot>
      </table>

      
      <table class="hm-p table-bordered" style="width: 100%; margin-top: 30px">
        
        <tr style="background: #fcbd02">
          <th>Total Order Value</th>
          <td style="width: 70px; text-align: right; border-right: none">
            <b><?php echo $grandTotal ?></b>
          </td>
          <td colspan="5" style="border-left: none"></td>
        </tr>
      </table>
    </section>
    
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js'></script>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
</body>
</html>

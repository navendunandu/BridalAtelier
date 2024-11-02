<?php
include("../Connection/connection.php");
$id=$_GET['cid'];
$qty=$_GET['qty'];
$upQry="update tbl_cart set cart_quantity='$qty' where cart_id='$id'";
$con->query($upQry);
$selQry="select * from tbl_product ";

?>
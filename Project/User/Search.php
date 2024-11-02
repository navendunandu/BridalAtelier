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
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa; /* Light background */
    }
    h2 {
      color: #343a40; /* Dark color for heading */
      margin-bottom: 30px;
    }
    .table {
      border-radius: 0.5rem;
      overflow: hidden;
    }
    .table th, .table td {
      vertical-align: middle;
    }
    .form-control {
      height: 50px; /* Larger height for input fields */
      font-size: 16px; /* Larger font size */
    }
    .search-btn {
      height: 50px; /* Match the height of input fields */
      font-size: 16px; /* Larger font size */
      background-color: #007bff; /* Bootstrap primary color */
      color: white; /* White text */
    }
    .search-btn:hover {
      background-color: #0056b3; /* Darker blue on hover */
    }
  </style>
</head>


</head>

<body onload="getSearch()">
  <div class="container mt-5">
    <h2 class="text-center">Product Search</h2>
    
    <div class="container">
    <form id="form1" name="form1" method="post" action="" class="search-form">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="sel_mcategory">Main Category</label>
                <select class="form-control" name="sel_mcategory" id="sel_mcategory" onchange="getCat(this.value), getSearch()">
                    <option value="">--Select--</option>
                    <?php 
                    $selQry = "SELECT * FROM tbl_maincategory";
                    $row = $con->query($selQry);
                    while ($data = $row->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $data['mcategory_id']; ?>"><?php echo $data['mcategory_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="sel_category">Category</label>
                <select class="form-control" name="sel_category" id="sel_category" onchange="getSubcat(this.value), getSearch()">
                    <option value="">--Select--</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="sel_scategory">Subcategory</label>
                <select class="form-control" name="sel_scategory" id="sel_scategory" onchange="getSearch()">
                    <option value="">--Select--</option>
                </select>
            </div>
        </div>
        <div class="form-row">
           
            <div class="form-group col-md-4">
                <label for="sel_material">Material</label>
                <select class="form-control" name="sel_material" id="sel_material" onchange="getSearch()">
                    <option value="">--Select--</option>
                    <?php 
                    $selQry = "SELECT * FROM tbl_material";
                    $row = $con->query($selQry);
                    while ($data = $row->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $data['material_id']; ?>"><?php echo $data['material_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="txt_minprice">Minimum Rate</label>
                <input type="text" class="form-control" name="txt_minprice" id="txt_minprice" onchange="getSearch()" placeholder="Min Price" />
            </div>
            <div class="form-group col-md-4">
                <label for="txt_maxprice">Maximum Rate</label>
                <input type="text" class="form-control" name="txt_maxprice" id="txt_maxprice" onchange="getSearch()" placeholder="Max Price" />
            </div>
        </div>
       
        <div class="form-row">
        <div class="form-group col-md-12">
                <label for="txt_pname">Search</label>
                <input type="text" class="form-control" name="txt_pname" id="txt_pname" onchange="getSearch()" placeholder="Enter product name..." />
            </div>
        </div>
    </form>
</div>
<div class="new-arrival">
            <div class="container" id="result">
              
                    </div></div>
  </div>
</body>


<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getCat(mid) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxCategory.php?mid=" + mid,
      success: function (result) {

        $("#sel_category").html(result);
      }
    });
  }
 
  function getSubcat(cid) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxSubcategory.php?cid=" + cid,
      success: function (result) {

        $("#sel_scategory").html(result);
      }
    });
  }
 function getSearch() {
	 var txt=document.getElementById('txt_pname').value.trim();
	 var mcat=document.getElementById('sel_mcategory').value.trim();
	 var cat=document.getElementById('sel_category').value.trim();
	 var subcat=document.getElementById('sel_scategory').value.trim();
	 var mat=document.getElementById('sel_material').value.trim();
	 var minprice=document.getElementById('txt_minprice').value.trim();
	 var maxprice=document.getElementById('txt_maxprice').value.trim();
    $.ajax({
      url: "../Assets/AjaxPages/AjaxSearch.php?txt="+txt+"&mcat="+mcat+"&cat="+cat+"&subcat="+subcat+"&mat="+mat+"&minprice="+minprice+"&maxprice="+maxprice,
      success: function (result) {

        $("#result").html(result);
      }
    });
  }
 function addCart(pid){
    $.ajax({
        url: '../Assets/AjaxPages/AjaxAddCart.php?pid=' + pid,
        success: function(response) {
            alert(response);
        }
    });
} 
  
</script>
</html>
<?php
            include("Foot.php");
            ob_flush();
?>
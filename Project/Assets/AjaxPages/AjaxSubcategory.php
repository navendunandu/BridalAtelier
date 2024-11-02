<option value="">Select Subcategory</option>
<?php
include("../Connection/connection.php");
		  $selQry=" select * from tbl_subcategory where category_id=".$_GET['cid'];
		  $result=$con->query($selQry);
		  while($data=$result->fetch_assoc())
		  {
		  ?>
		  <option value="<?php echo $data['subcategory_id'] ?>"><?php echo $data['subcategory_name'] ; ?></option>
          <?php
		  }
		  ?>
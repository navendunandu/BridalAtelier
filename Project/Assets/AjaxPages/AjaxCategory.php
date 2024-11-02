<option value="">Select Category</option>
<?php
include("../Connection/connection.php");
		  $selQry=" select * from tbl_category where mcategory_id=".$_GET['mid'];
		  $result=$con->query($selQry);
		  while($data=$result->fetch_assoc())
		  {
		  ?>
		  <option value="<?php echo $data['category_id'] ?>"><?php echo $data['category_name'] ; ?></option>
          <?php
		  }
		  ?>
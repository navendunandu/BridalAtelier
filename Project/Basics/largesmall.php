<?php
$result='';
if(isset($_POST['btn_largest']))
{
	$num1=$_POST['txt_num1'];
	$num2=$_POST['txt_num2'];
    $num3=$_POST['txt_num3'];
     if($num1>$num2){
	   if($num1>$num3){
		   $result=$num1;
	 }else{
		 $result=$num3;
	 }
}else{
	if($num2>$num3){
	    $result=$num2;}
	
else{		
		$result=$num3;}
}
}
if(isset($_POST['btn_smallest']))
{
	$num1=$_POST['txt_num1'];
	$num2=$_POST['txt_num2'];
    $num3=$_POST['txt_num3'];
     if($num1<$num2){
	   if($num1<$num3){
		   $result=$num1;
	 }else{
		 $result=$num3;
	 }
}else{
	if($num2<$num3){
	    $result=$num2;}
	
else{		
		$result=$num3;}
}
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="479" border="1">
    <tr>
      <td width="73">Number1</td>
      <td width="168"><label for="txt_num1"></label>
      <input type="text" name="txt_num1" id="txt_num1" /></td>
      <td width="73">Number2</td>
      <td width="4"><label for="txt_num2"></label>
      <input type="text" name="txt_num2" id="txt_num2" /></td>
      <td width="33">Number3</td>
      <td width="88"><label for="txt_num3"></label>
      <input type="text" name="txt_num3" id="txt_num3" /></td>
    </tr>
    <tr>
      <td colspan="6"><input type="submit" name="btn_largest" id="btn_largest" value="Largest" />
      <input type="submit" name="btn_smallest" id="btn_smallest" value="Smallest" /></td>
    </tr>
    <tr>
      <td colspan="3">Result</td>
      <td colspan="3"><?php echo $result; ?></td>
    </tr>
  </table>
</form>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>編輯客戶訂貨記錄</title>
<style type="text/css">
  body {
    color: purple;
    background-color: #CCEEFF }
  </style>
</head>
<body>
<?php
$thisid = $_GET["id"];          // 取得URL參數的編號
$action = $_GET["action"];  // 取得操作種類
$db = mysqli_connect("localhost", "root", "momo1125");
mysqli_select_db($db, "customer"); // 選擇customer資料庫
// 執行的操作

switch ($action) {
   case "update": // 更新
	  if (isset($_POST["Yes"])) {  //若按的是確定更新按鈕
		// 取得欄位資料
		$id = $_POST["Id"];
		$orderdate = $_POST["Orderdate"];
		$supposedate = $_POST["Supposedate"];
		$realdate = $_POST["Realdate"];
		$itemname = $_POST["Itemname"];
		$unit = $_POST["Unit"];
		$quantity = $_POST["Quantity"];
		$price = $_POST["Price"];
		$total = $quantity*$price;
		$supplier = $_POST["Supplier"];
		$supnum = $_POST["Supnum"];
		$sql = "UPDATE cus_order SET COid='".$id."',COorderdate='".$orderdate."',COsupposedate='".$supposedate."',COrealdate='".$realdate."',COitemname='".$itemname."',COunit='".$unit."',COquantity='".$quantity."',COprice='".$price."',COtotal='".$total."',COsupplier='".$supplier."',COsupnum='".$supnum."' WHERE COid='".$thisid."'";

		if (!mysqli_query($db, $sql)) { // 執行SQL指令
            $result = "更新失敗...<br/>原因為：" . mysqli_error($db);
		}else header("Location: search_order.php"); // 轉址
	  }
	  else if (isset($_POST["No"])) {
	  header("Location: search_order.php"); // 轉址
      break;
	  }
   case "edit":   // 編輯
      $sql = "SELECT * FROM cus_order WHERE COid='".$thisid."'";
      $rows = mysqli_query($db, $sql); // 執行SQL指令
      $row = mysqli_fetch_array($rows);
      $id = $row["COid"];  // 取得欄位id
	  $orderdate = $row["COorderdate"];
	  $supposedate = $row["COsupposedate"];
	  $realdate = $row["COrealdate"];
	  $itemname = $row["COitemname"];
	  $unit = $row["COunit"];
	  $quantity = $row["COquantity"];
	  $price = $row["COprice"];
	  //$total = $row["COtotal"];
	  $supplier = $row["COsupplier"];
	  $supnum = $row["COsupnum"];
// 顯示編輯表單
?>
<h2>編輯客戶訂貨記錄</h2><hr/>
<form action="edit_order.php?action=update&id=<?php echo $id ?>"
      method="post" enctype="multipart/form-data">
<table border=1>
<tr>
   <td>身分證字號* </td>
   <td><input type="text" name="Id" 
              size="20" maxlength="10" value="<?php echo $id ?>"></td>
</tr>
<tr>
   <td>訂貨日期 </td>
   <td><input type="date" name="Orderdate" 
              size="20" maxlength=10 value="<?php echo $orderdate ?>"></td>
</tr>
<tr>
   <td>預計遞交日期 </td>
   <td><input type="date" name="Supposedate" 
              size="20" maxlength=10 value="<?php echo $supposedate ?>"></td>
</tr>
<tr>
   <td>實際遞交日期 </td>
   <td><input type="date" name="Realdate" 
              size="20" maxlength=10 value="<?php echo $realdate ?>"></td>
</tr>
<tr>
   <td>訂貨品名 </td>
   <td><input type="text" name="Itemname" 
              size="20" maxlength=16 value="<?php echo $itemname ?>"></td>
</tr>
<tr>
   <td>單位 </td>
   <td><input type="text" name="Unit" 
              size="20" maxlength=6 value="<?php echo $unit ?>"></td>
</tr>
<tr>
   <td>數量 </td>
   <td><input type="text" name="Quantity" 
              size="20" maxlength=10 value="<?php echo $quantity ?>"></td>
</tr>
<tr>
   <td>單價 </td>
   <td><input type="text" name="Price" 
			  size="20" maxlength=10 value="<?php echo $price ?>"></td>
</tr>
<tr>
   <td>供應商名稱 </td>
   <td><input type="text" name="Supplier" 
			  size="20" maxlength=16 value="<?php echo $supplier ?>"></td>
</tr>
<tr>
   <td>供應商編號 </td>
   <td><input type="text" name="Supnum" 
			  size="20" maxlength=5 value="<?php echo $supnum ?>"></td>
</tr>
</table><br/>
<div style="color: red">
<?php 
echo $result;
?>
</div>
<br/>
<input type="submit" name="Yes" value="確定儲存">　　
<input type="submit" name="No" value="取消更新">
<br/>
</form><br/>
<?php       
       break;
} 
mysqli_close($db); // 關閉連接 
?>
<a href="index.php">功能首頁</a>
| <a href="add_order.php">新增客戶基本資料</a>
| <a href="search_order.php">搜尋客戶基本資料</a>
</body>
</html>
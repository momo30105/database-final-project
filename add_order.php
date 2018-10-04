<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>新增客戶訂貨記錄</title>
<style type="text/css">
  body {
    color: purple;
    background-color: #CCEEFF }
  </style>
</head>
<body>
<h2>新增客戶訂貨記錄</h2><hr/>

<?php
$result = "";
// 是否是表單送回
if (isset($_POST["Id"]) ) {  //確認Id有值
   // 取得欄位資料
   $id = $_POST["Id"];
   $orderdate = $_POST["Orderdate"];
   $supdate = $_POST["Supdate"];
   $realdate = $_POST["Realdate"];
   $itemname = $_POST["Itemname"];
   $unit = $_POST["Unit"];
   $quantity = $_POST["Quantity"];
   $price = $_POST["Price"];
   
   $suplier = $_POST["Suplier"];
   $supnum = $_POST["Supnum"];
   // 檢查是否有輸入欄位資料
   if ($id != "") {
      $db = mysqli_connect("localhost", "root", "momo1125");
      mysqli_select_db($db, "customer"); // 選擇customer資料庫
      // 建立SQL字串
	  
	  $total = $price*$quantity;
      $sql = "INSERT INTO cus_order (COid,COorderdate,COsupposedate,COrealdate,COitemname,COunit,COquantity,COprice,COtotal,COsupplier,COsupnum) values('".$id."', '".$orderdate."', '".$supdate."', '".$realdate."', '".$itemname."', '".$unit."', '".$quantity."', '".$price."', '".$total."', '".$suplier."', '".$supnum."')";
	  
      if (!mysqli_query($db, $sql)) { // 執行SQL指令
            $result = "新增失敗..<br/>原因為：" . mysqli_error($db);
      }
      else $result = "新增成功！<br/>";
      mysqli_close($db); // 關閉連接      
	  
   }
}
?>
<form action="add_order.php" method="post" >
<table border=1>
<tr>
   <td>身分證字號 </td>
   <td><input type="text" name="Id" 
              size="20" maxlength="10"></td>
</tr>
<tr>
   <td>訂貨日期 </td>
   <td><input type="date" name="Orderdate" 
              size="20" maxlength=10></td>
</tr>
<tr>
   <td>預計遞交日期 </td>
   <td><input type="date" name="Supdate" 
              size="20" maxlength=10></td>
</tr>
<tr>
   <td>實際遞交日期 </td>
   <td><input type="date" name="Realdate" 
              size="20" maxlength=10></td>
</tr>
<tr>
   <td>訂貨品名 </td>
   <td><input type="text" name="Itemname" 
              size="20" maxlength=16></td>
</tr>
<tr>
   <td>單位 </td>
   <td><input type="text" name="Unit" 
              size="20" maxlength=6></td>
</tr>
<tr>
   <td>數量 </td>
   <td><input type="text" name="Quantity" 
              size="20" maxlength=10></td>
</tr>
<tr>
   <td>單價 </td>
   <td><input type="text" name="Price" 
			  size="20" maxlength=10></td>
</tr>
<tr>
   <td>供應商名稱 </td>
   <td><input type="text" name="Suplier" 
			  size="20" maxlength=16></td>
</tr>
<tr>
   <td>供應商編號 </td>
   <td><input type="text" name="Supnum" 
			  size="20" maxlength=5></td>
</tr>
</table><br/>
<input type="submit" value="確定新增">
</form><br/>
<div style="color: red">
<?php 
echo $result;
?>
</div>
<a href="index.php">功能首頁</a>
| <a href="add_order.php">新增客戶訂貨記錄</a>
| <a href="search_order.php">搜尋客戶訂貨記錄</a>
</body>
</html>
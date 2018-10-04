<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>新增公司進貨資料</title>
<style type="text/css">
  body {
    color: purple;
    background-color: #CCEEFF }
  </style>
</head>
<body>
<h2>新增公司進貨資料</h2><hr/>

<?php
$result = "";
// 是否是表單送回
if (isset($_POST["Supname"]) && isset($_POST["Supnum"]) ) {  //確認有值
   $supname = $_POST["Supname"];  // 取得欄位資料
   $supnum = $_POST["Supnum"];
   $supprincipal = $_POST["Supprincipal"];
   $itemname = $_POST["Itemname"];
   $quantity = $_POST["Quantity"];
   $unit = $_POST["Unit"];
   $price = $_POST["Price"];
   $total = $price*$quantity;
   $position = $_POST["Position"];
   $specification = $_POST["Specification"];
   $date = $_POST["Date"];
  
   if ($supname != "" && $supnum != "") { // 檢查是否有輸入欄位資料
      $db = mysqli_connect("localhost", "root", "momo1125");
      mysqli_select_db($db, "customer"); // 選擇customer資料庫
      
	  
	  
      $sql = "INSERT INTO com_input (CIsupname,CIsupnum,CIsupprincipal,CIitemname,CIquantity,CIunit,CIprice,CItotal,CIposition,CIspecification,CIdate) values('".$supname."', '".$supnum."', '".$supprincipal."', '".$itemname."', '".$quantity."', '".$unit."', '".$price."', '".$total."', '".$position."', '".$specification."', '".$date."')";
	  
      if (!mysqli_query($db, $sql)) { // 執行SQL指令
            $result = "新增失敗...<br/>原因為：" . mysqli_error($db);
      }
      else $result = "新增成功！<br/>";
      mysqli_close($db); // 關閉連接      
	  
   }
}
?>
<form action="add_input.php" method="post">
<table border=1>
<tr>
   <td>供應商名稱 </td>
   <td><input type="text" name="Supname" 
              size="20" maxlength="10"></td>
</tr>
<tr>
   <td>供應商編號 </td>
   <td><input type="text" name="Supnum" 
              size="20" maxlength=10></td>
</tr>
<tr>
   <td>供應商負責人 </td>
   <td><input type="text" name="Supprincipal" 
              size="20" maxlength=16></td>
</tr>
<tr>
   <td>進貨品名 </td>
   <td><input type="text" name="Itemname" 
              size="20" maxlength=16></td>
</tr>
<tr>
   <td>進貨數量 </td>
   <td><input type="text" name="Quantity" 
              size="20" maxlength=20></td>
</tr>
<tr>
   <td>進貨單位 </td>
   <td><input type="text" name="Unit" 
              size="20" maxlength=6></td>
</tr>
<tr>
   <td>進貨單價 </td>
   <td><input type="text" name="Price" 
              size="20" maxlength=20></td>
</tr>
<tr>
   <td>庫存位置 </td>
   <td><input type="text" name="Position" size="20" maxlength=16></td>>
</tr>
<tr>
   <td>規格 </td>
   <td><input type="text" name="Specification" 
              size="20" maxlength=16></td>
</tr>
<tr>
   <td>進貨日期 </td>
   <td><input type="date" name="Date" 
              size="20" maxlength=10></td>
</tr>
</table><br/>
<input type="submit" value="新增資料">
</form><br/>
<div style="color: red">
<?php 
echo $result;
?>
</div>
<a href="index.php">功能首頁</a>
| <a href="add_input.php">新增公司進貨資料</a>
| <a href="search_input.php">搜尋公司進貨資料</a>
</body>
</html>
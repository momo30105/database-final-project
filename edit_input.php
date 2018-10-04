<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>編輯公司進貨資料</title>
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
		$supname = $_POST["Supname"];  // 取得欄位name
        $supnum = $_POST["Supnum"]; 
	    $supprincipal = $_POST["Supprincipal"];
	    $itemname = $_POST["Itemname"];
	    $quantity = $_POST["Quantity"];
	    $unit = $_POST["Unit"];
	    $price = $_POST["Price"];
	    $total = $price*$quantity;
	    $position = $_POST["Position"];
	    $specification = $_POST["Specification"];
	    $date = $row["Date"];

		$sql = "UPDATE com_input SET CIsupname='".$supname."',CIsupnum='".$supnum."',CIsupprincipal='".$supprincipal."',CIitemname='".$itemname."',CIquantity='".$quantity."',CIunit='".$unit."',CIprice='".$price."',CItotal='".$total."',CIposition='".$position."',CIspecification='".$specification."',CIdate='".$date."' WHERE CIsupnum='".$thisid."'";
	  		
		if (!mysqli_query($db, $sql)) { // 執行SQL指令
            $result = "更新失敗...<br/>原因為：" . mysqli_error($db);
		}else header("Location: search_input.php"); // 轉址
		
	  }
	  else if (isset($_POST["No"])) {
	  header("Location: search_input.php"); // 轉址
      break;
	  }
   case "edit":   // 編輯
      $sql = "SELECT * FROM com_input WHERE CIsupnum='".$thisid."'";
      $rows = mysqli_query($db, $sql); // 執行SQL指令
      $row = mysqli_fetch_array($rows);
      $supname = $row[CIsupname];  // 取得欄位name
      $supnum = $row["CIsupnum"]; 
	  $supprincipal = $row["CIsupprincipal"];
	  $itemname = $row["CIitemname"];
	  $quantity = $row["CIquantity"];
	  $unit = $row["CIunit"];
	  $price = $row["CIprice"];
	  $total = $row["CItotal"];
	  $position = $row["CIposition"];
	  $specification = $row["CIspecification"];
	  $date = $row["CIdate"];
// 顯示編輯表單
?>
<h2>編輯公司進貨資料</h2><hr/>
<form action="edit_input.php?action=update&id=<?php echo $id ?>"
      method="post" enctype="multipart/form-data">
<table border=1>
<tr>
   <td>供應商名稱 </td>
   <td><input type="text" name="Supname" 
              size="20" maxlength="16" value="<?php echo $supname ?>"></td>
</tr>
<tr>
   <td>供應商編號 </td>
   <td><input type="text" name="Supnum" 
              size="20" maxlength=5 value="<?php echo $supnum ?>"></td>
</tr>
<tr>
   <td>供應商負責人 </td>
   <td><input type="tel" name="Supprincipal" 
              size="20" maxlength=16 value="<?php echo $supprincipal ?>"></td>
</tr>
<tr>
   <td>進貨品名 </td>
   <td><input type="text" name="Itemname" 
              size="20" maxlength=16 value="<?php echo $itemname ?>"></td>
</tr>
<tr>
   <td>進貨數量 </td>
   <td><input type="text" name="Quantity" 
              size="20" maxlength=10 value="<?php echo $quantity ?>"></td>
</tr>
<tr>
   <td>進貨單位 </td>
   <td><input type="text" name="Unit" 
              size="20" maxlength=6 value="<?php echo $unit ?>"></td>
</tr>
<tr>
   <td>進貨單價 </td>
   <td><input type="text" name="Price" 
              size="20" maxlength=10 value="<?php echo $price ?>"></td>
</tr>
<tr>
   <td>庫存位置 </td>
   <td><input type="text" name="Position" 
              size="20" maxlength=16 value="<?php echo $position ?>"></td>
</tr>
<tr>
   <td>規格 </td>
   <td><input type="text" name="Specification" 
              size="20" maxlength=16 value="<?php echo $specification ?>"></td>
</tr>
<tr>
   <td>進貨日期 </td>
   <td><input type="date" name="Date" 
              size="20" maxlength=10 value="<?php echo $date ?>"></td>
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
| <a href="add_input.php">新增公司進貨資料</a>
| <a href="search_input.php">搜尋公司進貨資料</a>
</body>
</html>
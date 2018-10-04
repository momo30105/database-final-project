<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>編輯通訊錄</title>
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
		$name = $_POST["Name"];
		$id = $_POST["Id"];
		$tel = $_POST["Tel"];
		$address = $_POST["Address"];
		$age = $_POST["Age"];
		$job = $_POST["Job"];
		$date = $_POST["Date"];
		$status = $_POST["Status"];
		$sql = "UPDATE cus_data SET Cname='".$name."',Cid='".$id."',Ctele='".$tel."',Caddress='".$address."',Cage='".$age."',Cjob='".$job."',Cdate='".$date."',";
	  
		if (isset($_FILES["Photo"])) {
			if ( copy($_FILES["Photo"]["tmp_name"],   $_FILES["Photo"]["name"])) {
			$sql .= "Cphoto='".$_FILES["Photo"]["name"]."',";
			unlink($_FILES["Photo"]["tmp_name"]);  // 刪除上傳檔案
			}
		}
		$sql .= "Cstatus='".$status."' WHERE Cid='".$thisid."'";
		
		if (!mysqli_query($db, $sql)) { // 執行SQL指令
            $result = "更新失敗...<br/>原因為：" . mysqli_error($db);
		}else header("Location: search.php"); // 轉址serach.php
		
		//mysqli_query($db, $sql); // 執行SQL指令
	  }
	  else if (isset($_POST["No"])) {
	  header("Location: search.php"); // 轉址serach.php 
      break;
	  }
   case "edit":   // 編輯
      $sql = "SELECT * FROM cus_data WHERE Cid='".$thisid."'";
      $rows = mysqli_query($db, $sql); // 執行SQL指令
      $row = mysqli_fetch_array($rows);
      $name = $row[Cname];  // 取得欄位name
      $id = $row["Cid"];  // 取得欄位id
	  $tel = $row["Ctele"];
	  $address = $row["Caddress"];
	  $age = $row["Cage"];
	  $job = $row["Cjob"];
	  $date = $row["Cdate"];
	  $photo = $row["Cphoto"];
	  $status = $row["Cstatus"];
// 顯示編輯表單
?>
<h2>更新通訊錄</h2><hr/>
<form action="edit.php?action=update&id=<?php echo $id ?>"
      method="post" enctype="multipart/form-data">
<table border=1>
<tr>
   <td>客戶姓名 </td>
   <td><input type="text" name="Name" 
              size="20" maxlength="10" value="<?php echo $name ?>"></td>
</tr>
<tr>
   <td>身分證字號* </td>
   <td><input type="text" name="Id" 
              size="20" maxlength=20 value="<?php echo $id ?>"></td>
</tr>
<tr>
   <td>電話 </td>
   <td><input type="tel" name="Tel" 
              size="20" maxlength=20 value="<?php echo $tel ?>"></td>
</tr>
<tr>
   <td>住址 </td>
   <td><input type="text" name="Address" 
              size="20" maxlength=30 value="<?php echo $address ?>"></td>
</tr>
<tr>
   <td>年齡 </td>
   <td><input type="text" name="Age" 
              size="20" maxlength=20 value="<?php echo $age ?>"></td>
</tr>
<tr>
   <td>職業 </td>
   <td><input type="text" name="Job" 
              size="20" maxlength=20 value="<?php echo $job ?>"></td>
</tr>
<tr>
   <td>登載日期 </td>
   <td><input type="date" name="Date" 
              size="20" maxlength=20 value="<?php echo $date ?>"></td>
</tr>
<tr>
   <td>照片 </td>
   <td>
   <?php 
   echo " <img src=' ".$photo."'>";//照片
   echo "<br/>選擇要更新的照片:";
   ?>
   <input type="file" name="Photo"></td>
</tr>
<tr>
   <td>消費狀態 </td>
   <?php 
   if($status=="正常"){
       echo "<td><input type='radio' name='Status' value='正常' checked>正常";
       echo "<input type='radio' name='Status' value='停用' >停用</td>";
   }else{
	   echo "<td><input type='radio' name='Status' value='正常' >正常";
	   echo "<input type='radio' name='Status' value='停用' checked>停用</td>";
   }
   ?>
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
| <a href="add.php">新增客戶基本資料</a>
| <a href="search.php">搜尋客戶基本資料</a>
</body>
</html>
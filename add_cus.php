<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>新增客戶基本資料</title>
<style type="text/css">
  body {
    color: purple;
    background-color: #CCEEFF }
  </style>
</head>
<body>
<h2>新增客戶基本資料</h2><hr/>

<?php
$result = "";
// 是否是表單送回
if (isset($_POST["Name"]) && isset($_POST["Id"]) ) {  //確認哪些有值
   $name = $_POST["Name"];  // 取得欄位資料
   $id = $_POST["Id"];
   $tel = $_POST["Tel"];
   $address = $_POST["Address"];
   $age = $_POST["Age"];
   $job = $_POST["Job"];
   $date = $_POST["Date"];
   //$photo = $_POST["Photo"];
   $status = $_POST["Status"];
   // 檢查是否有輸入欄位資料
   if ($name != "" && $id != "") {
      $db = mysqli_connect("localhost", "root", "momo1125");
      mysqli_select_db($db, "customer"); // 選擇customer資料庫
      // 建立SQL字串
	  
	  
	  if (isset($_FILES["Photo"])) {
	  if ( copy($_FILES["Photo"]["tmp_name"],   $_FILES["Photo"]["name"])) {
      $msg = "檔案上傳成功<br/>";
      unlink($_FILES["Photo"]["tmp_name"]);  // 刪除上傳檔案
      }
      else $msg = "檔案上傳失敗<br/>";
	  }
	  
      $sql = "INSERT INTO cus_data (Cname,Cid,Ctele,Caddress,Cage,Cjob,Cdate,Cphoto,Cstatus) values('".$name."', '".$id."', '".$tel."', '".$address."', '".$age."', '".$job."', '".$date."', '".$_FILES["Photo"]["name"]."', '".$status."')";
	  
      if (!mysqli_query($db, $sql)) { // 執行SQL指令
            $result = "新增失敗...<br/>原因為：" . mysqli_error($db);
      }
      else $result = "新增成功！<br/>";
      mysqli_close($db); // 關閉連接      
	  
   }
}
?>
<form action="add_cus.php" method="post" enctype="multipart/form-data">
<table border=1>
<tr>
   <td>客戶姓名 </td>
   <td><input type="text" name="Name" 
              size="20" maxlength="10"></td>
</tr>
<tr>
   <td>身分證字號 </td>
   <td><input type="text" name="Id" 
              size="20" maxlength=20></td>
</tr>
<tr>
   <td>電話 </td>
   <td><input type="tel" name="Tel" 
              size="20" maxlength=20></td>
</tr>
<tr>
   <td>住址 </td>
   <td><input type="text" name="Address" 
              size="20" maxlength=30></td>
</tr>
<tr>
   <td>年齡 </td>
   <td><input type="text" name="Age" 
              size="20" maxlength=20></td>
</tr>
<tr>
   <td>職業 </td>
   <td><input type="text" name="Job" 
              size="20" maxlength=20></td>
</tr>
<tr>
   <td>登載日期 </td>
   <td><input type="date" name="Date" 
              size="20" maxlength=20></td>
</tr>
<tr>
   <td>照片 </td>
   <td><input type="file" name="Photo"></td>
</tr>
<tr>
   <td>消費狀態 </td>
   <td><input type="radio" name="Status" value="正常">正常
   <input type="radio" name="Status" value="停用">停用</td>
</tr>
</table><br/>
<input type="submit" value="新增資料">
</form><br/>
<div style="color: red">
<?php 
echo $result;
echo $msg;
?>
</div>
<a href="index.php">功能首頁</a>
| <a href="add_cus.php">新增客戶基本資料</a>
| <a href="search_cus.php">搜尋客戶基本資料</a>
</body>
</html>
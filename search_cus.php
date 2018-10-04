<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>搜尋客戶基本資料</title>
<style type="text/css">
  body {
    color: purple;
    background-color: #CCEEFF }
  </style>
</head>
<body>
<h2>搜尋客戶基本資料<br/></h2>
<h3><a href="index.php">功能首頁</a>
| <a href="add_cus.php">新增客戶基本資料</a>
| <a href="search_cus.php">搜尋客戶基本資料</a><h3/><hr/>

<form action="search_cus.php" method="post">
<table border=1>
<tr>
  <td>搜尋姓名: </td>
  <td><input type="text" name="Name" 
             size=10 maxlength=10></td>
</tr>
<tr>
  <td>搜尋身分證字號: </td>
  <td><input type="text" name="Id"
             size="20" maxlength="10"></td>
</tr>
</table><br/>
<input type="submit" name="Search" value="搜尋" >(無輸入時按搜尋為顯示所有資料)
</form><br/>

<?php
if (isset($_POST["Search"])) {  // 如果是表單送回
   $db = mysqli_connect("localhost", "root", "momo1125");
   mysqli_select_db($db, "customer"); // 選擇資料庫
   // 建立基本的SQL字串
   $sql = "SELECT * FROM cus_data ";
   // 檢查是否輸入姓名
   if (chop($_POST["Name"]) != "" )
      $name = "Cname LIKE '%".$_POST["Name"]."%' ";
   else
      $name = "";
   // 檢查是否輸入電話號碼
   if (chop($_POST["Id"]) != "" )
      $id = "Cid LIKE '%".$_POST["Id"]."%' ";
   else
      $id = "";
   // if條件組合SQL字串
   if ( chop($name) != "" && chop($id) != "" )
      $sql.= "WHERE ".$name." AND ".$id;
   elseif ( chop($name) != "" )  // 只有姓名
          $sql .= "WHERE ".$name;
   elseif ( chop($id) != "" )  // 只有電話號碼
          $sql .= "WHERE ".$id;
   $sql.= " ORDER BY Cid";  // 身分證字號排序
   $rows = mysqli_query($db, $sql); // 執行SQL查詢
   $num = mysqli_num_rows($rows);   // 取得記錄數
   
   echo "<table border=1><tr>";
   echo "<td>客戶姓名</td><td>身分證字號</td><td>電話</td><td>住址</td><td>年齡</td><td>職業</td><td>登載日期</td><td>照片</td><td>消費狀態</td></tr>";
   // 表格顯示查詢結果
   if ($num > 0) { // 顯示每一筆記錄
      while ($row = mysqli_fetch_array($rows)) {
         $id = $row["Cid"];
         echo "<tr>";
         echo "<td>" . $row["Cname"] . "</td>";      //名字
		 echo "<td>" . $row["Cid"] . "</td>";		 //身分證
         echo "<td>" . $row["Ctele"] . "</td>";		 //電話
		 echo "<td>" . $row["Caddress"] . "</td>";	 //地址
		 echo "<td>" . $row["Cage"] . "</td>";	 	 //年齡
		 echo "<td>" . $row["Cjob"] . "</td>";	 	 //職業
		 echo "<td>" . $row["Cdate"] . "</td>";	 	 //登載日期
		 
         
		 echo "<td>";
		 echo " <img src=' ".$row["Cphoto"]."' height='150' width='150' >";//照片
		 echo "</td>";
		 
		 
		 echo "<td>" . $row["Cstatus"] . "</td>";	 //消費狀態
		 
		 echo "<td><a href='edit_cus.php?action=edit&id=";
         echo $id . "'><b>修改資料</b>";
       //  echo "<a href='edit.php?action=del&id=";
       //  echo $id . "'><b>刪除</b></td>";
		 
		 
         echo "</tr>";
      }
   }
   echo "</table><hr/>";
   mysqli_free_result($rows);
   mysqli_close($db);               // 關閉伺服器連接
}
?>

<a href="index.php">功能首頁</a>
| <a href="add_cus.php">新增客戶基本資料</a>
| <a href="search_cus.php">搜尋客戶基本資料</a>
</body>
</html>
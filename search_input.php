<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>搜尋公司進貨資料</title>
<style type="text/css">
  body {
    color: purple;
    background-color: #CCEEFF }
  </style>
</head>
<body>
<h2>搜尋公司進貨資料<br/></h2>
<h3><a href="index.php">功能首頁</a>
| <a href="add_input.php">新增公司進貨資料</a>
| <a href="search_input.php">搜尋公司進貨資料</a><h3/><hr/>

<form action="search_input.php" method="post">
<table border=1>
<tr>
  <td>搜尋供應商名稱: </td>
  <td><input type="text" name="Supname" 
             size=10 maxlength=16></td>
</tr>
<tr>
  <td>搜尋供應商編號: </td>
  <td><input type="text" name="Supnum"
             size="20" maxlength="10"></td>
</tr>
</table><br/>
<input type="submit" name="Search" value="搜尋" >
</form><br/>

<?php
if (isset($_POST["Search"])) {  // 如果是表單送回
   $db = mysqli_connect("localhost", "root", "momo1125");
   mysqli_select_db($db, "customer"); // 選擇資料庫
   // 建立基本的SQL字串
   $sql = "SELECT * FROM com_input ";
   // 檢查是否輸入供應商名稱
   if (chop($_POST["Supname"]) != "" )
      $supname = "CIsupname LIKE '%".$_POST["Supname"]."%' ";
   else
      $supname = "";
   // 檢查是否輸入供應商編號
   if (chop($_POST["Supnum"]) != "" )
      $supnum = "CIsupnum LIKE '%".$_POST["Supnum"]."%' ";
   else
      $supnum = "";
   // if條件組合SQL字串
   if ( chop($supname) != "" && chop($supnum) != "" )
      $sql.= "WHERE ".$supname." AND ".$supnum;
   elseif ( chop($supname) != "" )  // 只有供應商名稱
          $sql .= "WHERE ".$supname;
   elseif ( chop($supnum) != "" )  // 只有供應商編號
          $sql .= "WHERE ".$supnum;
   $sql.= " ORDER BY CIsupnum";  // 供應商編號排序
   $rows = mysqli_query($db, $sql); // 執行SQL查詢
   $num = mysqli_num_rows($rows);   // 取得記錄數
   
   echo "<table border=1><tr>";
   echo "<td>供應商名稱</td><td>供應商編號</td><td>供應商負責人</td><td>進貨品名</td><td>進貨數量</td><td>進貨單位</td><td>進貨單價</td><td>小計</td><td>庫存位置</td><td>規格</td><td>進貨日期</td></tr>";
   // 表格顯示查詢結果
   if ($num > 0) { // 顯示每一筆記錄
      while ($row = mysqli_fetch_array($rows)) {
         $id = $row["CIsupnum"];
         echo "<tr>";
         echo "<td>" . $row["CIsupname"] . "</td>";      //名字
		 echo "<td>" . $row["CIsupnum"] . "</td>";		 //身分證
         echo "<td>" . $row["CIsupprincipal"] . "</td>";		 //電話
		 echo "<td>" . $row["CIitemname"] . "</td>";	 //地址
		 echo "<td>" . $row["CIquantity"] . "</td>";	 	 //年齡
		 echo "<td>" . $row["CIunit"] . "</td>";	 	 //職業
		 echo "<td>" . $row["CIprice"] . "</td>";	 	 //登載日期
		 echo "<td>" . $row["CItotal"] . "</td>";	 	 //登載日期
         echo "<td>" . $row["CIposition"] . "</td>";	 	 //登載日期
		 echo "<td>" . $row["CIspecification"] . "</td>";	 	 //登載日期
		 echo "<td>" . $row["CIdate"] . "</td>";	 //消費狀態
		 
		 echo "<td><a href='edit_input.php?action=edit&id=";
         echo $id . "'><b>修改資料</b>";
   	 
		 
         echo "</tr>";
      }
   }
   echo "</table><hr/>";
   mysqli_free_result($rows);
   mysqli_close($db);               // 關閉伺服器連接
}
?>

<a href="index.php">功能首頁</a>
| <a href="add_input.php">新增公司進貨資料</a>
| <a href="search_input.php">搜尋公司進貨資料</a>
</body>
</html>
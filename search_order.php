<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>搜尋客戶訂貨記錄</title>
<style type="text/css">
  body {
    color: purple;
    background-color: #CCEEFF }
  </style>
</head>
<body>
<h2>搜尋客戶訂貨記錄<br/></h2>
<h3><a href="index.php">功能首頁</a>
| <a href="add_order.php">新增客戶訂貨記錄</a>
| <a href="search_order.php">搜尋客戶訂貨記錄</a><h3/><hr/>

<form action="search_order.php" method="post">
<table border=1>
<tr>
  <td>搜尋供應商編號: </td>
  <td><input type="text" name="Supnum" 
             size=10 maxlength=10></td>
</tr>
<tr>
  <td>搜尋身分證字號: </td>
  <td><input type="text" name="Id"
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
   $sql = "SELECT * FROM cus_order ";
   // 檢查是否輸入身分證字號
   if (chop($_POST["Id"]) != "" )
      $id = "COid LIKE '%".$_POST["Id"]."%' ";
   else
      $id = "";
   // 檢查是否輸入編號
   if (chop($_POST["Id"]) != "" )
      $supnum = "COsupnum LIKE '%".$_POST["Supnum"]."%' ";
   else
      $supnum = "";
   // if條件組合SQL字串
   if ( chop($supnum) != "" && chop($id) != "" )
      $sql.= "WHERE ".$supnum." AND ".$id;
   elseif ( chop($id) != "" )  // 只有身分證字號
          $sql .= "WHERE ".$id;
   elseif ( chop($supnum) != "" )  // 只有供應商編號
          $sql .= "WHERE ".$supnum;

   $rows = mysqli_query($db, $sql); // 執行SQL查詢
   $num = mysqli_num_rows($rows);   // 取得記錄數
   
   echo "<table border=1><tr>";
   echo "<td>身分證字號</td><td>訂貨日期</td><td>預計遞交日期</td><td>實際遞交日期</td><td>訂貨品名</td><td>單位</td><td>數量</td><td>單價</td><td>訂貨金額</td><td>供應商名稱</td><td>供應商編號</td></tr>";
   // 表格顯示查詢結果
   if ($num > 0) { // 顯示每一筆記錄
      while ($row = mysqli_fetch_array($rows)) {
         $id = $row["COid"];
         echo "<tr>";
         echo "<td>" . $row["COid"] . "</td>";      //名字
		 echo "<td>" . $row["COorderdate"] . "</td>";		 //身分證
         echo "<td>" . $row["COsupposedate"] . "</td>";		 //電話
		 echo "<td>" . $row["COrealdate"] . "</td>";	 //地址
		 echo "<td>" . $row["COitemname"] . "</td>";	 	 //年齡
		 echo "<td>" . $row["COunit"] . "</td>";	 	 //職業
		 echo "<td>" . $row["COquantity"] . "</td>";	 	 //登載日期
		 echo "<td>" . $row["COprice"] . "</td>";	 	 //登載日期
         echo "<td>" . $row["COtotal"] . "</td>";	 	 //登載日期
		 echo "<td>" . $row["COsupplier"] . "</td>";	 	 //登載日期
		 echo "<td>" . $row["COsupnum"] . "</td>";	 	 //登載日期
		 
		 echo "<td><a href='edit_order.php?action=edit&id=";
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
| <a href="add_order.php">新增客戶訂貨記錄</a>
| <a href="search_order.php">搜尋客戶訂貨記錄</a>
</body>
</html>
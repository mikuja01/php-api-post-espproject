<!DOCTYPE html>
<html>
<head>
  <title>บันทึกการสั่งชานม</title>
  <link rel="icon" href="image/espfavicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://docker.pnru.ac.th/-306010122523014/learning/style.php">

</head>    
<body>
<?php
/* เว็บไซต์แสดงข้อมูลออเดอร์ชานมที่ถูกสั่งทั้งหมดใน database */

$servername = "localhost";

$dbname = "DATABASE_NAME";
$username = "DATABASW_USERNAME";
$password = "DATABASE_PASSWORD";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, menu, sweetness,date_time FROM milk_tea_order_total ORDER BY id DESC";

echo '<table>
      <tr> 
        <th>ลำดับ</th> 
        <th>ชื่อเมนู</th> 
        <th>ความหวาน</th> 
        <th>วัน-เวลา</th> 
     </tr>';
 
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_id = $row["id"];
        $row_menu = $row["menu"];
        $row_sweet = $row["sweetness"];
        $row_time = $row["date_time"];
        
        echo '<tr> 
                <td>' . $row_id . '</td> 
                <td>' . $row_menu . '</td> 
                <td>' . $row_sweet . ' %</td> 
                <td>' . $row_time . '</td> 

            </tr>';
    }
    $result->free();
}

$conn->close();
?> 
</table>
</body>
</html>
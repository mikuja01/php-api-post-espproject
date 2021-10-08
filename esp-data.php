<!DOCTYPE html>
<html>
<head>
  <title>ESP32 Log Files</title>
  <link rel="icon" href="image/espfavicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.php">

</head>    
<body>
<?php

/* เว็บแสดง log อุณหภูมิ และความชื้นทั้งหมด ที่ถูกบันทึกลงใน Database*/

$servername = "localhost";

// REPLACE with your Database name
$dbname = "DATABASE_NAME";
// REPLACE with Database user
$username = "DATABASE_USERNAME";
// REPLACE with Database user password
$password = "DATABASE_PASSWORD";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT count, time, temp, humidity FROM esp_log ORDER BY count DESC";

echo '<table cellspacing="5" cellpadding="5">
      <tr> 
        <th>ลำดับ</th> 
        <th>อุณหภูมิ</th> 
        <th>ความชื้น</th> 
        <th>วัน-เวลา</th> 
 
    </tr>';
 
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_id = $row["count"];
        $row_time = $row["time"];
        $row_temp = $row["temp"];
        $row_humi = $row["humidity"];
              
        echo '<tr> 
                <td>' . $row_id . '</td> 
                <td>' . $row_temp . '</td> 
                <td>' . $row_humi . '</td> 
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
<?php
/* เว็บ api สำหรับบันทึกออเดอร์ชานมจากเครื่องชงชานมอัตโนมัติ
โดยรับ HTTP POST ข้อมูลจาก ESP */

$servername = "localhost";

$dbname = "DATABASE_NAME";
$username = "DATABASE_USERNAME";
$password = "DATABASE_PASSWORD";

$api_key_value = "YOUR_API_KEY";

$api_key= $menu = $sweet = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $menu = test_input($_POST["menu"]);
        $sweet = test_input($_POST["sweet"]);
        
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO milk_tea_order_total (menu, sweetness)
        VALUES ('" . $menu . "', '" . $sweet . "')";

        
        if ($conn->query($sql) === TRUE) {
            echo "New menu created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }
    else {
        echo "Wrong API Key.";
    }

}
else {
    echo "No data posted with HTTP POST. <br>Post HTTP with content type application/x-www-form-urlencoded <br>";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<?php

/* โปรเจคทดลอง รับค่าอุณหภูมิและความชื้นจาก ESP32 บันทึกลง database*/

$servername = "localhost";

// REPLACE with your Database name
$dbname = "DATABASE_NAME";
// REPLACE with Database user
$username = "DATABASE_USERNAME";
// REPLACE with Database user password
$password = "DATABASE_PASSWORD";

// Keep this API Key value to be compatible with the ESP32 code provided in the project page. 
// If you change this value, the ESP32 sketch needs to match
$api_key_value = "YOUR_API_KEY";

$api_key= $temp = $humidity = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $temp = test_input($_POST["temp"]);
        $humidity = test_input($_POST["humidity"]);
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO esp_log (temp, humidity)
        VALUES ('" . $temp . "', '" . $humidity . "')";

        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        /*
        $sql1="DELETE FROM esp_log ORDER BY count ASC LIMIT 1";
        if ($conn->query($sql1) === TRUE) {
            echo "<br> Delete Data successfully";
        } 
        else {
            echo "Delete Error: " . $sql1 . "<br>" . $conn->error;
        }*/

        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
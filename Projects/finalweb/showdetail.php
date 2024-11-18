<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Detail</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');

        body {
            font-family: 'kanit', sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;   
            
        }
        p {
            text-align: center;
        }

        h1 {
            text-align: center;
            color: #004080;
        }
        button {
            font-family: 'kanit', sans-serif;
        }

        .profile-container {
            display: flex;
            justify-content: space-between;
            width: 300%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: center;
        }

        .profile-info,
        .booking-info {
            width: 48%; /* Adjust the width as needed */
        }

        table {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            border-collapse: collapse;
            border: 1px solid #ddd;
            width: 100%;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            font-family: 'kanit', sans-serif;
            background-color: #004080;
            color: #ffffff;
            cursor: pointer;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #00264d;
        }

        a {
            color: #004080;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            width: 100%;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php
session_start();
require 'server.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

echo "<p><a href='home.php'>หน้าหลัก</a></p>";
$cus_user = $_SESSION['cus_user'];

$sql = "SELECT customer.cus_name, customer.cus_tel, customer.cus_email, detailbooking.check_in, detailbooking.check_out, detailbooking.rm_id, detailbooking.status
FROM customer
LEFT JOIN detailbooking ON customer.cus_name = detailbooking.cus_name
WHERE customer.cus_user = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cus_user);
$stmt->execute();
$result = $stmt->get_result();

$previous_cus_name = null; // ใช้เพื่อตรวจสอบว่าข้อมูลถูกแสดงซ้ำหรือไม่

echo "<div class='profile-container'>";
while ($row = $result->fetch_assoc()) {
    if ($row["cus_name"] !== $previous_cus_name) {
        // แสดงข้อมูลส่วนตัว
        echo "<div class='profile-info'>";
        echo "<h1>ข้อมูลส่วนตัว</h1>";
        echo "<p>ชื่อ: " . $row["cus_name"] . "</p>";
        echo "<p>เบอร์โทร: " . $row["cus_tel"] . "</p>";
        echo "<p>อีเมลล์: " . $row["cus_email"] . "</p>";
        echo "<a href='edit_profile.php'>แก้ไขข้อมูลส่วนตัว</a>";
        echo "</div>";
    }
}
    
    ?>

</body>
</html>

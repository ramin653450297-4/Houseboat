<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin-top: 20px;
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
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

$cus_user = $_SESSION['cus_user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_name = $_POST['new_name'];
    $new_tel = $_POST['new_tel'];
    $new_email = $_POST['new_email'];

    $update_sql = "UPDATE customer SET cus_name=?, cus_tel=?, cus_email=? WHERE cus_user=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssss", $new_name, $new_tel, $new_email, $cus_user);
    $update_stmt->execute();

    if ($update_stmt->errno) {
        echo "Error updating data: " . $update_stmt->error;
    } else {
        echo "<p>บันทึกข้อมูลสําเร็จ</p>";
        echo "<p><a href='showdetail.php'>ย้อนกลับไปที่โปรไฟล์</a></p>";
    }

    $update_stmt->close();
}

    // ดึงข้อมูลล่าสุดหลังจากการแก้ไข
    $select_sql = "SELECT * FROM customer WHERE cus_user = ?";
    $select_stmt = $conn->prepare($select_sql);
    $select_stmt->bind_param("s", $cus_user);
    $select_stmt->execute();
    $result = $select_stmt->get_result();

    while ($row = $result->fetch_assoc()) {
    ?>
    <h1>แก้ไขข้อมูลส่วนตัว</h1>
    <form method="post" action="">
        <label for="new_name">ชื่อ: </label>
        <input type="text" name="new_name" value="<?= $row["cus_name"] ?>"><br>

        <label for="new_tel">เบอร์โทร: </label>
        <input type="text" name="new_tel" value="<?= $row["cus_tel"] ?>"><br>

        <label for="new_email">Email: </label>
        <input type="email" name="new_email" value="<?= $row["cus_email"] ?>"><br>

        <input type="submit" value="บันทึกการแก้ไข">
    </form>
<?php
}

$select_stmt->close();
$conn->close();
?>
</body>
</html>

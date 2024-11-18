<!DOCTYPE html>
<html lang="en">
<?php require 'server.php' ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');
        body {
            font-family: 'kanit', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h1 {
            color: #333;
        }

        p {
            margin-bottom: 15px;
        }

        a {
            display: block;
            color: #3498db;
            text-decoration: none;
            margin-top: 15px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <title>Sign-in Result</title>
</head>
<body>
    <div class="container">
        <?php
        $username = $_POST['cus_user'];
        $password = $_POST['cus_pass'];
        $name = $_POST['cus_name'];
        $tel = $_POST['cus_tel'];
        $email = $_POST['cus_email'];
        
        echo "<h1>สวัสดี คุณ, $name</h1>";
        echo "<p>ชื่อผู้ใช้: $username</p>";
        echo "<p>ชื่อ-นามสกุล: $name</p>";
        echo "<p>เบอร์โทร: $tel</p>";
        echo "<p>อีเมลล์: $email</p>";

        $sql = "INSERT INTO customer (cus_user, cus_pass, cus_name, cus_tel, cus_email) 
        VALUES ('$username', '$password', '$name', '$tel', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>สมัครสมาชิกสำเร็จ</p><br>";
        } else {
            echo "<p>สมัครสมาชิกไม่สำเร็จ กรุณาใส่ชื่อผู้ใช้ หรือรหัสผ่าน</p>";
            echo "<a href='form1.php'>สมัครสมาชิก</a>";
        }

        echo "<a href='login.php'>เข้าสู่ระบบ</a>";
        ?>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');
        body {
            font-family: "kanit", sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('https://f.ptcdn.info/798/082/000/s6ileu1o7veHg5fu2yHWc-o.jpg');
            background-size: cover;
            background-position: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #3498db;
            font-family: "kanit", sans-serif;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            font-family: "kanit", sans-serif;
            background-color: #2980b9;
        }

        a {
            display: block;
            text-align: center;
            color: #333;
            text-decoration: none;
        }
    </style>
    <title>สมัครสมาชิก</title>
</head>
<body>
    <form name="form1" action="signinaction.php" method="post">
        <h1>สมัครสมาชิก</h1>
        <div>
            <label for="cus_user">ชื่อผู้ใช้</label>
            <input type="text" name="cus_user" id="cus_user" required>
        </div>
        <div>
            <label for="cus_pass">รหัสผ่าน</label>
            <input type="password" name="cus_pass" id="cus_pass" required>
        </div>
        <div>
            <label for="cus_name">ชื่อ-นามสกุล</label>
            <input type="text" name="cus_name" id="cus_name" required>
        </div>
        <div>
            <label for="cus_tel">เบอร์โทร</label>
            <input type="text" name="cus_tel" id="cus_tel" required>
        </div>
        <div>
            <label for="cus_email">อีเมลล์</label>
            <input type="text" name="cus_email" id="cus_email" required>
        </div>
        <div>
            <input type="submit" value="ลงชื่อเข้าใช้">
        </div>
        <a href="login.php">เข้าสู่ระบบ</a>
    </form>
    
</body>
</html>

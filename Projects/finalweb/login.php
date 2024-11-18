<html>
    <head>
        <link rel="stylesheet" type="text/css" href="stylelogin.css">
    </head>
    <body>
        <form name="form1" action="loginaction.php" method="post">
        <h1>เข้าสู่ระบบ</h1>
            <div>
                ชื่อผู้ใช้ <br><input type="text" name="cus_user" require>
            </div>
            <div>
                รหัสผ่าน <br><input type="password" name="cus_pass" require>
            </div>
            <div>
                <br><input type="submit" value="เข้าสู่ระบบ">
            </div>
            <div>
                <a href="signin.php">สร้างบัญชีผู้ใช้</a>
            </div>
        </form>
    </body>
</html>
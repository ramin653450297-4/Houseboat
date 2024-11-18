<?php require 'server.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<?php
        $username = $_POST['cus_user'];
        $password = $_POST['cus_pass'];
        $name = $_POST['cus_name'];
        $tel = $_POST['cus_tel'];
        $email = $_POST['cus_email'];

        $sql = "INSERT INTO customer (cus_user, cus_pass, cus_name, cus_tel, cus_email) 
                VALUES ('$username', '$password', '$name', '$tel', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo '
            <div class="modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">การแจ้งเตือน</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>สมัครสมาชิกสําเร็จ</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">กลับสู่หน้าหลัก</button>
                        </div>
                    </div>
                </div>
            </div>';
        } else {
            echo "<p>สมัครสมาชิกไม่สำเร็จ กรุณาใส่ชื่อผู้ใช้ หรือรหัสผ่าน</p>";
            echo "<a href='form1.php'>สมัครสมาชิก</a>";
        }
        ?>
</body>
</html>
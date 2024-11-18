<?php
session_start();
require 'server.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['cus_user'];
    $password = $_POST['cus_pass'];

    $sql = $conn->prepare("SELECT * FROM customer WHERE cus_user = ? AND cus_pass = ?");
    $sql->bind_param("ss", $username, $password);
    $sql->execute();

    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        // เก็บข้อมูลผู้ใช้ใน Session
        $_SESSION['cus_user'] = $data['cus_user'];
        $_SESSION['cus_tel'] = $data['cus_tel'];
        $_SESSION['cus_name'] = $data['cus_name'];
        $_SESSION['cus_email'] = $data['cus_email'];
        $_SESSION['logged_in'] = true;

        // ทำสิ่งที่คุณต้องการหลังจาก login เช่น redirect หน้าไปหน้า home.php
        header("Location: home.php");
        exit();
    } else {
        echo "มีบางอย่างผิดพลาด โปรลองอีกครั้ง <br>";
        echo "<a href='login.php'>เข้าสู่ระบบ</a>";
    }

    $sql->close();
    $conn->close();
}
?>


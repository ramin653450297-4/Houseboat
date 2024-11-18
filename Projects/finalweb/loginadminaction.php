<?php
session_start();
require 'server.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['ad_user'];
    $password = $_POST['ad_pass'];

    $sql = $conn->prepare("SELECT * FROM admin WHERE ad_user = ? AND ad_pass = ?");
    $sql->bind_param("ss", $username, $password);
    $sql->execute();

    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        $_SESSION['ad_user'] = $data['ad_user'];
        $_SESSION['ad_tel'] = $data['ad_tel'];
        $_SESSION['ad_name'] = $data['ad_name'];
        $_SESSION['ad_email'] = $data['ad_email'];
        $_SESSION['logged_in'] = true;

        header("Location: adminbooked.php");
        exit();
    } else {
        echo "มีบางอย่างผิดพลาด โปรลองอีกครั้ง <br>";
        echo "<a href='loginadmin.php'>เข้าสู่ระบบ</a>";
    }

    $sql->close();
    $conn->close();
}
?>


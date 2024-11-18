<?php
session_start();
require 'server.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $rm_id = $_POST['rm_id'];
    $rm_des = $_POST['description'];
    $rm_price = $_POST['price'];

    $sql = "UPDATE room SET rm_id='$rm_id', description='$rm_des' , price = '$rm_price' WHERE rm_id = '$rm_id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"] = "แก้ไขข้อมูลสําเร็จ";
        header("Location: allrooms.php");
    } else {
        $_SESSION["error"] = "มีบางอย่างผิดพลาด โปรดลองอีกครั้ง";
        header("Location: allrooms.php");
    }
    $conn->close();
}
?>

<?php
session_start();
require 'server.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $in_name = $_POST['in_name'];
    $in_unit = $_POST['in_unit'];
    $in_price = $_POST['in_price'];

    $sql = "UPDATE ingredients SET in_unit='$in_unit', in_price='$in_price' WHERE in_name='$in_name'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"] = "แก้ไขข้อมูลสําเร็จ";
        header("Location: allingredients.php");
    } else {
        $_SESSION["error"] = "มีบางอย่างผิดพลาด โปรดลองอีกครั้ง";
        header("Location: allingredients.php");
    }
    $conn->close();
}
?>

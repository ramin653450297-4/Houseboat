<?php
session_start();
require 'server.php';

if(isset($_GET['rm_id'])) {
    $rm_id = $_GET['rm_id'];
    
    $sql = "DELETE FROM room WHERE rm_id = '$rm_id'";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"] = "ลบห้องพักสําเร็จ";
        header("Location: allrooms.php");
    } else {
        $_SESSION["error"] = "มีบางอย่างผิดพลาด โปรดลองอีกครั้ง";
        header("Location: allrooms.php");
    }
    $conn->close();
} else {
    echo "ไม่พบ ID ที่ต้องการลบ";
}
?>

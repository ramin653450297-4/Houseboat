<?php
session_start();
require 'server.php';
if(isset($_GET['in_id'])) {
    $in_id = $_GET['in_id'];
    
    $sql = "DELETE FROM ingredients WHERE in_id=$in_id";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"] = "ลบวัตถุดิบสําเร็จ";
        header("Location: allingredients.php");
    } else {
        $_SESSION["error"] = "มีบางอย่างผิดพลาด โปรดลองอีกครั้ง";
        header("Location: allingredients.php");
    }
    $conn->close();
} else {
    echo "ไม่พบ ID ที่ต้องการลบ";
}
?>

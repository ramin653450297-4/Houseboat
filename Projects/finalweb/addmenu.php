<?php
session_start();
require 'server.php';
// เช็คว่าผู้ใช้ล็อกอินอยู่หรือไม่
if(isset($_SESSION['cus_user'])) {
    // echo "ผู้ใช้เข้าสู่ระบบอยู่";
} else {
    echo "ไม่มีผู้ใช้เข้าสู่ระบบ";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบว่ามีข้อมูล check_in และ check_out ที่ส่งมากับคำขอ POST หรือไม่
    if(isset($_POST['check_in']) && isset($_POST['check_out'])) {
        $_SESSION['check_in'] = $_POST['check_in'];
        $_SESSION['check_out'] = $_POST['check_out'];
    }

    // ตรวจสอบว่ามีข้อมูล cus_name และ rm_id ใน session หรือไม่
    // ตรวจสอบว่ามีข้อมูล cus_name และ rm_id ใน session หรือไม่
    if(isset($_GET['cus_name']) && isset($_GET['rm_id'])) {
        $cus_name = $_GET['cus_name'];
        $rm_id = $_GET['rm_id'];
        // ดำเนินการอื่นๆ ที่ต้องการกับข้อมูล cus_name และ rm_id ที่ได้จาก session นี้
    }
}

// ตรวจสอบว่ามีการส่งค่า mn_id และ amount หรือไม่
if(isset($_POST['mn_id']) && isset($_POST['amount'])) {
    $mn_id = $_POST['mn_id'];
    $amount = $_POST['amount'];

    $_SESSION['cart'][] = array(
        'mn_id' => $mn_id,
        'amount' => $amount
    );

    // กำหนดข้อความแจ้งเตือนใน JavaScript
    $message1 = "เมนูถูกเพิ่มเข้าตะกร้าแล้ว";
}

// ตรวจสอบว่ามีการส่งค่า in_id และ amount หรือไม่
if(isset($_POST['in_id']) && isset($_POST['amount'])) {
    $in_id = $_POST['in_id'];
    $amount = $_POST['amount'];

    $_SESSION['cart'][] = array(
        'in_id' => $in_id,
        'amount' => $amount
    );

    // กำหนดข้อความแจ้งเตือนใน JavaScript
    $message2 = "วัตถุดิบถูกเพิ่มเข้าตะกร้าแล้ว";
}

// สร้างสคริปต์ JavaScript เพื่อแสดงข้อความแจ้งเตือน
echo "<script>";
if(isset($message1)) {
    echo "alert('$message1');";
}
if(isset($message2)) {
    echo "alert('$message2');";
}
echo "window.location.href = 'menu.php';";
echo "</script>";
?>

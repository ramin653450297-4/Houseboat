<?php
require 'server.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if ab_id parameter is set
    if (isset($_POST['ab_id'])) {
        $bookingId = $_POST['ab_id'];

        // Update the booking status to "ยืนยันการจอง" in the anonybooking table
        $sql = "UPDATE anonybooking SET status = 'ยืนยันการจอง' WHERE ab_id = $bookingId";

        if (mysqli_query($conn, $sql)) {
            echo "ยืนยันการจองสำเร็จ";
        } else {
            echo "มีข้อผิดพลาดเกิดขึ้น: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } elseif (isset($_POST['db_id'])) {
        $bookingId = $_POST['db_id'];

        // Update the booking status to "ยืนยันการจอง" in the detailbooking table
        $sql = "UPDATE detailbooking SET status = 'ยืนยันการจอง' WHERE db_id = $bookingId";

        if (mysqli_query($conn, $sql)) {
            echo "ยืนยันการจองสำเร็จ";
        } else {
            echo "มีข้อผิดพลาดเกิดขึ้น: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "ไม่พบรหัสการจอง";
    }
} else {
    echo "การเรียกใช้งานไม่ถูกต้อง";
}
?>

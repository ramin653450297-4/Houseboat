<?php
require 'server.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ab_id'])) {
        $bookingId = $_POST['ab_id'];

        $sql = "DELETE FROM anonybooking WHERE ab_id = $bookingId";

        if (mysqli_query($conn, $sql)) {
            echo "ยกเลิกการจองสำเร็จ";
        } else {
            echo "มีข้อผิดพลาดเกิดขึ้น: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } elseif (isset($_POST['db_id'])) {
        $bookingId = $_POST['db_id'];

        $sql = "DELETE FROM detailbooking WHERE db_id = $bookingId";

        if (mysqli_query($conn, $sql)) {
            echo "ยกเลิกการจองสำเร็จ";
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

<?php
session_start();
require 'server.php';

$username = $_SESSION['cus_user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['receive'], $_POST['mn_id'], $_POST['in_id'], $_POST['amount'], $_POST['totalPrice'], $_POST['cus_name'])) {
        $receive = $_POST['receive'];
        $totalPrice = $_POST['totalPrice'];
        $cus_name = $_POST['cus_name'];
        $mn_ids = $_POST['mn_id'];
        $in_ids = $_POST['in_id'];
        $amounts = $_POST['amount'];

            // ตรวจสอบว่ามีข้อมูล check_in และ check_out ที่ส่งมากับคำขอ POST หรือไม่
            if (isset($_POST['check_in']) && isset($_POST['check_out'])) {
                $_SESSION['check_in'] = $_POST['check_in'];
                $_SESSION['check_out'] = $_POST['check_out'];
            }
            
            // ตรวจสอบว่ามีข้อมูลรายการอาหารและวัตถุดิบนั้นมีอยู่ในฐานข้อมูลหรือไม่
            foreach ($mn_ids as $mn_id) {
                $sqlMenu = "SELECT mn_id FROM menu WHERE mn_id = '$mn_id'";
                $resultMenu = mysqli_query($conn, $sqlMenu);
                if (!$resultMenu) {
                    echo "ไม่พบรายการอาหารที่ mn_id = $mn_id";
                    exit();
                }
            }

            foreach ($in_ids as $in_id) {
                $sqlIn = "SELECT in_id FROM ingredients WHERE in_id = '$in_id'";
                $resultIn = mysqli_query($conn, $sqlIn);
                if (!$resultIn) {
                    echo "ไม่พบวัตถุดิบที่ in_id = $in_id";
                    exit();
                }
            }

// ตรวจสอบว่ามีข้อมูลรายละเอียดการจองในฐานข้อมูลหรือไม่
$sql_booking = "SELECT check_in, check_out ,rm_id,cus_name FROM detailbooking WHERE cus_name = '".$_SESSION['cus_name']."'";
$result_booking = mysqli_query($conn, $sql_booking);
$row_booking = mysqli_fetch_assoc($result_booking);
$check_in = $row_booking['check_in'];
$check_out = $row_booking['check_out'];
$rm_id = $row_booking['rm_id'];
$cus_name = $row_booking['cus_name'];

    // เพิ่มข้อมูลลงในฐานข้อมูลหากข้อมูลถูกต้อง
    $sql_insert = "INSERT INTO menubill (rm_id, cus_name, receive, mn_id, in_id, amount, total) VALUES ";
    $valueStrings = array();
    foreach ($mn_ids as $index => $mn_id) {
        $valueStrings[] = "('$rm_id', '$cus_name', '$receive', '$mn_id', '{$in_ids[$index]}', '{$amounts[$index]}', '$totalPrice')";
    }
    $sql_insert .= implode(", ", $valueStrings);
    if (mysqli_query($conn, $sql_insert)) {
        mysqli_close($conn);
        header("Location: home.php");
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูลลงใน menubill: " . mysqli_error($conn);
    }
}
        } else {
            echo "ไม่พบข้อมูล rm_id ใน session";
        }

?>

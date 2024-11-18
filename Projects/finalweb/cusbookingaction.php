<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking customer</title>
</head>
<body>
<?php 
    require 'server.php';
    session_start();

    // ตรวจสอบว่ามีข้อมูลการล็อกอินของลูกค้าอยู่หรือไม่
    if(isset($_SESSION['cus_name']) && isset($_SESSION['cus_email']) && isset($_SESSION['cus_tel'])) {
        // ดึงข้อมูลจาก session
        $cus_name = $_SESSION['cus_name'];
        $cus_email = $_SESSION['cus_email'];
        $cus_tel = $_SESSION['cus_tel'];

        // ตรวจสอบว่ามีข้อมูลที่ส่งมาจาก URL หรือไม่
        if(isset($_GET['check_in']) && isset($_GET['check_out']) && isset($_GET['amount']) && isset($_GET['rm_id'])) {
            $check_in = $_GET['check_in'];
            $check_out = $_GET['check_out'];
            $amount = $_GET['amount'];
            $rm_id = $_GET['rm_id'];
            $add_bed = isset($_GET['add_bed']) ? 1 : 0;

            // Prepare and bind SQL statement
            $stmt = $conn->prepare("INSERT INTO detailbooking (rm_id, check_in, check_out, amount, cus_name, cus_tel, add_bed) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssi", $rm_id, $check_in, $check_out, $amount, $cus_name, $cus_tel, $add_bed);            

            if ($stmt->execute() === TRUE) {
                // สร้าง session ใหม่เกี่ยวกับการจอง
                $_SESSION['booking_success'] = true;
                $_SESSION['rm_id'] = $rm_id;
                $_SESSION['check_in'] = $check_in;
                $_SESSION['check_out'] = $check_out;
            
                // Redirect to payment page
                header('Location: cus_payment.php');
                exit();
            } else {
                echo "เกิดข้อผิดพลาด " . $conn->error;
            }
            

            // Close statement and connection
            $stmt->close();
            $conn->close();
        }
    } else {
        // หากไม่มีข้อมูลการล็อกอินของลูกค้า
        echo "ไม่พบข้อมูลการล็อกอินของลูกค้า";
    }
?>
</body> 
</html>

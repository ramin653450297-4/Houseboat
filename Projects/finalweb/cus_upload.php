<?php
session_start();

$servername = "localhost"; // หรือชื่อโฮสต์ MySQL ของคุณ
$username = "root"; // ชื่อผู้ใช้ MySQL
$password = ""; // รหัสผ่าน MySQL

try {
    $conn = new PDO("mysql:host=$servername;dbname=houseboat", $username, $password);
    // กำหนดโหมด error เป็น Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "เชื่อมต่อสำเร็จ";
} catch(PDOException $e) {
    echo "เกิดข้อผิดพลาด: " . $e->getMessage();
}

if(isset($_SESSION['cus_name']) && !empty($_SESSION['cus_name'])) {
    $cus_name = $_SESSION['cus_name'];

    if (!empty($cus_name)) {
        if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] == 0) {
            $image = $_FILES['receipt']['tmp_name'];
            $imageContent = file_get_contents($image);

            try {
                $stmt_check = $conn->prepare("SELECT * FROM detailbooking WHERE cus_name = :cus_name");
                $stmt_check->bindParam(':cus_name', $cus_name);
                $stmt_check->execute();

                if ($stmt_check->rowCount() > 0) {
                    $stmt_update = $conn->prepare("UPDATE detailbooking SET status = :status, date_pay = NOW(), receipt = :receipt WHERE cus_name = :cus_name");
                    $stmt_update->bindParam(':status', $status);
                    $stmt_update->bindParam(':receipt', $imageContent, PDO::PARAM_LOB);
                    $stmt_update->bindParam(':cus_name', $cus_name);
                    $status = 'รอดำเนินการ'; // กำหนดค่า status
                    $stmt_update->execute();
                    $_SESSION["success"] = "การชำระเงินค่ามัดจำเสร็จสิ้นแล้ว";
                    header("Location: cus_finish.php");
                    exit();
                } else {
                    // ไม่พบข้อมูลที่ตรงกับเงื่อนไขที่กำหนด
                    $_SESSION["error"] = "ไม่พบข้อมูลที่ตรงกับเงื่อนไขที่กำหนด";
                    header("Location: cus_payment.php");
                    exit();
                }

            } catch (PDOException $e) {
                $_SESSION["error"] = "เกิดข้อผิดพลาด: " . $e->getMessage();
                header("Location: cus_payment.php");
                exit();
            }
        } else {
            $_SESSION["error"] = "มีข้อผิดพลาดในการอัปโหลดรูปภาพ";
            header("Location: cus_payment.php");
            exit();
        }
    } else {
        $_SESSION["error"] = "มีบางอย่างไม่ถูกต้อง";
        header("Location: cus_payment.php");
        exit();
    }
} else {
    $_SESSION["error"] = "ไม่พบชื่อผู้เข้าพัก";
    header("Location: cus_payment.php");
    exit();
}
?>

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=houseboat", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "เชื่อมต่อสำเร็จ";
} catch(PDOException $e) {
    echo "เกิดข้อผิดพลาด: " . $e->getMessage();
}

if(isset($_SESSION['am_name']) && !empty($_SESSION['am_name'])) {
    $am_name = $_SESSION['am_name'];

    if (!empty($am_name)) {
        if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] == 0) {
            $image = $_FILES['receipt']['tmp_name'];
            $imageContent = file_get_contents($image);

            try {
                $stmt_check = $conn->prepare("SELECT * FROM anonybooking WHERE am_name = :am_name");
                $stmt_check->bindParam(':am_name', $am_name);
                $stmt_check->execute();

                if ($stmt_check->rowCount() > 0) {
                    $stmt_update = $conn->prepare("UPDATE anonybooking SET status = :status, date_pay = NOW(), receipt = :receipt WHERE am_name = :am_name");
                    $stmt_update->bindParam(':status', $status);
                    $stmt_update->bindParam(':receipt', $imageContent, PDO::PARAM_LOB);
                    $stmt_update->bindParam(':am_name', $am_name);
                    $status = 'รอดำเนินการ';
                    $stmt_update->execute();
                    // $_SESSION["success"] = "การชำระเงินค่ามัดจำเสร็จสิ้นแล้ว";
                    header("Location: anony_finish.php");
                    exit();
                } else {
                    $_SESSION["error"] = "ไม่พบข้อมูลที่ตรงกับเงื่อนไขที่กำหนด";
                    header("Location: payment.php");
                    exit();
                }

            } catch (PDOException $e) {
                $_SESSION["error"] = "เกิดข้อผิดพลาด: " . $e->getMessage();
                header("Location: payment.php");
                exit();
            }
        } else {
            $_SESSION["error"] = "มีข้อผิดพลาดในการอัปโหลดรูปภาพ";
            header("Location: payment.php");
            exit();
        }
    } else {
        $_SESSION["error"] = "มีบางอย่างไม่ถูกต้อง";
        header("Location: payment.php");
        exit();
    }
} else {
    $_SESSION["error"] = "ไม่พบชื่อผู้เข้าพัก";
    header("Location: payment.php");
    exit();
}
?>

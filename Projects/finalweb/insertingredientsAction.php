<?php 
    session_start();
    require "config.php";
    require "server.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $in_name = $_POST['in_name'];
    $in_unit = $_POST['in_unit'];
    $in_price = $_POST['in_price'];

    if(isset($_FILES["in_picture"]) && $_FILES["in_picture"]["error"] == 0) {
        $in_pic = $_FILES["in_picture"]["tmp_name"];
        $in_pic_content = file_get_contents($in_pic);
    } else {
        $_SESSION["error"] = "กรุณาอัพโหลดรูป";
        header("Location: insertingredients.php");
    }

    $sql = "INSERT INTO ingredients (in_id,in_name, in_unit, in_price,in_picture) VALUES (?,?, ?, ?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $in_id, $in_name, $in_unit, $in_price, $in_pic_content);

        if ($stmt->execute()) {
            $_SESSION["success"] = "เพิ่มวัตถุดิบสําเร็จ";
            header("Location: insertingredients.php");
            exit();
        } else {
            $_SESSION["error"] = "มีบางอย่างผิดพลาด ลองอีกครั้ง";
            header("Location: insertingredients.php");
        }

        $stmt->close();
        $conn->close();
    
    }
?>
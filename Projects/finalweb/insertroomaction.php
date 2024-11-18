<?php
    session_start();
    require "config.php";
    require "server.php";
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rm_id = $_POST['rm_id'];
    $tr_id = $_POST['tr_id'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if(isset($_FILES["rm_pic"]) && $_FILES["rm_pic"]["error"] == 0) {
        $rm_pic = $_FILES["rm_pic"]["tmp_name"];
        $rm_pic_content = file_get_contents($rm_pic);
    } else {
        $_SESSION["error"] = "กรุณาอัพโหลดรูป";
            header("Location: insertroom.php");
    }

    $sql = "INSERT INTO room (rm_id, tr_id, description, price, rm_pic) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $rm_id, $tr_id, $description, $price, $rm_pic_content);

    if ($stmt->execute()) {
        $_SESSION["success"] = "เพิ่มห้องสําเร็จ";
        header("Location: insertroom.php");
        exit();
    } else {
        $_SESSION["error"] = "มีบางอย่างผิดพลาด ลองอีกครั้ง";
        header("Location: insertroom.php");
    }
    $stmt->close();
}
$conn->close();

?>

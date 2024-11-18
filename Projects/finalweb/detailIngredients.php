<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดวัตถุดิบ</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');

    body {
        font-family: 'Kanit', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        display: flex;
        align-items: center;
        padding: 0;
       
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow: hidden; /* เพื่อให้ความสูงของคอนเทนเนอร์ได้ถูกต้อง */
    }

    .ingre-info {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 20px;
        background-color: #f9f9f9;
        float: left; /* ทำให้กล่องลอยพื้น */
        width: calc(23.33% - 10px); /* คำนวณความกว้างของกล่องเพื่อให้เรียงกันสามกล่อง */
        margin-right: 20px; /* เพื่อให้กล่องมีระยะห่างทางขวา */
        margin-left: 40px;
    }

    .ingre-info:last-child {
        margin-right: 30; /* ยกเลิกการกำหนดระยะห่างทางขวาสำหรับกล่องลอยพื้นสุดท้าย */
    }

    .ingre-info label {
        font-weight: bold;
    }

    .ingre-info p {
        margin: 8px 0;
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    }
</style>

</head>
<body>
    <?php
    session_start();
    require 'server.php';

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header("Location: loginadmin.php");
        exit();
    }

    $sql = "SELECT * FROM ingredients";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="container">';
        echo '<center><h2>รายละเอียดวัตถุดิบ</h2></center>';


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="ingre-info">';
        echo '<label for="in_id">รหัสวัตถุดิบ:</label>';
        echo '<p>' . $row['in_id'] . '</p>';
        echo '<label for="in_name">ชื่อวัตถุดิบ:</label>';
        echo '<p>' . $row['in_name'] . '</p>';
        echo '<label for="in_unit">จำนวน:</label>';
        echo '<p>' . $row['in_unit'] . '</p>';
        echo '<label for="in_price">ราคา:</label>';
        echo '<p>' . $row['in_price'] . " บาท".'</p>';
        echo '<label for="in_picture">ภาพ:</label>';
        echo '<img src="' . $row['in_picture'] . '.jpg" width="300" height="300" />';

        echo '</div>';
    }
} else {
    echo "ไม่พบข้อมูลห้องพัก";
}
    }
    echo '<a href="adminpage.php" class="back-link">กลับหน้าหลัก</a>';
    $conn->close();
    ?>
</body>
</html>

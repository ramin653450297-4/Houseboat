<?php require 'server.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search rooms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'kanit' , sans-serif;;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="imges/logo/logo.png" alt="logo" width="40"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item me-2">
                <a class="nav-link" href="index.php">หน้าหลัก</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link active" href="rooms.php">ห้องพัก</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link" href="activity.php">กิจกรรม</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link" href="mybooking.php">การจอง</a>
            </li>
        </ul>
        <div class="d-flex">
            <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                สมัคร
            </button>
            <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">
                เข้าสู่ระบบ
            </button>
        </div>
    </div>
    </nav>
    <?php 
        $sql = "SELECT room.rm_id, typeroom.tr_id, typeroom.tr_name, room.description, room.price 
                FROM room 
                INNER JOIN typeroom ON room.tr_id = typeroom.tr_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='container'>";
            echo "<h2 class='me-2 mt-4'>ห้องพักทั้งหมด</h2>";
            $count = 0;
            while($row = $result->fetch_assoc()) {
                if ($count % 3 == 0) {
                    echo "<div class='row row-cols-1 row-cols-md-3 g-4'>";
                }
                echo "<div class='col'>";
                echo "<div class='card h-100'>";
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row["rm_pic"]) . '" alt="Room Picture">';
                echo "<div class='card-body'>";
                echo "<center><h5 class='card-title'>".$row["rm_id"]."</h5>";
                echo "<h5 class='card-title'>".$row["tr_name"]."</h5></center>";
                // echo "<span class='badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base'>";
                // echo "<p class='card-text'>".$row["description"]."</p>";
                // echo "</span>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                $count++;
                if ($count % 3 == 0) {
                    echo "</div>";
                    echo "<br>";
                }
            }
            if ($count % 3 != 0) {
                echo "</div>";
                echo "<br>";
            }
            echo "</div>";
        } else {
            echo "ไม่พบห้องพักที่ว่างตามเงื่อนไขที่ระบุ";
        }
        $conn->close();        
    ?>


</body>
</html>
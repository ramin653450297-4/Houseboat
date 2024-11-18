<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    require 'server.php';
    if(isset($_SESSION['cus_user'])) {
    } else {
        echo "ไม่มีผู้ใช้เข้าสู่ระบบ";
    }
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจอง</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');
        body {
            font-family: 'Kanit', sans-serif;
            margin: 0;
            padding: 0;
            /* background-image: url('https://www.tripgether.com/wp-content/uploads/tripgetter/pae_3-scaled.jpg'); */
            background-size: cover;
            background-position: center;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);
            color: #1a237e;
            font-size: 50px;
        }

        .gallery {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }

        .gallery-item {
            position: relative;
        }

        .gallery img {
            width: 500px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .gallery img:hover {
            transform: scale(1.05);
        }

        .gallery p {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.2);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-align: center;
            font-size: 20px;
            max-width: 90%;
            line-height: 1.2;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        .right-corner {
        position: absolute;
        bottom: -150px;
        right:50px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="home.php"><img src="imges/logo/logo.png" alt="logo" width="40"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item me-2">
                <a class="nav-link" href="home.php">หน้าหลัก</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link" href="roomcus.php">ห้องพัก</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link" href="activitycus.php">กิจกรรม</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link active" href="cusbooking.php">การจอง</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link" href="menu.php">เมนู</a>
            </li>
        </ul>
        <div class="d-flex">
            <a class="navbar-brand" href="showdetail.php"><img src="imges/logo/user.png" alt="logo" width="30"></a>
            <a href="logout.php" class="btn btn-outline-danger shadow-none">ออกจากระบบ</a>
        </div>
    </div>
    </nav>
    <div class="container" style="padding: 20px;">
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="cusbooking.php">จองห้อง</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active"  aria-current="true" href="cusbookingmenu.php">จองอาหาร</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <?php 
            if(isset($_SESSION['cus_user'])) {
                $cus_user = $_SESSION['cus_user'];
                $cus_name = $_SESSION['cus_name'];
                $sql = "SELECT menubill.*, menu.mn_name, ingredients.in_name
                        FROM menubill 
                        INNER JOIN menu ON menubill.mn_id = menu.mn_id 
                        INNER JOIN ingredients ON menubill.in_id = ingredients.in_id 
                        WHERE menubill.cus_name = '$cus_name'";
                
                $result = $conn->query($sql);

                function thaiDate($date) {
                    $thaiMonths = array(
                        "01" => "มกราคม",
                        "02" => "กุมภาพันธ์",
                        "03" => "มีนาคม",
                        "04" => "เมษายน",
                        "05" => "พฤษภาคม",
                        "06" => "มิถุนายน",
                        "07" => "กรกฎาคม",
                        "08" => "สิงหาคม",
                        "09" => "กันยายน",
                        "10" => "ตุลาคม",
                        "11" => "พฤศจิกายน",
                        "12" => "ธันวาคม"
                    );
                
                    $dateParts = explode("-", $date);
                    return $dateParts[2] . " " . $thaiMonths[$dateParts[1]] . " " . ($dateParts[0] + 543);
                }

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>ข้อมูลการจองอาหาร</h5><br>";
                        echo "<p class='card-text'>ชื่อ " . $row["cus_name"] . "</p>";
                        echo "<p class='card-text'>วันที่รับอาหาร " . thaiDate($row["receive"]) . "</p>";
                        echo "<p class='card-text'>เซ็ตหมูกระทะ " . $row["mn_name"] . "</p>";
                        echo "<p class='card-text'>เมนูเพิ่มเติม " . $row["in_name"] . "</p>";
                        echo "<p class='card-text'>ราคารวม " . $row["total"] . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<h4>ไม่มีข้อมูลการจอง</h4>";
                }
                
            } else {
                echo "ไม่มีผู้ใช้เข้าสู่ระบบ";
            }
            ?>
        </div> <!-- Closing card-body div -->
    </div> <!-- Closing card div -->
</div> <!-- Closing container div -->

</body>
</html>
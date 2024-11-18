<?php require 'server.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'kanit' , sans-serif;;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
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
                <a class="nav-link" href="rooms.php">ห้องพัก</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link" href="activity.php">กิจกรรม</a>
            </li>
            <li class="nav-item me-2">
                <a class="nav-link" href="#">การจอง</a>
            </li>
        </ul>
    </div>
    </nav>
    <ul class="nav justify-content-center mt-4">
        <li class="nav-item">
            <a class="nav-link active text-danger" href="#" tabindex="-1" aria-disabled="true">-ข้อมูลส่วนตัว-</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">ชําระเงินค่ามัดจํา</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">เสร็จสิ้น</a>
        </li>
    </ul>
    <div class="row">
    <div class="col-sm-6">
        <div class="card-body">
                <form name="formsearch" action="anonybookingaction.php" method="get">
                <input type="hidden" name="rm_id" value="<?php echo $_GET['rm_id']; ?>">
                <input type="hidden" name="check_in" value="<?php echo $_GET['check_in']; ?>">
                <input type="hidden" name="check_out" value="<?php echo $_GET['check_out']; ?>">
                <input type="hidden" name="amount" value="<?php echo $_GET['amount']; ?>">
            <h2 class="card-title">กรอกข้อมูล</h2>
            <div class="mb-3">
                <label class="form-label">ชื่อ นามสกุล</label>
                <input type="text" class="form-control shadow-none" name="am_name" id='am_name'>
            </div>
            <div class="mb-3">
                <label class="form-label">อิเมล</label>
                <input type="email" class="form-control shadow-none" name="am_email" id='am_email'>
            </div>
            <div class="mb-3">
                <label class="form-label">เบอร์โทร</label>
                <input type="number" class="form-control shadow-none" name="am_tel" id='am_tel'>
            </div>
            <div class="list-group">
                <label class="list-group-item">
                    <input class="form-check-input me-1" type="checkbox" name="add_bed" id='add_bed'>
                    เพิ่มเตียงเสริม +500 บาท
                </label><br>
            </div>
            <div class="text-center my-1">
                <button type="submit" class="btn btn-dark shadow-none">ยืนยันการจอง</button> 
            </div>
        </form>

        </div>
    </div>

    <?php 
        $rm_id = $_GET['rm_id'];
        $check_in = $_GET['check_in'];
        $check_out = $_GET['check_out'];
        $amount = $_GET['amount'];

        $sql = "SELECT * FROM room WHERE rm_id = '$rm_id'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
    ?>

    <div class="col-sm-6">
        <div class="card-body">
            <h2>รายละเอียดการจอง</h2>
            <br>
            <p>หมายเลขห้อง <?php echo $row["rm_id"]; ?></p><br>
            <p>รายละเอียด <?php echo $row["description"]; ?></p><br>

            <?php 
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
            ?>

            <p>เช็คอิน <?php echo thaiDate($check_in); ?></p><br>
            <p>เช็คเอ้าท์ <?php echo thaiDate($check_out); ?></p><br>
            <p>ราคา <?php echo $row["price"]; ?></p>
        </div>
    </div>

    <?php 
            }
        } else {
            echo "ไม่พบข้อมูลห้องพักที่ต้องการ";
        }
        $conn->close();
    ?>

</div>

            
</body>
</html>
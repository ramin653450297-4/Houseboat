<?php require 'server.php'; 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'kanit' , sans-serif;;
        }
        .custom-upload-box {
            border: 2px solid #6c757d;
            border-radius: 8px;
            padding: 10px;
        }

        .custom-upload-box:hover {
            border-color: #343a40;
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
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">ข้อมูลส่วนตัว</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">ชําระเงินค่ามัดจํา</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active text-danger" href="#" tabindex="-1" aria-disabled="true">-เสร็จสิ้น-</a>
        </li>
    </ul>
        <div class="card text-center">
    <!-- <div class="card-header">
        เสร็จสิ้นการจอง
    </div> -->
    <div class="card-body">
        <h5 class="card-title">เสร็จสิ้น</h5>
        <p class="card-text">กรุณารอเจ้าหน้าที่ดําเนินการเช็คใบเสร็จการโอน สามารถเช็คข้อมูลการจองได้ที่หน้าการจอง</p>
        <a href="home.php" class="btn btn-primary">กลับสู่หน้าหลัก</a>
    </div>
    </div>
</body>
</html>
<?php 
require 'server.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>
        *{
            font-family: 'Kanit', sans-serif;
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
                <a class="nav-link  active" href="anonybooking.php">การจอง</a>
            </li>
        </ul>
        <div class="d-flex">
            <a href="login.php" class="btn btn-outline-dark shadow-none me-2">เข้าสู่ระบบ</a>

            <a href="signin.php" class="btn btn-outline-dark shadow-none">สมัครบัญชี</a>
        </div>
    </div>
    </nav>
    <br>
<div class="container">
        <h1>การจอง</h1>
        <form class="search-form" method="GET" action="searchanony.php">
            <label for="search">ค้นหาชื่อ :</label>
            <input type="text" name="search" id="search" />
            <input type="submit" value="ค้นหา" />
        </form><br>
</body>
</html>

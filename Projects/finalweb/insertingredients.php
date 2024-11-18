<?php 
session_start();
require 'server.php';

if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: loginadmin.php"); 
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลวัตถุดิบ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');

        *{
            font-family: 'Kanit', sans-serif;
        }
        body {
        background-color: #fbfbfb;
        }
        @media (min-width: 991.98px) {
        main {
            padding-left: 240px;
            padding-top: 20px;
        }
        }
        .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        padding: 58px 0 0;
        box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
        width: 240px;
        z-index: 600;
        }

        @media (max-width: 991.98px) {
        .sidebar {
            width: 100%;
        }
        }
        .sidebar .active {
        border-radius: 5px;
        box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: 0.5rem;
        overflow-x: hidden;
        overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        }
    body {
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"], select, input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<header>
  <!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white ">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a href="adminbooked.php" class="list-group-item list-group-item-action py-2 ripple ">
        <i class="fa-solid fa-house-user fa-fw me-3"></i><span>ข้อมูลผู้เข้าพัก</span>
        </a>
        <a href="adminmenu.php" class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fa-solid fa-utensils fa-fw me-3"></i><span>ข้อมูลการจองอาหาร</span></a
        >
        <a href="adminuser.php" class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fa-solid fa-users fa-fw me-3"></i><span>ข้อมูลลูกค้า</span></a
        >
        <a href="insertroom.php" class="list-group-item list-group-item-action py-2 ripple">
        <i class="fa-solid fa-bed fa-fw me-3"></i><span>เพิ่มห้องพัก</span>
        </a>
        </ul>
        <a href="insertingredients.php" class="list-group-item list-group-item-action py-2 ripple active"
          ><i class="fa-solid fa-bowl-food fa-fw me-3"></i><span>เพิ่มวัตถุดิบ</span></a
        >
        <ul id="collapseExample1" class="collapse show list-group list-group-flush-item-action py-2 ripple custom-grey">
          <li class="list-group-item py-1">
            <a href="allingredients.php" class="text-reset">วัตถุดิบทั้งหมด</a>
          </li>
      </div>
    </div>
  </nav>
  <!-- Sidebar -->

  <!-- Navbar -->
  <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#sidebarMenu"
        aria-controls="sidebarMenu"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>

      <a class="navbar-brand ms-3" href="#">
        <h2>House boat</h2>
      </a>

      <!-- Right links -->
      <ul class="navbar-nav ms-auto d-flex flex-row">
        <a class="navbar-brand" href="#"><img src="imges/logo/user.png" alt="logo" width="30"></a>
        <a href="logoutad.php" class="btn btn-outline-danger shadow-none">ออกจากระบบ</a>
        </li>
      </ul>
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->
</header>
<main style="margin-top: 58px;">
  <div class="container pt-4 d-block">
  <h2>เพิ่มข้อมูลวัตถุดิบ</h2>
  <?php 
      if(isset($_SESSION['success'])){
      ?>
        <div class="alert alert-success">
          <?php 
            echo $_SESSION['success'];
            unset($_SESSION['success'])
          ?>
        </div>
      <?php } ?>
      <?php 
      if(isset($_SESSION['error'])){
      ?>
        <div class="alert alert-danger">
          <?php 
            echo $_SESSION['error'];
            unset($_SESSION['error'])
          ?>
        </div>
      <?php } ?>
        <form action="insertingredientsAction.php" method="post" enctype="multipart/form-data">

            <label for="in_name">ชื่อวัตถุดิบ:</label>
            <input type="text" id="in_name" name="in_name">

            <label for="in_unit">จำนวน:</label>
            <input type="text" id="in_unit" name="in_unit">

            <label for="in_price">ราคา:</label>
            <input type="text" id="in_price" name="in_price">

            <label for="upload">อัพโหลดรูปภาพ</label>
            <input type="file" class="form-control" name="in_picture">
            <input type="submit" value="บันทึก">
        </form>
  </div>    
</main>
</body>
</html>

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
    <title>ผู้เข้าพัก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <style>
                *{
            font-family: 'Kanit', sans-serif;
        }
        body {
        background-color: #fbfbfb;
        }
        @media (min-width: 991.98px) {
        main {
            padding-left: 240px;
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
        .container{
            padding-left: 180px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #004080;
            color: black;
        }

        .search-form input {
            margin-top: 20px;
            font-family: 'Kanit', sans-serif;
        }

        .cancel-button {
            font-family: 'Kanit', sans-serif;
            background-color: #ff3333;
            color: #fff;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
        button {
        background-color: #004080;
        font-family: 'Kanit', sans-serif;
        color: #fff;
        padding: 5px 10px;
        border: none;
        border-radius: 10px;
        }

        button:hover {
            background-color: #2980b9;
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>
<body>
    <!--Main Navigation-->
<header>
  <!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white ">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a href="adminbooked.php" class="list-group-item list-group-item-action py-2 ripple ">
        <i class="fa-solid fa-house-user fa-fw me-3"></i><span>ข้อมูลผู้เข้าพัก</span>
        </a>
        <a href="adminmenu.php" class="list-group-item list-group-item-action py-2 ripple active"
          ><i class="fa-solid fa-utensils fa-fw me-3"></i><span>ข้อมูลการจองอาหาร</span></a
        >
        <a href="adminuser.php" class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fa-solid fa-users fa-fw me-3"></i><span>ข้อมูลลูกค้า</span></a
        >
        <a href="insertroom.php" class="list-group-item list-group-item-action py-2 ripple">
        <i class="fa-solid fa-bed fa-fw me-3"></i><span>เพิ่มห้องพัก</span>
        </a>
        <a href="insertingredients.php" class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fa-solid fa-bowl-food fa-fw me-3"></i><span>เพิ่มวัตถุดิบ</span></a
        >
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
<!--Main Navigation-->

<!--Main layout-->
<main style="margin-top: 58px;">
  <div class="container pt-4 d-block"></div>
</main>
<!--Main layout-->
    <div class="container">
    <h1>รายการอาหาร</h1>
    <table class="table table-striped">
        <tr>
            <th>ลำดับ</th>
            <th>เมนู</th>
            <th>หมายเลขห้อง</th>
            <th>ชื่อผู้เข้าพัก</th>
            <th>จำนวนรวม</th>
            <th>ราคารวม</th>
        </tr>

        <?php
        $sql = "SELECT menubill.mnbill_id, menu.mn_name, menubill.rm_id, menubill.cus_name, SUM(menubill.amount) AS total_amount, SUM(menubill.total) AS total_price FROM menubill INNER JOIN menu ON menubill.mn_id = menu.mn_id GROUP BY menubill.rm_id";
        $result = mysqli_query($conn, $sql);

        $index = 1;
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?= $index++ ?></td>
                <td><?= $row["mn_name"] ?></td>
                <td><?= $row["rm_id"] ?></td>
                <td><?= $row["cus_name"] ?></td>
                <td><?= $row["total_amount"] ?></td>
                <td><?= $row["total_price"] ?> บาท</td>
            </tr>
            <?php
        }
        mysqli_close($conn);
        ?>
    </table>
    </div>
</body>
</html>

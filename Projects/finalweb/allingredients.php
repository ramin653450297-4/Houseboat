<?php
    session_start();
    require 'server.php';
    
    if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header("Location: login.php"); 
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>วัตถุดิบทั้งหมด</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <style>
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
        .container{
            padding-left: 180px;
        }
        * {
            font-family: 'kanit', sans-serif;
        }
        body {
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<header>
  <!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white ">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <!-- <a
          href="adminpage.php"
          class="list-group-item list-group-item-action py-2 ripple"
          aria-current="true"
        >
          <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>หน้าหลัก</span>
        </a> -->
        <a href="adminbooked.php" class="list-group-item list-group-item-action py-2 ripple">
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
    <?php 
        $sql = "SELECT * FROM ingredients";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='container pt-4 d-block'>";
            echo "<h2 class='me-2 mt-4'>วัตถุดิบทั้งหมด</h2>";
            if(isset($_SESSION['success'])){
              ?>
                <div class="alert alert-success">
                  <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success'])
                  ?>
                </div>
              <?php } 
            if(isset($_SESSION['error'])){
              ?>
                <div class="alert alert-danger">
                  <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error'])
                  ?>
                </div>
              <?php } 
            $count = 0;
            while($row = $result->fetch_assoc()) {
                if ($count % 3 == 0) {
                    echo "<div class='row row-cols-1 row-cols-md-3 g-4'>";
                }
                echo "<div class='col'>";
                echo "<div class='card h-100'>";
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row["in_picture"]) . '" alt="Room Picture">';
                echo "<div class='card-body'>";
                echo "<center><h5 class='card-title'>".$row["in_name"]."</h5>";
                echo "<button type='button' class='btn btn-primary me-2' data-bs-toggle='modal' data-bs-target='#exampleModal".$row["in_id"]."'>
                แก้ไข </button>";
                echo "<a href='deleteIn.php?in_id=".$row["in_id"]."' class='btn btn-danger'>ลบ</a>";
                ?>
                <div class="modal fade" id="exampleModal<?php echo $row["in_id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo $row["in_id"]; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel<?php echo $row["in_id"]; ?>">แก้ไขส่วนผสม</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form action="editIn.php" method="POST">
                              <div class="mb-3">
                                  <label for="in_name" class="form-label">ชื่อวัตถุดิบ</label>
                                  <input type="text" class="form-control" id="in_name" name="in_name" value="<?php echo $row["in_name"]; ?>">
                              </div>
                              <div class="mb-3">
                                  <label for="in_unit" class="form-label">ปริมาณ</label>
                                  <input type="text" class="form-control" id="in_unit" name="in_unit" value="<?php echo $row["in_unit"]; ?>">
                              </div>
                              <div class="mb-3">
                                  <label for="in_price" class="form-label">ราคา</label>
                                  <input type="text" class="form-control" id="in_price" name="in_price" value="<?php echo $row["in_price"]; ?>">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                            </div>
                          </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
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
</main>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>
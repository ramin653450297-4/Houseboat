<?php require 'server.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: row;

        }
        .sidebar {
            width: 200px;
            background-color: #004080;
            color: #fff;
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
}

        .container {
            margin-left: 220px;
            margin-top: 50px;
            flex: 1;
            padding: 20px;
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
            color: #fff;
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
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 200px;
            background-color: #f1f1f1;
        }

        li a {
            display: block;
            color: black; /* เปลี่ยนสีข้อความลิงก์ */
            padding: 10px 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        li a:hover {
                    background-color: #0056b3;
                }
        button {
        background-color: #004080;
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
<div class="sidebar">
<h2>Admin House boat</h2>
<ul>
<li><a href="adminpage.php">ข้อมูลผู้เข้าพัก</a></li>
            <li><a href="adminmenu.php">ข้อมูลการสั่งอาหาร</a></li>
            <li><a href="adminingredients.php">ข้อมูลวัตถุดิบ</a></li>
            <li><a href="insertroom.php">เพิ่มข้อมูลห้อง</a></li>
            <li><a href="insertingredients.php">เพิ่มข้อมูลวัตถุดิบ</a></li>
        </ul>
    </div>

    <div class="container">
    <h1>รายการอาหาร</h1>
    <table class="table table-striped">
        <tr>
            <th>ลำดับ</th>
            <th>วัตถุดิบ</th>
            <th>จำนวน</th>
            <th>ราคา</th>
            <th>สถานะ</th>
            <th></th>
        </tr>

        <?php
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        
        $sql = "SELECT * FROM ingredients WHERE in_status LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);
        
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?= $row["in_id"] ?></td>
                <td><?= $row["in_name"] ?></td>
                <td><?= $row["in_unit"] ?></td>
                <td><?= number_format($row["in_price"], 2) ?></td>
                <td><?= $row["in_status"] ?></td>
                <td><button class="check-button" onclick="checkAvailability(<?= $row['in_id'] ?>)">เช็คสถานะ</button></td>
            </tr>
        <?php
        }
        mysqli_close($conn);
        ?>
    <script>
    function checkAvailability(ingredientId) {
        var confirmation = confirm("สินค้ามีอยู่หรือไม่?");
        if (confirmation) {
            var status = confirmation ? 'มี' : 'ไม่มี';
            // Send an AJAX request to update the status of the ingredient
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_status.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle the response (e.g., display a message)
                    alert(xhr.responseText);
                    // Reload the page or update the table as needed
                    location.reload();
                }
            };
            xhr.send("in_id=" + ingredientId + "&status=" + status);
        }
    }
</script>

    </div>
</body>
</html>

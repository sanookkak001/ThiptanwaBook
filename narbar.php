<?php
session_start();
include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="css/narbar.css">
    <link rel="icon" href="IMG/icon/ico.ico">
    <!-- <link rel="stylesheet" href="css/login.css"> -->
    <script type="text/javascript" src="JS/MESSAGE.js"></script>
    <title>ThiptanwaBook</title>
</head>
<body>
<?php if($_SESSION['member_id']!="" and $_SESSION['member_status']== "1" ){?>	
<header>
    <div class="logo">
        <a href="index.php"><h2>อัลบั้มรูปน้องแอม</h2></a>
        <!-- <img src="IMG/Post/0001-104.jpg"> -->
    </div>
    <input type="checkbox"id="nav_check" hidden>
    <nav>
        <div class="logo">
        <a href="index.php"><h2>อัลบั้มรูปน้องแอม</h2></a>
        </div>
        <ul>
            <li><a href="index.php">หน้าแรก</a></li>
            <li><a href="images.php">รูปภาพ</a></li>
            <li><a href="management.php">จัดการโพสต์</a></li>
            <!-- <li><a id="test-link" href="#">รูปไฟล์</a></li> -->
            <li><a href="#" class="btn-signin" onclick="showAlert()">ล๊อกเอ้า</a></li>
        </ul>
    </nav>
        <label for="nav_check" class="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </label>
</header>
<?php } ?>
<?php if($_SESSION['member_id']!="" and $_SESSION['member_status']== "2" ){?>	
<header>
    <div class="logo">
        <a href="index.php"><h2>อัลบั้มรูปน้องแอม</h2></a>
        <!-- <img src="IMG/Post/0001-104.jpg"> -->
    </div>
    <input type="checkbox"id="nav_check" hidden>
    <nav>
        <div class="logo">
        <a href="index.php"><h2>อัลบั้มรูปน้องแอม</h2></a>
        </div>
        <ul>
            <li><a href="index.php" >หน้าแรก</a></li>
            <li><a href="images.php">รูปภาพ</a></li>
            <!-- <li><a href="management.php">จัดการโพสต์</a></li> -->
            <li><a href="#" class="btn-signin" onclick="showAlert()">ล๊อกเอ้า</a></li>
        </ul>
    </nav>
        <label for="nav_check" class="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </label>
</header>
<?php } ?>
<?php if($_SESSION['member_id'] == "" and $_SESSION['member_status'] == "" ){?>	
<header>
    <div class="logo">
        <a href="index.php"><h2>อัลบั้มรูปน้องแอม</h2></a>
        <!-- <img src="IMG/Post/0001-104.jpg"> -->
    </div>
    <input type="checkbox"id="nav_check" hidden>
    <nav>
        <div class="logo">
        <a href="index.php"><h2>อัลบั้มรูปน้องแอม</h2></a>
        </div>
        <ul>
            <li><a href="index.php" >หน้าแรก</a></li>
            <li><a href="images.php">รูปภาพ</a></li>
            <li><a href="login.php" class="btn-signin" >เข้าสู่ระบบ</a></li>
        </ul>
    </nav>
        <label for="nav_check" class="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </label>
</header>
<?php } ?>

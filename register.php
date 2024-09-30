<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <link rel="icon" href="IMG/icon/ico.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <title>Register</title>
</head>
<body>
    <div class="box center">
        <form method="POST" action="<? echo $_SERVER[SCRIPT_NAME];?>?action=register">
            <div class="logo">
                <h2>สมัครสมาชิก</h2>
            </div>
                <input type="text" id="username" name="member_id" autocomplete ="off" placeholder="บัญชีผู้ใช้งาน">
                <div class="password">
                <input type="password" id="password" name="member_password" autocomplete="off" placeholder="รหัสผ่าน">
                    <i class="fa fa-eye-slash" id="togglePassword"></i>
                <input type="password" id="Comfirmpassword" name="Comfirmpassword" autocomplete ="off" placeholder="ยืนยันรหัสผ่าน">
                <p id="not_match_password"></p>
                </div>
                <input type="text" id="email" name="member_email" autocomplete ="off" placeholder="อีเมล์">
                <p id="Invalid_email"></p>
                <input type="text" id="name" name="member_name" autocomplete ="off" placeholder="ผู้ใช้งาน">
                <p id="error_full"></p>
                <div class="login">
                <input type="submit" value="สมัครสมาชิก">
                </div>
            <div class="regi">
                <p>มีรหัสสมาชิกแล้ว ใช่หรือไม่ ?</p><a href="login.php">หน้าแรก</a>
            </div>
        </form>
    </div>
</body>
<script src="JS/register.js"></script>
</html>
<?php
if ($_REQUEST["action"]=="register")
{
    // รับข้อมูล
    $member_id = $_POST['member_id'];
    $member_name = $_POST['member_name'];
    $member_password = $_POST['member_password'];
    $member_email = $_POST['member_email'];

    // เช๊กข้อมูลซํ้า
    $sql_check = "SELECT * FROM member WHERE member_id = '$member_id'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        // ข้อมูลซํ้า
        ?>
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                รหัสสมาชิกนี้มีอยู่แล้ว
                <script>
                    setTimeout(function () {
                        window.location.href = "register.php";
                    }, 500);
                </script>
        </div>
        
        <?php
    } else {
        // ข้อมูลไม่ซํ้า
        $sql_insert = "INSERT INTO member (member_id, member_name, member_password, member_email, status_id, member_image) VALUES ('$member_id', '$member_name', '$member_password', '$member_email', '3', 'No-img.jpg')";
        $result_insert = mysqli_query($conn, $sql_insert);

        if ($result_insert) {
            // สมัครสำเร็จ
            ?>
            <div class="alert success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                สมัครสมาชิกสำเร็จ
            </div>
            <script>
                setTimeout(function () {
                    window.location.href = "login.php";
                }, 2000);
            </script>
            <?php
        } else {
            // อับข้อมูลไม่สำเร็จ
            ?>
            <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                ล้มเหลวลองใหม่
            </div>
            <script>
                setTimeout(function () {
                    window.location.href = "login.php";
                }, 500);
            </script>
            <?php
        }
    }
}
?>



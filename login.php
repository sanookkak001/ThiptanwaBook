<?php
session_start();
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="IMG/icon/ico.ico">
    <title>Login</title>
</head>
<body>
    <div class="box center">
        <form method="POST" action="<? echo $_SERVER[SCRIPT_NAME];?>?action=login">
            <div class="logo">
                <h2>เว็บไซต์จัดเก็บรูปแอม</h2>
            </div>
                <input type="text" id="username" name="username" autocomplete ="off" placeholder="Username">
                <input type="password" id="password" name="password" placeholder="Password">
                <div class="login">
                <input type="submit" value="ล๊อกอิน">
                </div>
            <div class="regi">
                <p>ยังไม่มีรหัสสมาชิก ใช่หรือไม่ ?</p><a href="register.php">สมัครสมาชิก</a>
            </div>
        </form>
    </div>
</body>
</html>
<?php
  	if ($_REQUEST["action"]=="login")
    {
      $sql = "select * from member";
      $sql.= " where member_id ='$_REQUEST[username]'";
      $sql.= " and member_password ='$_REQUEST[password]'";
      $result = mysqli_query($conn,$sql);
      $num = mysqli_num_rows($result);
      
    if ($num == 1)
      {
      $rs = mysqli_fetch_array($result);
      $_SESSION["member_id"] = $rs["member_id"];
      $_SESSION["member_name"] = $rs["member_name"];
      $_SESSION["member_status"] = $rs["status_id"];
      $_SESSION["member_image"] = $rs["member_image"];
      ?>
        <?php if ($_SESSION['member_status'] == "1" ) {
           ?>
            <div class="alert success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
              ยินดีต้อนรับ คุณ <?php echo  $_SESSION['member_name']; ?> 
            </div>
            <script>setTimeout(function () {
            window.location.href = "index.php"; }, 2000);
            </script>
        <?php } elseif ($_SESSION['member_status'] == "2" ) { ?>
                <div class="alert success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
              ยินดีต้อนรับ คุณ <?php echo  $_SESSION['member_name']; ?> 
            </div>
            <script>setTimeout(function () {
            window.location.href = "index.php"; }, 2000);
            </script>
        <?php } elseif ($_SESSION['member_status'] == "3" ) { ?>
                <div class="alert warning">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                หน่ม ๆ รอยืนยันก่อน
            </div>
            <script>setTimeout(function () {
            window.location.href = "login.php"; }, 2000);
            </script>
        <?php }} else { ?>
            <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                ไม่พบผู้ใช้นี้กรุณาลองอีกครั้ง
            </div>
            <script>setTimeout(function () {
            window.location.href = "login.php"; }, 500);
            </script>
        <?php }} ?>

 <!-- <script>
  function showAlert() {
    var alertDiv = document.createElement("div");
    alertDiv.classList.add("alert");
    alertDiv.innerHTML = "ชื่อผู้ใช้งาน หรือ รหัสผ่าน ผิดโปรดลองใหม่อีกครั้ง";
    document.body.appendChild(alertDiv);

    document.getElementById("closebtn").addEventListener("click", function() {
      alertDiv.parentNode.removeChild(alertDiv);
    });

    setTimeout(function() {
      alertDiv.parentNode.removeChild(alertDiv);
    }, 5000); // 5 seconds
  }
</script> -->

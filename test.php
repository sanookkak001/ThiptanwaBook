<?php
include('config.php');
include('narbar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/test.css">
    <title>Test</title>
</head>
<body>
  <!-- <button id="test">Click</button> -->
  <!-- <div id="Box" class="container">
  <?php
          $sql = "select * from member";
          // $sql.= " inner join  member on (post.member_id = member.member_id)";
          $sql.= " inner join  status on (member.status_id = status.status_id)";
          $sql.= " WHERE member_id = ".$_SESSION['member_id']."";
          $result = mysqli_query($conn,$sql);
          $Result = mysqli_num_rows($result);
          while($row = mysqli_fetch_array($result)) {
  ?> 
    <div  class="box-container">
      <div class="upper">
        <div class="upper-left">
          <img src="IMG/Post/<?php echo $row["member_image"]; ?>" alt="">
        </div>
        <div class="upper-right">
          <p>ชื่อผู้ใช้งาน: <?php echo $row["member_name"]; ?></p>
          <p><?php echo $row["member_email"]; ?></p>
          <p>สถานะ: <?php echo $row["status_name"]; ?></p>
        </div>
      </div>
      <div class="lower">
        <button type="submit">แก้ไขข้อมูล</button>
        <button type="submit" class="btn-signin">ออกจากระบบ</button>
      </div>
    </div>
  <?php 
        }
  ?>
  </div> -->





</body>
<script src="JS/test.js"></script>
</html>
<?php
  $hostname = "localhost";
  $username = "root";
  $password = "12345678";
  $dbname = "thiptanwa";
  $conn = mysqli_connect($hostname,$username,$password,$dbname);
  date_default_timezone_set("Asia/Bangkok");
    mysqli_set_charset($conn,"utf8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ดึงตารางตึงๆ</title>
</head>
<body>
    <?php
    $sql = "select * from post";
    $sql.= " inner join member on (post.member_id = member.member_id)";
    $sql.= " WHERE post_id = '12'";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result)){
      echo $row["post_id"];
      echo $row["post_name"];
      echo $row["post_details"];
      echo $row["time"];
      echo $row["member_name"];
    }
    ?>
</body>
</html>



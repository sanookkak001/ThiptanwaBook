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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="css/narbar.css">
    <title>TestCard</title>
</head>
<body>
<div class="container">
<?php
    $sql = "select * from post";
    $sql.= " inner join  member on (post.member_id = member.member_id)";
    // $sql.= " inner join  current on (news.current_id = current.current_id)";
    $sql.= " WHERE current_id = '1'";
    $x = 1;
    $result = mysqli_query($conn,$sql);
    $Result = mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result)) {
    ?> 
    <div class="gird-container">
        <div class="card box1">
        <?php 
            if (!empty($row["img"]) && file_exists('IMG/Post/'.$row["img"])) { 
                echo '<img src="IMG/Post/'.$row["img"].'">';
            } elseif ($row["img"] == null) {
                echo '<img src="IMG/Post/No-img.jpg">';
            } else { 
                echo '<img src="IMG/Post/No-found-img.jpg">';
            }
            ?>

            <h1><?php echo $row["post_name"];?></h1>
            <div class="content">
                <h2><?php echo $x;?>.<?php echo $row["post_name"];?></h2>
                <p><?php echo $row["post_details"];?></p>
                <a href="details.php?action=edit&post_id=<?php echo $row["post_id"];?>">รายละเอียด</a>
            </div>
        </div>
    </div>
<?php $x++; } ?>
</div>
</div>
</body>
</html>

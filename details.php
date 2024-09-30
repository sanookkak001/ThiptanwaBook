<?php
include('config.php');
include('narbar.php');
?>
<link rel="stylesheet" href="css/detalis.css">
<div class="container">
<?php
    $sql = "select * from post";
    $sql.= " inner join  member on (post.member_id = member.member_id)";
    $sql.= " inner join  current on (post.current_id = current.current_id)";
    $sql.= " WHERE current_name = 'อนุมัติแล้ว' and post_id = '$_REQUEST[post_id]'";
    $x = 1;
    $result = mysqli_query($conn,$sql);
    $Result = mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result)) {
    ?> 
    <!-- style="background-image:url(<?php echo "IMG/Post/".$row["img"]; ?>)" -->
    <div class="box-container">
        <div class="box">
            <!-- <h2>A</h2> -->
            <?php if($row["img"] == null){
                echo '<img id="uploadPreview" src="IMG/Post/No-img.jpg">';
            }else{ ?>
                <img src="<?php echo "IMG/Post/".$row["img"]; ?>">
            <?php } ?>
        </div>
        <div class="text">
            <div class="title-text">
                <h2><?php echo $row["post_name"];?></h2>
            </div>
            <div class="common-text">
                <p><?php echo $row["post_details"];?></p>
            </div>
            <div class="post">
                <h2>โพสต์โดย</h2>
                <p>คุณ <?php echo $row["member_name"];?></p>
            </div>
            <div class="order">
                <h2>อื่นๆ</h2>
                <div class="menu">
                    <p>โพสต์เมื่อ : <?php echo $row["time"];?></p>
                    <p>สถานะ : <?php echo $row["current_name"];?></p>
                </div>
            </div>
        </div>
        <?php $x++; } ?>
    </div>
</div>
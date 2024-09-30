<?php
include("narbar.php")
?>
<link rel="stylesheet" href="css/detalis.css">
<body>

<?php if ($_REQUEST["action"]=="edit") {
    $sql = "select * from post";
    $sql.= " where post_id ='$_REQUEST[post_id]'";
    $result = mysqli_query($conn,$sql) or die ("$sql");
    $rs = mysqli_fetch_array($result);	
 ?>
    <div class="container">
        <div class="table">
            <h5 class="table-header">แก้ไขโพสต์</h5>
            <div class="edit-form">
                <form action="?action=Update" method="post"  enctype="multipart/form-data">
                <input type="hidden" value ="<?php echo $rs["post_id"];?>" name='post_id'>
                <div class="inform">
                    <h4>ชื่อหัวข้อ</h4>
                    <input type="text" placeholder="ชื่อหัวข้อ"  value ="<?php echo $rs["post_name"];?>" name='post_name' autocomplete = "off">
                </div>
                <div class="inform">
                    <h4>รายละเอียด</h4>
                    <input type="text" placeholder="รายละเอียด"  value ="<?php echo $rs["post_details"];?>" name='post_details' autocomplete = "off">
                </div>
                <div class="inform">
                    <label for="uploadImage">อัปโหลดรูป</label>
                    <input type="file" name="img" id="uploadImage" accept=".jpg,.jpeg,.png" onchange="PreviewImage();">
                    <?php if (!empty($rs["img"]) && file_exists('IMG/Post/'.$rs["img"])) { 
                            echo '<img id="uploadPreview" src="IMG/Post/'.$rs["img"].'">';
                         } elseif ($rs["img"] == null) {
                            echo '<img id="uploadPreview"  src="IMG/Post/No-img.jpg">';  
                         }else{ 
                            echo '<img id="uploadPreview" src="IMG/Post/No-found-img.jpg">';
                         }?>
                </div>
                <input type="submit" value="แก้ไขโพสต์">
                </form>
            </div>
        </div>
    </div>
    
<?php } ?>
    <div class="container">
        <div class="table">
            <h5 class="table-header">จัดการโพสต์</h5>
            <div class="table-body">
            <div style="overflow-x: auto;">
                <table>
                <?php
                        $sql = "select * from post";
                        $sql.= " inner join  member on (post.member_id = member.member_id)";
                        $sql.= " inner join  current on (post.current_id = current.current_id)";
                        $x = 1;
                        $result = mysqli_query($conn,$sql);
                        $Result = mysqli_num_rows($result);
                        ?>
                    <thead>
                        <tr>
                            <th>ลำดับที่</th>
                            <th>รูปน้อน</th>
                            <th>ชื่อหัวข้อ</th>
                            <th>รายละเอียด</th>
                            <th>ผู้โพสต์</th>
                            <th>เวลา ณ โพสต์</th>
                            <th>สถานะ</th>
                            <th>การอนุมัติ</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <tr>
                        <?php while($row = mysqli_fetch_array($result)) { ?>
                            <td><?php echo $x;?></td>
                            <td>
                            <?php 
                                if (!empty($row["img"]) && file_exists('IMG/Post/'.$row["img"])) { 
                                    echo '<img src="IMG/Post/'.$row["img"].'">';
                                } elseif ($row["img"] == null) {
                                    echo '<img src="IMG/Post/No-img.jpg">';
                                } else { 
                                    echo '<img src="IMG/Post/No-found-img.jpg">';
                                }


                                ?>

                                    <!-- <img src="<?php echo "IMG/Post/".$row["img"]; ?>"> -->
                            </td>
                            <td>
                            <div class="main-text">
                                <?php echo $row["post_name"];?>
                            </div>
                            <div class="secondary-text">
                                <p>@ttw__ix</p>
                            </div>
                            </td> 
                            <td><?php echo $row["post_details"];?></td>
                            <td><?php echo $row["member_name"];?></td>
                            <td><?php echo $row["time"];?></td>  
                            <td><?php echo $row["current_name"];?></td>  
                            <td>
                                <?php if($row["current_id"] == '1' ){?>	
                                    <a href="?action=edit&post_id=<?php echo $row["post_id"];?>">แก้ไข</a>
                                    <a href="?action=Position&post_id=<?php echo $row["post_id"];?>" onclick="return confirm('ถ้าอนุมัติโพสต์แล้วไม่สามารถยกเลิกได้')">อนุมัติโพสต์</a>
                                    <a href="?action=delete&post_id=<?php echo $row["post_id"];?>" onclick="return confirm('ลบใช่หรือไม่')">ลบโพสต์</a>
                                <?php } ?>
                            </td>
                        </tr>			
                <?php $x++;} ?>
                        </tr>
                    </tbody> 
                </table>  
             </div>
        </div>
    </div>
</body>


<!-- Edit/Position/Delete Zone -->
<?php
if ($_REQUEST["action"] == "Update")	
{
    $target_dir = "IMG/Post/";
    $taget_file = $target_dir.basename($_FILES['img']['name']);
    $uploadOK = 1;

        if(move_uploaded_file($_FILES['img']['tmp_name'],$taget_file))

        {
            $post_id= $_POST['post_id'];
            $post_name= $_POST['post_name'];
            $post_details= $_POST['post_details'];
            $img=$_FILES['img']['name'];

            if($img != null){
        }
                $name = $_FILES['img']['name'];
                $sql = "update post set";
                $sql.= " post_id='$_REQUEST[post_id]', ";
                $sql.= " post_name='$_REQUEST[post_name]', ";
                $sql.= " post_details='$_REQUEST[post_details]', ";
                $sql.= " img='$name' ";
                $sql.= " where post_id='$_REQUEST[post_id]'";
                $result = mysqli_query($conn,$sql);
                if($result){
                    echo"<script>alert('ผ่าน 1')</script>";
                    echo "<script> window.location.href='management.php'</script>";
                }else{
                    echo"<script>alert('ไม่ผ่าน 1')</script>";
                    echo "<script> window.location.href='management.php'</script>";
        }
            }else{

                $post_id= $_POST['post_id'];
                $post_name= $_POST['post_name'];
                $post_details= $_POST['post_details'];

                // $sql = "update news set";
                $sql = "update post set";
                $sql.= " post_id='$_REQUEST[post_id]', ";
                $sql.= " post_name='$_REQUEST[post_name]', ";
                $sql.= " post_details='$_REQUEST[post_details]' ";
                $sql.= " where post_id='$_REQUEST[post_id]'";
                $result = mysqli_query($conn,$sql);
                if($result){
                    echo"<script>alert('ผ่าน 2')</script>";
                    echo "<script> window.location.href='management.php'</script>";
                }else{
                    echo"<script>alert('ไม่ผ่าน 2')</script>";
                    echo "<script> window.location.href='management.php'</script>";

        }
        }
}
?>
<?php
if ($_REQUEST["action"] == "Position")
{
    $sql = "update post set";			
    $sql.= " current_id='1'";				
    $sql.= " where post_id='$_REQUEST[post_id]'";
    mysqli_query($conn,$sql)or die($sql());
    echo "<script language=\"javascript\"> alert(\"อนุมัติให้ละ\"); </script>";	
    echo "<script> window.location.href='management.php'</script>";
}
 ?>
 <?php
if ($_REQUEST["action"] == "delete")	
	{
		$sql = "delete from post";
		$sql.= " where post_id='$_REQUEST[post_id]' ";
		mysqli_query($conn,$sql);
		echo "<script language=\"javascript\"> alert(\"ลบละบายยย\"); </script>";	
        echo "<script> window.location.href='management.php'</script>";
	}
?>

























<!-- DeepLeaning Zone -->

<script type="text/javascript">
   function PreviewImage() {
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
      oFReader.onload = function (oFREvent) {
         document.getElementById("uploadPreview").src = oFREvent.target.result;

         var uploadImage = document.getElementById("uploadImage").value;
         var idxDot = uploadImage.lastIndexOf(".") + 1;
         var extFile = uploadImage.substr(idxDot, uploadImage.length).toLowerCase();
         if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
            // TO DO
         } else {
            alert("รับรองเฉพาะ ไฟล์นามสกุล .jpg .jpeg .png จ๊ะ");
            document.getElementById("uploadImage").value = "";
            document.getElementById("uploadPreview").src = "";
         }
      };
   };
</script>

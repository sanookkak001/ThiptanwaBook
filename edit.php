<?php
session_start();
include('config.php');

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

                    $sql = "update news set";
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
?>

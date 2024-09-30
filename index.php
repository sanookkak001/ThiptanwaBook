<!DOCTYPE html>
<html lang="en">
<head>
    <title>ThiptanwaBook</title>
</head>
<body>
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
    <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="css/narbar.css">
    <script src="js/index.js"></script>
    <title>TestCard</title>
</head>
<body>
<!-- Post Content -->
<div class="container">
    <div class="post-container">
        <div class="post-body">
            <div class="post-body-up">
            <?php
                $sql = "select * from member";
                $sql.= " WHERE member_id = '".$_SESSION['member_id']."'";
                $result = mysqli_query($conn,$sql);
                $Result = mysqli_num_rows($result);
                while($row = mysqli_fetch_array($result)) {
            ?> 
              <a href="#"><img src="<?php echo "IMG/Post/".$row["member_image"]; ?>" alt=""></a>
            <?php } ?>
                <!-- <input type="text" placeholder="คุณกำลังคิดอะไรอยู่..." disabled="disabled"> -->
                <div class="message"  id="myBtn"><p>คุณกำลังคิดอะไรอยู่...</p></div>
            </div>
            <div class="post-body-down">
                <div class="text-common">
                    <div class="inr"><a href="#">เพิ่มรูปน้อน</a></div>
                    <div class="inr"><a href="#">เพิ่มวิดิโอน้อน</a></div>
                    <div class="inr"><a href="#">เพิ่มคลิปน้อน</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--    Main Zone       -->

<?php
    $sql = "select * from post";
    $sql.= " inner join  member on (post.member_id = member.member_id)";
    // $sql.= " inner join  status on (post.status_id = status.status_id)";
    $sql.= " WHERE current_id = '1'";
    $sql.= " ORDER BY post.post_id DESC";
    $x = 1;
    $result = mysqli_query($conn,$sql);
    $Result = mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result)) {
?> 

<div class="container-All" id="post-<?php echo $row['post_id']; ?>">
    <div class="Container-Content">
        <div class="Content-body">
            <div class="header-Main">
              <a href="#"><img src="<?php echo "IMG/Post/".$row["member_image"]; ?>" alt=""></a>
                    <div class="header-left">
                        <a href=""><h4> <?php echo $row['member_name']; ?></h4></a>
                        <h5><time datetime="<?php echo $row["time"];?>"></time></h5>
                    </div>
                    <div class="header-right">
                      <div class="dropdown">
                        <button class="dropdown-button">︙</button>
                            <div class="dropdown-content">
                              <a href="<? echo $_SERVER[SCRIPT_NAME]; ?>?action=Edit&post_id=<?php echo $row["post_id"];?>">แก้ไขโพสต์</a>
                              <a href="<? echo $_SERVER[SCRIPT_NAME]; ?>?action=Delete&post_id=<?php echo $row["post_id"];?>">ลบโพสต์</a>
                            </div>
                      </div>
                    </div>
            </div>
            <div class="Body-main">
                <h3><?php echo $row["post_name"];?></h3>
                <?php if($row["img"] == null){
                        // echo '<div class="image"><img src="IMG/Post/No-img.jpg" alt=""></div>';
                }else{; ?>
                <div class="image">
                        <img src="<?php echo "IMG/Post/".$row["img"]; ?>" alt=""
                            onclick="document.querySelector('.popup-image').style.display = 'block';
                            document.querySelector('.popup-image img').src = this.src;
                            document.querySelector('.popup-image span').onclick = function() {
                            document.querySelector('.popup-image').style.display = 'none';};
                            document.addEventListener('keydown', function(event) {
                            if (event.keyCode === 27) {
                            document.querySelector('.popup-image').style.display = 'none';
                            }});">
                </div>
                    <?php } ?>
            </div>
            <div class="CB">
              <div class="CommentBox showCommentForm">
                <div class="Commenticon">
                  <img src="IMG/icon/Post.png" alt="">
                </div>   
                <span>แสดงความคิดเห็น</span>
              </div>
              <div class="comment-container">
                <form action="?action=Comment" method="post">
                    <div class="comment">
                      <?php
                        if($_SESSION['member_image'] == null){ ?>
                          <a href="#"><img src="IMG/Post/No-img.jpg" alt=""></a>
                      <?php
                        } else { ?>
                          <a href="#"><img src="<?php echo "IMG/Post/".$_SESSION['member_image']; ?>" alt=""></a>
                      <?php
                        }
                       ?>
                      <input type="hidden" name="post_id" value="<?php echo $row["post_id"];?>">
                      <input type="text" name="comment_detalis" placeholder="เขียนความคิดเห็น..." autocomplete="off">
                      <button type="submit">เม้นต์</button>
                    </div>
                </form>
                <?php
                $comments_sql = "SELECT * FROM comment";
                $comments_sql.= " INNER JOIN member ON comment.member_id = member.member_id";
                $comments_sql.= " inner join  status on (member.status_id = status.status_id)";
                $comments_sql.= " WHERE post_id = " . $row['post_id'];
                $comments_sql.= " ORDER BY comment.time DESC";
                $comments_result = mysqli_query($conn, $comments_sql);
                while ($comment_row = mysqli_fetch_assoc($comments_result)) {
                ?>
                  <div class="comment-post">
                    <div class="com-img">
                      <a href="#"><img src="<?php echo "IMG/Post/".$comment_row["member_image"]; ?>" alt=""></a>
                    </div>
                    <div class="com-up">
                      <span><?php echo $comment_row['member_name']; ?></span>
                      <span><?php echo $comment_row['status_name']; ?></span>
                        <div class="com-down">
                          <p><?php echo $comment_row['comment_detalis']; ?> <time datetime="<?php echo $comment_row["time"];?>"></time></p>
                        </div>
                    </div>
                      <div class="com-edit">
                        <div class="com-edit-dropdown">
                          <button class="com-edit-button">︙</button>
                            <div class="dropdown-list">
                                <!-- <a href="<? echo $_SERVER[SCRIPT_NAME]; ?>?action=Editcomment&comment_id=<?php echo $comment_row["comment_id"];?>">แก้ไขเม้นต์</a> -->
                                <a href="<? echo $_SERVER[SCRIPT_NAME]; ?>?action=Deletecomment&comment_id=<?php echo $comment_row["comment_id"];?>">ลบข้อความ</a>
                            </div>
                        </div>
                    </div>
                  </div>
                <?php
                }
                ?>
              </div>
            </div>
        </div>  
    </div>     
</div>
<?php } ?>
</body>
</html>

<!-- BackEnd -->

<?php
if ($_REQUEST["action"] == "Deletecomment")	
	{
		$sql = "delete from comment";
		$sql.= " where comment_id='$_REQUEST[comment_id]' ";
		$result = mysqli_query($conn,$sql);
    if($result){
      // echo"<script>alert('insert success !!!')</script>";
      // echo "<script> window.location.href='test.php'</script>";
      // echo "<script> window.history.back(); </script>";
      echo "<script> window.location.href = document.referrer + '#post-" . $post_id . "'; </script>";
  }else{

      // echo"<script>alert('Error something like that !!!')</script>";
      echo "<script> window.location.href='test.php'</script>";
      exit();
  }
}
  ?>

<?php
if ($_REQUEST["action"] == "Comment")
{

            $comment_detalis= $_POST['comment_detalis'];
            $post_id= $_POST['post_id'];
            $member_id= $_SESSION['member_id'];
            $sql = "insert into comment(comment_detalis,post_id,member_id)";
            $sql.= " VALUES('$comment_detalis','$post_id','$member_id')";
            $result = mysqli_query($conn,$sql);
            if($result){
                // echo"<script>alert('insert success !!!')</script>";
                // echo "<script> window.location.href='test.php'</script>";
                // echo "<script> window.history.back(); </script>";
                echo "<script> window.location.href = document.referrer + '#post-" . $post_id . "'; </script>";
            }else{

                // echo"<script>alert('Error something like that !!!')</script>";
                echo "<script> window.location.href='test.php'</script>";
                exit();
        }
}
?>

<?php
if ($_REQUEST["action"] == "Add")
{

    $target_dir = "IMG/Post/";
    $taget_file = $target_dir.basename($_FILES['img']['name']);
    $uploadOK = 1;

        if(move_uploaded_file($_FILES['img']['tmp_name'],$taget_file))

           {
            if($_SESSION['member_status'] == '1'){
                $current_id = '1';
            }else{
                $current_id = '2';
            };

            $post_name= $_POST['post_name'];
            // $news_details= $_POST['news_details'];
            $img=$_FILES['img']['name'];
            $member_id= $_SESSION['member_id'];

           if($img != null){

           }

            $sql = "insert into post(post_name,member_id,img,current_id)";
            $sql.= " VALUES('$post_name','$member_id','$img','$current_id')";
            $result = mysqli_query($conn,$sql);
            if($result){
                // echo"<script>alert('insert success !!!')</script>";
                echo "<script> window.location.href='index.php'</script>";
            }else{

                // echo"<script>alert('Error something like that !!!')</script>";
                echo "<script> window.location.href='index.php'</script>";
        }
            }else{

            if($_SESSION['member_status'] == '1'){
                $current_id = '1';
            }else{
                $current_id = '2';
            };

            $post_name= $_POST['post_name'];
            // $news_details= $_POST['news_details'];
            // $img=$_FILES['img']['name'];
            $member_id= $_SESSION['member_id'];

            $sql = "insert into post(post_name,member_id,current_id)";
            $sql.= " VALUES('$post_name','$member_id','$current_id')";
            $result = mysqli_query($conn,$sql);
            if($result){
                // echo"<script>alert('insert success !!!')</script>";
                echo "<script> window.location.href='index.php'</script>";
            }else{

                // echo"<script>alert('Error something like that !!!')</script>";
                echo "<script> window.location.href='index.php'</script>";
        }
        }
}
?>

 <?php
if ($_REQUEST["action"] == "Delete")	
	{
		$sql = "delete from post";
		$sql.= " where post_id='$_REQUEST[post_id]' ";
		mysqli_query($conn,$sql);
  ?>
  <div class="alert success">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        ลบสำเร็จ
  </div>
      <script>setTimeout(function () {
      window.location.href = "index.php";},500);
  </script>
<?php } ?>
<!-- The Modal -->

<div id="myModal" class="modal">
<?php
    $sql = "select * from member";
    $sql.= " inner join  status on (member.status_id = status.status_id)";
    $sql.= " WHERE member_id = '".$_SESSION['member_id']."'";
    $result = mysqli_query($conn,$sql);
    $Result = mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result)) {
?> 

<!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>โพสต์รูปน้อน</h2>
    </div>
    <div class="modal-body">
        <div class="logo-img">
          <a href="#"><img src="<?php echo "IMG/Post/".$row["member_image"]; ?>" alt=""></a>
            <div class="status">
                <h4><?php echo $row['member_name']; ?></h4>
                <h5><?php echo $row["status_name"]; ?></h5>
            </div>
        </div>
        <form action="<? echo $_SERVER[SCRIPT_NAME]; ?>?action=Add" method="post"  enctype="multipart/form-data">
        <textarea type="text" id="text"  name='post_name' placeholder="คุณกำลังคิดอะไร  <?php echo $row['member_name']; ?>"></textarea>
       
        <div class="image-upload">
            <span id="close-upload">&times;</span>
            <label for="post-image">เพิ่มรูปภาพ</label>
            <input type="file" id="post-image" name="img" accept="image/*" onchange="PreviewImage();">
            <img id="preview-image" src="">
        </div>
        
        <div class="order">
            <p>เพิ่มในโพสต์ของคุณ</p>
            <div class="order-img">
                <img id="add-image" src="IMG/icon/Addicon.png" alt="">
                <img src="IMG/icon/Camera.png" alt="">
                <img src="IMG/Post/0001-104.jpg" alt="">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        
    <button id="BTS" class="button" disabled style="background-color: rgba(128, 128, 128, 0.9); cursor: no-drop;">โพสต์</button>
    </div>
    </form>
  </div>
  <?php  } ?>
</div>

<!-- Modal Img -->

<div class="popup-image">
    <span>&times;</span>
    <div class="pop">
      <img src="IMG/Post/0001-104.jpg" alt="">
    </div>
</div>


<!-- Deep Code Zone -->

<!-- Time Zone -->


<script>
function timeToWords(time, lang) {
  lang = lang || {
    postfixes: {
      '<': ' ที่แล้ว ',
      '>': ' จากนี้'
    },
    1000: {
      singular: 'เมื่อสักครู่',
      plural: '# วิ '
    },
    2000: {
      singular: '2 วิ ',
      plural: '# วิ '
    },
    3000: {
      singular: '3 วิ ',
      plural: '# วิ '
    },
    4000: {
      singular: '4 วิ ',
      plural: '# วิ '
    },
    5000: {
      singular: '5 วิ ',
      plural: '# วิ '
    },
    6000: {
      singular: '6 วิ ',
      plural: '# วิ '
    },
    7000: {
      singular: '7 วิ ',
      plural: '# วิ '
    },
    8000: {
      singular: '8 วิ ',
      plural: '# วิ '
    },
    9000: {
      singular: '9 วิ ',
      plural: '# วิ '
    },
    10000: {
      singular: '10 วิ ',
      plural: '# วิ '
    },
    11000: {
      singular: '11 วิ ',
      plural: '# วิ '
    },
    12000: {
      singular: '12 วิ ',
      plural: '# วิ '
    },
    13000: {
      singular: '13 วิ ',
      plural: '# วิ '
    },
    14000: {
      singular: '14 วิ ',
      plural: '# วิ '
    },
    15000: {
      singular: '15 วิ ',
      plural: '# วิ '
    },
    16000: {
      singular: '16 วิ ',
      plural: '# วิ '
    },
    17000: {
      singular: '17 วิ ',
      plural: '# วิ '
    },
    18000: {
      singular: '18 วิ ',
      plural: '# วิ '
    },
    19000: {
      singular: '19 วิ ',
      plural: '# วิ '
    },
    20000: {
      singular: '20 วิ ',
      plural: '# วิ '
    },
    21000: {
      singular: '21 วิ ',
      plural: '# วิ '
    },
    22000: {
      singular: '22 วิ ',
      plural: '# วิ '
    },
    23000: {
      singular: '23 วิ ',
      plural: '# วิ '
    },
    24000: {
      singular: '24 วิ ',
      plural: '# วิ '
    },
    25000: {
      singular: '25 วิ ',
      plural: '# วิ '
    },
    26000: {
      singular: '26 วิ ',
      plural: '# วิ '
    },
    27000: {
      singular: '27 วิ ',
      plural: '# วิ '
    },
    28000: {
      singular: '28 วิ ',
      plural: '# วิ '
    },
    29000: {
      singular: '29 วิ ',
      plural: '# วิ '
    },
    30000: {
      singular: '30 วิ ',
      plural: '# วิ '
    },
    31000: {
      singular: '31 วิ ',
      plural: '# วิ '
    },
    32000: {
      singular: '32 วิ ',
      plural: '# วิ '
    },
    33000: {
      singular: '33 วิ ',
      plural: '# วิ '
    },
    34000: {
      singular: '34 วิ ',
      plural: '# วิ '
    },
    35000: {
      singular: '35 วิ ',
      plural: '# วิ '
    },
    36000: {
      singular: '36 วิ ',
      plural: '# วิ '
    },
    37000: {
      singular: '37 วิ ',
      plural: '# วิ '
    },
    38000: {
      singular: '38 วิ ',
      plural: '# วิ '
    },
    39000: {
      singular: '39 วิ ',
      plural: '# วิ '
    },
    40000: {
      singular: '40 วิ ',
      plural: '# วิ '
    },
    41000: {
    singular: '41 วิ ',
    plural: '# วิ '
    },
    42000: {
      singular: '42 วิ ',
      plural: '# วิ '
    },
    43000: {
      singular: '43 วิ ',
      plural: '# วิ '
    },
    44000: {
      singular: '44 วิ ',
      plural: '# วิ '
    },
    45000: {
      singular: '45 วิ ',
      plural: '# วิ '
    },
    46000: {
      singular: '46 วิ ',
      plural: '# วิ '
    },
    47000: {
      singular: '47 วิ ',
      plural: '# วิ '
    },
    48000: {
      singular: '48 วิ ',
      plural: '# วิ '
    },
    49000: {
      singular: '49 วิ ',
      plural: '# วิ '
    },
    50000: {
      singular: '50 วิ ',
      plural: '# วิ '
    },
    51000: {
    singular: '51 วิ ',
    plural: '# วิ '
    },
    52000: {
    singular: '52 วิ ',
    plural: '# วิ '
    },
    53000: {
    singular: '53 วิ ',
    plural: '# วิ '
    },
    54000: {
    singular: '54 วิ ',
    plural: '# วิ '
    },
    55000: {
    singular: '55 วิ ',
    plural: '# วิ '
    },
    56000: {
    singular: '56 วิ ',
    plural: '# วิ '
    },
    57000: {
    singular: '57 วิ ',
    plural: '# วิ '
    },
    58000: {
    singular: '58 วิ ',
    plural: '# วิ '
    },
    59000: {
    singular: '59 วิ ',
    plural: '# วิ '
    },
    60000: {
      singular: '1 นาที ',
      plural: '# นาที '
    },
    3600000: {
      singular: '1 ชม.',
      plural: '# ชม.'
    },
    86400000: {
      singular: '1 วัน',
      plural: '# วัน'
    },
    31540000000: {
      singular: '1ปีที่แล้ว',
      plural: '# ปี'
    }
  };

  var timespans = [1000, 2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000, 11000, 12000, 13000, 14000, 15000, 16000, 17000, 18000, 19000, 20000, 21000, 22000, 23000, 24000, 25000, 26000, 27000, 28000, 29000, 30000, 31000, 32000, 33000, 34000, 35000, 36000, 37000, 38000, 39000, 40000, 41000, 42000, 43000, 44000, 45000, 46000, 47000, 48000, 49000, 50000, 51000, 52000, 53000, 54000, 55000, 56000, 57000, 58000, 59000, 60000, 3600000, 86400000 ,31540000000];
  var parsedTime = Date.parse(time.replace(/\-00:?00$/, ''));

  if (parsedTime && Date.now) {
    var timeAgo = parsedTime - Date.now();
    var diff = Math.abs(timeAgo);
    var postfix = lang.postfixes[(timeAgo < 0) ? '<' : '>'];
    var timespan = timespans[0];

    for (var i = 1; i < timespans.length; i++) {
      if (diff > timespans[i]) {
        timespan = timespans[i];
      }
    }

    var n = Math.round(diff / timespan);

    return lang[timespan][n > 1 ? 'plural' : 'singular']
      .replace('#', n) + postfix;
  }
}
document.addEventListener('DOMContentLoaded', function() {
  var elements = document.getElementsByTagName('time');
  for (var i = 0; i < elements.length; i++) {
    var time = elements[i];
    // The date should be either in the datetime attribute
    // or in the text contents if no datetime attribute
    var date = time.getAttribute('datetime') || time.textContent;
    var lang = time.className === 'norsk' ? norwegian : null;

    var dateInWords = timeToWords(date, lang);
    if (dateInWords) {
      time.textContent = dateInWords;
    }
  }
});
function updateTime() {
  var elements = document.getElementsByTagName('time');
  for (var i = 0; i < elements.length; i++) {
    var time = elements[i];
    var date = time.getAttribute('datetime') || time.textContent;
    var lang = time.className === 'norsk' ? norwegian : null;
    var dateInWords = timeToWords(date, lang);
    if (dateInWords) {
      time.textContent = dateInWords;
    }
  }
}

// Update time every minute (1000ms == 1s )
setInterval(updateTime, 1000);

// Call the function once to update the time on page load
updateTime();

</script>

<!-- ย่อ Textarea -->

<script>
// Get the close button and the image-upload modal
const imageUploadModal = document.querySelector('.image-upload');
// Add a click event listener to the Add Image button
const addImageButton = document.getElementById('add-image');
addImageButton.addEventListener('click', function() {
  // Show the image-upload modal
  imageUploadModal.style.display = 'block';
});

const imageUpload = document.getElementById("add-image");
const resizeMe = document.getElementById("text");
imageUpload.addEventListener("click", function() {
  resizeMe.style.height = "70px"; // Set the desired height of the element in pixels
});

</script>

<!-- โหลดรูปตัวอย่าง ปรับ/ลด ขนาด Textarea JS Check button Add/Edit IMG -->

<script>
const input = document.getElementById('post-image');
const preview = document.getElementById('preview-image');
const labelElement = document.querySelector('.image-upload label');

// Add an event listener to the file input
input.addEventListener('change', () => {
  const file = input.files[0];
  if (file) {
    const reader = new FileReader();
    reader.addEventListener('load', () => {
      preview.setAttribute('src', reader.result);
    });
    reader.readAsDataURL(file);
    // Hide the label
    labelElement.style.display = 'none';
  } else {
    // Show the label
    labelElement.style.display = 'flex';
  }
});

document.addEventListener('DOMContentLoaded', () => {
  const closeUploadBtn = document.getElementById('close-upload');
  const imageUploadDiv = document.querySelector('.image-upload');
  const fileInput = document.getElementById('post-image');
  const textarea = document.getElementById('text');

  closeUploadBtn.addEventListener('click', () => {
    fileInput.value = '';
    imageUploadDiv.style.display = 'none';
    textarea.style.height = '150px';
    preview.src = '';
    // Show the label
    labelElement.style.display = 'flex';
    // labelElement.style.position = 'absolute';
    // labelElement.style.top = '0';
    // labelElement.style.left = '0';
    // labelElement.style.width = '100%';
    // labelElement.style.height = '100%';
    // labelElement.style.cursor = 'pointer';
    // labelElement.style.justifyContent = 'center';
    // labelElement.style.alignItems = 'center';
    // labelElement.style.fontSize = '24px';
    // labelElement.style.fontWeight = '600';
  });
});
</script>

<!-- ตรวจรูป JPG JPEG PNG -->

<script type="text/javascript">
function PreviewImage() {
    var fileInput = document.getElementById("post-image");
    var previewImage = document.getElementById("preview-image");

    // Check file extension
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if (!allowedExtensions.exec(fileInput.value)) {
        alert("รับรองเฉพาะ ไฟล์นามสกุล .jpg .jpeg .png จ๊ะ");
        fileInput.value = "";
        previewImage.src = "";
        return;
    }
  };
 </script>

<!-- เมนูล่าง โพสต์ -->

 <script>

// Get the link elements
const addImageLink = document.querySelectorAll('.text-common .inr a')[0];
const addVideoLink = document.querySelectorAll('.text-common .inr a')[1];
const addClipLink = document.querySelectorAll('.text-common .inr a')[2];

// Get the modal element and the image-upload div
const modal = document.querySelector('.modal');
const imageUploadDiv = document.querySelector('.image-upload');

// Add event listeners to the link elements
addImageLink.addEventListener('click', () => {
  // Show the modal
  modal.style.display = 'block';
  // Show the image-upload div
  imageUploadDiv.style.display = 'block';
});

addVideoLink.addEventListener('click', () => {
  // Show the modal
  modal.style.display = 'block';
  // Hide the image-upload div
  imageUploadDiv.style.display = 'none';
});

addClipLink.addEventListener('click', () => {
  // Show the modal
  modal.style.display = 'block';
  // Hide the image-upload div
  imageUploadDiv.style.display = 'none';
});

 </script>

<script>
  const showCommentForms = document.querySelectorAll(".showCommentForm");
  const commentContainers = document.querySelectorAll(".comment-container");

  showCommentForms.forEach((showCommentForm, index) => {
    showCommentForm.addEventListener("click", () => {
      if (commentContainers[index].style.display === "block") {
        commentContainers[index].style.display = "none";
      } else {
        commentContainers[index].style.display = "block";
      }
    });
  });
</script>


</body>
</html>
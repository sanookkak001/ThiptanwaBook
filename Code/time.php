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
<!-- Post Content -->

<div class="container">
    <div class="post-container">
        <div class="post-body">
            <div class="post-body-up">
                <a href=""><img src="IMG/Post/326222683_1230834100974835_7649958409392376946_n.jpg" alt=""></a>
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
    $sql.= " ORDER BY post.time DESC";
    $x = 1;
    $result = mysqli_query($conn,$sql);
    $Result = mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result)) {
?> 

<div class="container-All">
    <div class="Container-Content">
        <div class="Content-body">
            <div class="header-Main">
                <a href=""><img src="IMG/Post/326222683_1230834100974835_7649958409392376946_n.jpg" alt=""></a>
                    <div class="header-left">
                        <a href=""><h4> <?php echo $_SESSION['member_name']; ?></h4></a>
                        <h5><time datetime="<?php echo $row["time"];?>"></time></h5>
                    </div>
            </div>
            <div class="Body-main">
                <h3><?php echo $row["post_name"];?></h3>
                <?php if($row["img"] == null){
                        // echo '<div class="image"><img src="IMG/Post/No-img.jpg" alt=""></div>';
                }else{; ?>
                        <div class="image"><img src="<?php echo "IMG/Post/".$row["img"]; ?>" alt=""></div>
                    <?php } ?>
            </div>
        </div>   
    </div>     
</div>
<?php } ?>
</body>
</html>

<?php
if ($_REQUEST["action"] == "Add")
{

    // $target_dir = "IMG/Post/";
    // $taget_file = $target_dir.basename($_FILES['img']['name']);
    // $uploadOK = 1;

        // if(move_uploaded_file($_FILES['img']['tmp_name'],$taget_file))

        // {
            if($_SESSION['member_id'] == '1'){
                $current_id = '1';
            }else{
                $current_id = '2';
            };
            $post_name= $_POST['post_name'];
            // $news_details= $_POST['news_details'];
            // $img=$_FILES['img']['name'];
            $member_id= $_SESSION['member_id'];
        // }
            $sql = "insert into post(post_name,member_id,current_id)";
            $sql.= " VALUES('$post_name','$member_id','$current_id')";
            $result = mysqli_query($conn,$sql);
            if($result){
                echo"<script>alert('insert success !!!')</script>";
                echo "<script> window.location.href='index.php'</script>";
            }else{

                echo"<script>alert('Error something like that !!!')</script>";
                echo "<script> window.location.href='index.php'</script>";
        }
}
 ?>

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
            <a href="#"><img src="IMG/Post/326222683_1230834100974835_7649958409392376946_n.jpg" alt=""></a>
            <div class="status">
                <h4><?php echo $_SESSION['member_name']; ?></h4>
                <h5><?php echo $row["status_name"]; ?></h5>
            </div>
        </div>
        <form action="<? echo $_SERVER[SCRIPT_NAME]; ?>?action=Add" method="post"  enctype="multipart/form-data">
        <textarea type="text" id="text"  name='post_name' placeholder="คุณกำลังคิดอะไร  <?php echo $_SESSION['member_name']; ?>"></textarea>
        <div class="order">
            <p>เพิ่มในโพสต์ของคุณ</p>
            <div class="order-img">
                <img src="IMG/Post/0001-104.jpg" alt="">
                <img src="IMG/Post/0001-104.jpg" alt="">
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
    <img src="IMG/Post/0001-104.jpg" alt="">
</div>


<!-- script zone -->

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script>
        document.querySelectorAll('.Body-main img').forEach(image => {
            image.onclick = () => {
                document.querySelector('.popup-image').style.display = 'block';
                document.querySelector('.popup-image img').src = image.getAttribute("src");
            }
        });
        document.querySelector('.popup-image span').onclick = () => {
            document.querySelector('.popup-image').style.display = "none";
        }
</script>
<script>
  // Get the text box element and the button element
  const textBox = document.getElementById('text');
  const myButton = document.getElementById('BTS');

  // Disable the button initially
    myButton.disabled = true;

  // Listen for changes in the text box
  textBox.addEventListener('input', function() {
    // If the text box is empty, disable the button
    if (textBox.value.trim() === '') {
      myButton.disabled = true;
      myButton.style.backgroundColor = "rgba(128, 128, 128, 0.9)";
      myButton.style.cursor = "no-drop";
    } else {
      // Otherwise, enable the button
      myButton.disabled = false;
      myButton.style.backgroundColor = "";
      myButton.style.cursor = "pointer";
    }
  });
</script>

<!-- Time Zone -->

<script>
    function timeToWords(time, lang) {
  lang = lang || {
    postfixes: {
      '<': ' ที่แล้ว',
      '>': ' จากนี้'
    },
    1000: {
      singular: 'ไม่กี่วิ',
      plural: 'ไม่กี่วิ '
    },
    60000: {
      singular: '1 นาที',
      plural: '# นาที'
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

  var timespans = [1000, 60000, 3600000, 86400000, 31540000000];
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

// Update time every minute (60000ms)
setInterval(updateTime, 60000);

// Call the function once to update the time on page load
updateTime();

  </script>
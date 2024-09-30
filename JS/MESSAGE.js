function showAlert() {
    // Create the alert message
    var alert = document.createElement("div");
    alert.className = "alert";
    alert.innerHTML = "คุณกำลังออกจากระบบ";
  
    // Create the close button
    var closeBtn = document.createElement("div");
    closeBtn.className = "closebtn";
    closeBtn.innerHTML = "&times;";
    closeBtn.onclick = function() {
      clearInterval(intervalId);
      alert.style.display = "none";
    }
    alert.appendChild(closeBtn);
  
    // Add the alert message to the top right of the screen
    document.body.appendChild(alert);
    alert.style.top = "0";
    alert.style.right = "0";
  
    // Set the countdown timer
    var timeLeft = 3; // 3 seconds
    var intervalId = setInterval(function() {
      alert.innerHTML =" กำลังออกจากระบบใน " + timeLeft + " วิ";
      timeLeft--;
      if (timeLeft < 0) {
        clearInterval(intervalId);
        window.location.href = "logout.php";
        alert.style.display = "none";
      }
    }, 1000); // update every 1 second
  }


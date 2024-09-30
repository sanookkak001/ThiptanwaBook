// index.js
window.onload = function() {
  const textBox = document.getElementById('text');
  const myButton = document.getElementById('BTS');
  const inputFile = document.getElementById('post-image');
  const closeUploadBtn = document.getElementById('close-upload');
  const imageUploadDiv = document.querySelector('.image-upload');

  myButton.disabled = true;

  const checkInputs = function() {
    if (textBox.value.trim() === '' && inputFile.files.length === 0) {
      myButton.disabled = true;
      myButton.style.backgroundColor = "rgba(128, 128, 128, 0.9)";
      myButton.style.cursor = "no-drop";
    } else {
      myButton.disabled = false;
      myButton.style.backgroundColor = "";
      myButton.style.cursor = "pointer";
    }
  };
  closeUploadBtn.addEventListener('click', () => {
    inputFile.value = '';
    imageUploadDiv.style.display = 'none';
    textBox.style.height = '150px';
    checkInputs(); // call the function to update the button state
  });

  checkInputs(); // call the function to set the initial button state

  textBox.addEventListener('input', checkInputs);
  inputFile.addEventListener('change', checkInputs);

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
};

// document.querySelectorAll('.Body-main img').forEach(image => {
//   image.onclick = () => {
//     document.querySelector('.popup-image').style.display = 'block';
//     document.querySelector('.popup-image img').src = image.getAttribute("src");
//   }
// });

// document.querySelector('.popup-image span').onclick = () => {
//   document.querySelector('.popup-image').style.display = "none";
// }

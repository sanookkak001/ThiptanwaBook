const password = document.querySelector("#password");
const togglePassword = document.querySelector("#togglePassword");
const Comfirmpassword = document.querySelector("#Comfirmpassword");
const not_match_password = document.querySelector("#not_match_password");
const email = document.querySelector("#email");
const Invalid_email = document.querySelector("#Invalid_email");
const error_full =document.querySelector("#error_full");

togglePassword.addEventListener("click", function() {
    if (password.type === "password") {
        password.type = "text";
        Comfirmpassword.type = "text";
        togglePassword.classList.remove("fa-eye-slash");
        togglePassword.classList.add("fa", "fa-eye");
    } else {
        password.type = "password";
        Comfirmpassword.type = "password";
        togglePassword.classList.remove("fa", "fa-eye");
        togglePassword.classList.add("fa","fa-eye-slash");
    }
});

Comfirmpassword.addEventListener("change", function() {
    if (Comfirmpassword.value === password.value) {
        not_match_password.innerHTML = "";
    } else {
        not_match_password.innerHTML = "รหัสผ่านไม่ตรงกัน";
    }
});

email.addEventListener("input", function() {
    let email_pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email_pattern.test(email.value)) {
        Invalid_email.innerHTML = "";
    } else {
        Invalid_email.innerHTML = "รูปแบบอีเมล์ไม่ถูกต้อง";
    }
});

function validateForm() {
    let isValid = true;
    let password = document.getElementById("password");
    let confirmPassword = document.getElementById("Comfirmpassword");
    let email = document.getElementById("email");
    let invalidEmail = document.getElementById("Invalid_email");
    let notMatchPassword = document.getElementById("not_match_password");

    if (password.value != confirmPassword.value) {
        notMatchPassword.innerHTML = "รหัสผ่านไม่ตรงกัน";
        isValid = false;
    } else {
        notMatchPassword.innerHTML = "";
    }

    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email.value)) {
        invalidEmail.innerHTML = "รูปแบบอีเมล์ไม่ถูกต้อง";
        isValid = false;
    } else {
        invalidEmail.innerHTML = "";
    }

    return isValid;
}


    document.querySelector("form").addEventListener("submit", function(event) {
        if (!validateForm()) {
            event.preventDefault();
        } else {
            var inputs = document.querySelectorAll('input[type="text"], input[type="password"]');
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].value.trim() == '') {
                    error_full.innerHTML = "กรุณากรองข้อมูลให้ครบ";
                    event.preventDefault();
                    break;
                }
            }
        }
    });



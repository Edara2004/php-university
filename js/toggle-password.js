function togglePassword() {

    var password = document.getElementById("userPassword")

    if (password.type === "password") {
        password.type = "text"
    } else {
        password.type = "password"
    }
}

/* 2nd input password */
function togglePassword2() {

    var password2 = document.getElementById("userPasswordR")

    if (password2.type === "password") {
        password2.type = "text"
    } else {
        password2.type = "password"
    }
}
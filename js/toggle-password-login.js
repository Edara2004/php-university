/* Login input password */

function togglePasswordLogin() {

    var password3 = document.getElementById("userPasswordId")

    if (password3.type === "password") {
        password3.type = "text"
    } else {
        password3.type = "password"
    }
}
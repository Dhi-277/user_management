//register validation
function registerValidate() {
    var formStatus = true;
    var uname = document.getElementById("uname");
    if (uname.value === "") {
        uname.style.cssText = "border:2px solid tomato";
        document.getElementById(uname.id + "_error").innerText = "This field is required";
        formStatus = false;
    }

    var email = document.getElementById("email");

    if (email.value === "") {
        email.style.cssText = "border:2px solid tomato";
        document.getElementById(email.id + "_error").innerText = "This field is required";
        formStatus = false;
    } else {
        if (!validateEmail(email.value)) {
            email.style.cssText = "border:2px solid tomato";
            document.getElementById(email.id + "_error").innerText = "Please enter valid email";
            formStatus = false;
        }
    }
    var pwd = document.getElementById("pwd");
    if (pwd.value === "") {
        pwd.style.cssText = "border:2px solid tomato";
        document.getElementById(pwd.id + "_error").innerText = "This field is required";
        formStatus = false;
    }
    var cpwd = document.getElementById("cpwd");
    if (cpwd.value === "") {
        cpwd.style.cssText = "border:2px solid tomato";
        document.getElementById(cpwd.id + "_error").innerText = "This field is required";
        formStatus = false;
    }
    if (pwd.value !== cpwd.value) {
        alert("Password does not match");
        formStatus = false;
    }
    return formStatus;
}

//login validation
function loginValidate() {
    $formStatus = true;
    var email = document.getElementById("email");
    if (email.value === "") {
        email.style.cssText = "border:2px solid tomato";
        document.getElementById(email.id + "_error").innerText = "This field is required";
        formStatus = false;
    } else {
        if (!validateEmail(email.value)) {
            email.style.cssText = "border:2px solid tomato";
            document.getElementById(email.id + "_error").innerText = "Please enter valid email";
            formStatus = false;
        }
    }
    var pwd = document.getElementById("pwd");
    if (pwd.value === "") {
        pwd.style.cssText = "border:2px solid tomato";
        document.getElementById(pwd.id + "_error").innerText = "This field is required";
        formStatus = false;
    }
    return formStatus;
}

//forgot validation
function forgotValidate() {
    $formStatus = true;
    var email = document.getElementById("email");
    if (email.value === "") {
        email.style.cssText = "border:2px solid tomato";
        document.getElementById(email.id + "_error").innerText = "This field is required";
        formStatus = false;
    } else {
        if (!validateEmail(email.value)) {
            email.style.cssText = "border:2px solid tomato";
            document.getElementById(email.id + "_error").innerText = "Please enter valid email";
            formStatus = false;
        }
    }
    return formStatus;
}

//reset password validations
function resetValidate()
{
    var formStatus = true;
    var pwd = document.getElementById("pwd");
    if (pwd.value === "") {
        pwd.style.cssText = "border:2px solid tomato";
        document.getElementById(pwd.id + "_error").innerText = "This field is required";
        formStatus = false;
    }
    var cpwd = document.getElementById("cpwd");
    if (cpwd.value === "") {
        cpwd.style.cssText = "border:2px solid tomato";
        document.getElementById(cpwd.id + "_error").innerText = "This field is required";
        formStatus = false;
    }
    if (pwd.value !== cpwd.value) {
        alert("Password does not match");
        formStatus = false;
    }
    return formStatus;
}

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function hideError(element) {
    if (element.value === "") {
        element.style.cssText = "border:2px solid #333";
        document.getElementById(element.id + "_error").innerText = "";
    }
}

function checkError(element) {
    if (element.value === "") {
        element.style.cssText = "border:2px solid tomato";
        document.getElementById(element.id + "_error").innerText = "This field is required";
    }
}
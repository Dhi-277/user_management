<?php
include("connection.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Here</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Register Here</h1>
        <?php

        //reading cookie message
        if (isset($_COOKIE['success'])) {
            echo "<p>" . $_COOKIE['success'] . "</p>";
        }
        if (isset($_COOKIE['error'])) {
            echo "<p>" . $_COOKIE['error'] . "</p>";
        }

        //filtering form data
        function filterData($data)
        {
            return addslashes(strip_tags(trim($data)));
        }

        //accessing form data
        if (isset($_POST['save'])) {
            $uname = isset($_POST['uname']) ? filterData($_POST['uname']) : "";
            $email = isset($_POST['email']) ? filterData($_POST['email']) : "";
            $pass = isset($_POST['pwd']) ? filterData($_POST['pwd']) : "";
            $hpass = password_hash($pass, PASSWORD_DEFAULT);
            $mobile = isset($_POST['mobile']) ? filterData($_POST['mobile']) : "";
            $gender = isset($_POST['gender']) ? filterData($_POST['gender']) : "";
            $ip = $_SERVER['REMOTE_ADDR'];

            //inserting data into DB
            mysqli_query($con, "INSERT INTO users (username, email, password, mobile, gender,ip) VALUES ('$uname', '$email', '$hpass', '$mobile', '$gender', '$ip');");
            if (mysqli_affected_rows($con) == 1) {
                $token = base64_encode($email);
                $subject = "Account Activation NIT";
                $message = "Hi ".$uname."<br>, Thanks your account created successfully. Please click the below link to activate your account<br><br><a href='http://localhost/practice/activate.php?key=".$token."' targt='_blank'>Activate Now</a><br><br>Thanks<br>Team" ;
                $mheaders = "Content-Type:text/html";
                echo $message;
                exit;
                if(mail($email, $subject, $message, $mheaders)){
                    setcookie("success", "Mail sent successfully kindly activate your account", time() + 3);
                    header("Location: register.php");
                }
            } else {
                setcookie("error", "Sorry Unable to create an account", time() + 3);
                header("Location: register.php");
            }
        }
        ?>
        <form method="POST" autocomplete="off" action="" onsubmit="return registerValidate()">
            <div class="formgroup">
                <label for="">UserName:</label>
                <input type="text" onfocus="hideError(this)" onblur="checkError(this)" name="uname" id="uname" class="formcontrol" />
                <small class="errormsg" id="uname_error"></small>
            </div>

            <div class="formgroup">
                <label for="">Email:</label>
                <input type="text" onfocus="hideError(this)" onblur="checkError(this)" name="email" id="email" class="formcontrol" />
                <small class="errormsg" id="email_error"></small>
            </div>

            <div class="formgroup">
                <label for="">Password:</label>
                <input type="text" name="pwd" id="pwd" class="formcontrol" />
                <small class="errormsg" id="pwd_error"></small>
            </div>

            <div class="formgroup">
                <label for="">Confirm Password:</label>
                <input type="text" name="cpwd" id="cpwd" class="formcontrol" />
                <small class="errormsg" id="cpwd_error"></small>
            </div>

            <div class="formgroup">
                <label for="">Mobile:</label>
                <input type="text" name="mobile" id="mobile" class="formcontrol" />
            </div>

            <div class="formgroup">
                <label for="">Gender:</label>
                <label for=""><input type="radio" name="gender" value="Male" />Male</label>
                <label for=""><input type="radio" name="gender" value="Female" />Female</label>
            </div>
            <div class="formgroup">
                <input type="submit" value="Register" name="save" class="btn" />
            </div>
        </form>
    </div>
    <script src="js/validations.js"></script>
</body>

</html>
<?php
mysqli_close($con) ?>
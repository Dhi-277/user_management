<?php
if (isset($_REQUEST['key']) && !empty($_REQUEST['key'])) {
    include("connection.php");
    $email = base64_decode($_REQUEST['key']);
    $result = mysqli_query($con, "SELECT email from users where email='$email'");

    if (mysqli_num_rows($result) == 1) {
?>
        <html>

        <head>
            <title>Reset Password</title>
            <link rel="stylesheet" href="css/styles.css">
        </head>

        <body>
            <div class="container">
                <h1>Reset Password</h1>
                <?php
                 //reading cookie message
                 if (isset($_COOKIE['success'])) {
                    echo "<p>" . $_COOKIE['success'] . "</p>";
                }
                if (isset($_COOKIE['error'])) {
                    echo "<p>" . $_COOKIE['error'] . "</p>";
                }
                if (isset($_POST['submit'])) {
                    //filtering form data
                    function filterData($data)
                    {
                        return addslashes(strip_tags(trim($data)));
                    }
                    $pass = isset($_POST['pwd']) ? filterData($_POST['pwd']) : "";
                    $hpass = password_hash($pass, PASSWORD_DEFAULT);
                    mysqli_query($con, "UPDATE users set password='$hpass' where email='$email'");
                    if (mysqli_affected_rows($con) == 1) {
                        setcookie("success", "Password updated succesfully please login.", time() + 3);
                        header("Location: login.php");
                    } else {
                        setcookie("error", "Sorry! unable to reset password.", time() + 3);
                        header("Location: login.php");
                    }
                }
                ?>
                <form action="" method="POST" onsubmit="return resetValidate()">
                    <div class="formgroup">
                        <label for="">Password:</label>
                        <input type="text" name="pwd" id="pwd" onfocus="hideError(this)" onblur="checkError(this)" class="formcontrol" />
                        <small class="errormsg" id="pwd_error"></small>
                    </div>
                    <div class="formgroup">
                        <label for="">Confirm New Password:</label>
                        <input type="text" name="cpwd" id="cpwd" onfocus="hideError(this)" onblur="checkError(this)" class="formcontrol" />
                        <small class="errormsg" id="cpwd_error"></small>
                    </div>
                    <div class="formgroup">
                        <input type="submit" value="Submit" name="submit" class="btn" />
                    </div>
                </form>
            </div>
            <script src="js/validations.js"></script>
        </body>

        </html>
<?php
    } else {
        echo "<p>Sorry! unable to find your account.</p>";
    }
    mysqli_close($con);
} else {
    header("Location:login.php");
}
?>
<?php include("connection.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
    <h1>Forgot Password</h1>
    <?php
    //filtering form data
    function filterData($data)
    {
        return addslashes(strip_tags(trim($data)));
    }

    if(isset($_POST['submit']))
    {
        $email = isset($_POST['email']) ? filterData($_POST['email']) : "";
        $result = mysqli_query($con, "SELECT id,username,email from users where email = '$email'");
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            $token = base64_encode($email);
            $subject = "Forgot Password Request-NIT";
            $message = "Hi ".$row['username']."<br><br>Your reset password request has received. Please click the below link to reset your password.<br><br><a href='http://localhost/practice/resetpwd.php?key=$token' target='_blank'>Reset Password</a><br><br>Thanks<br>Team";
            $mheaders = "Content-Type:text/html";
            // echo $message; exit;
            if(mail($email,$subject,$message,$mheaders))
            {
                setcookie('success',"Reset password link has sent to your email. Please check",time()+3);
                header("Location:forgot.php");
            }
            else
            {
                setcookie('error',"Sorry! Unable to send reset password link",time()+3);
                header("Location:forgot.php");
            }
        }
        else
        {
            echo "<p>Sorry! Email does not found</p>";
        }
    }
    ?>
    <form method="POST" action="" onsubmit="return forgotValidate()">
            <div class="formgroup">
                <label for="">Email:</label>
                <input type="text" onfocus="hideError(this)" onblur="checkError(this)" name="email" id="email" class="formcontrol" />
                <small class="errormsg" id="email_error"></small>
            </div>

            <div class="formgroup">
                <input type="submit" value="Submit" name="submit" class="btn" />
            </div>
        </form>
    </div>
    <script src="js/validations.js"></script>
</body>
</html>
<?php mysqli_close($con);?>
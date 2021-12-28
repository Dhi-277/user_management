<?php
if(isset($_REQUEST['key']) && !empty($_REQUEST['key']))
{
    include("connection.php");


    $email = base64_decode($_REQUEST['key']);
    $result = mysqli_query($con, "SELECT username, status from users where email = '$email'");
    if(mysqli_num_rows($result) == 1)
    {
        $row = mysqli_fetch_assoc($result);
        if($row['status'] === "inactive")
        {
            mysqli_query($con,"UPDATE users SET status = 'active' where email = '$email'");
            if(mysqli_affected_rows($con) == 1)
            {
                echo "<p>Account activated successfully.</p>";
            }
            else
            {
                echo "<p>Unable to activate your account.</p>";
            }
        }
        else
        {
            echo "<p>Your accont is alrady active.</p>";
        }
    }
    else
    {
        echo "<p>Sorry! unable to find your account.</p>";
    }
    mysqli_close($con);
}
else
{
    echo "<p>Unauthorized Access..</p>";
}
?>
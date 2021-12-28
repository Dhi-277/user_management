<?php
session_start();
if(isset($_SESSION["userid"]) && !empty($_SESSION["userid"]))
{
    include("connection.php");
    $id = $_SESSION["userid"];
    $result = mysqli_query($con,"SELECT * from users where id=$id");
    $row = mysqli_fetch_assoc($result);
    ?>
    <html>
        <head>
        <title><?php echo ucwords($row['username'])?> | NIT</title>
        </head>
        <body>
            <h1>Welcome  <?php echo ucwords($row['username'])?></h1>
            <p><a href="logout.php">Logout</a></p>
            <div class="container">
                <table>
                    <tr>
                    <td>ID</td>
                    <td><?php echo $row['id']?></td>
                    </tr>
                    <tr>
                    <td>UserName</td>
                    <td><?php echo $row['username']?></td>
                    </tr>
                    <tr>
                    <td>Email</td>
                    <td><?php echo $row['email']?></td>
                    </tr>
                    <tr>
                    <td>Mobile</td>
                    <td><?php echo $row['mobile']?></td>
                    </tr>
                    <tr>
                    <td>Date of Joining</td>
                    <td><?php echo $row['created_at']?></td>
                    </tr>
                </table>
            </div>
        </body>
    </html>
    <?php
    mysqli_close($con);
}
else
{
    header("Location:login.php");
}
?>
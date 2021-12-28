<?php include('connection.php')?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: blanchedalmond;
        }
    </style>
</head>

<body>
    <h1>Enquiry List</h1>
    <?php
    $resultset = mysqli_query($con, "select * from enquiries");
    if (mysqli_num_rows($resultset)) {
    ?>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Message</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_row($resultset)) {
            ?>
                <tr>
                    <td><?php echo $row[0] ?></td>
                    <td><?php echo $row[1] ?></td>
                    <td><?php echo $row[2] ?></td>
                    <td><?php echo $row[3] ?></td>
                    <td><?php echo $row[4] ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    } else {
        echo "no record found";
    }
    ?>
</body>

</html>
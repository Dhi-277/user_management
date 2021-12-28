<?php
session_start();
if(($_SESSION["userid"]) && !empty($_SESSION["userid"]))
{
    session_unset();
    session_destroy();
    header("Location:login.php");
}
else
{
    header("Location:login.php");
}
?>
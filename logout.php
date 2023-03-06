<?php
    require "connection.php";
    require "header.php";
    session_start();
    session_destroy();
    header("Location:index.php");
    require "footer.php";
?>
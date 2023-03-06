<?php
    $dsn="mysql:host=localhost;dbname=login_db";
    $user="root";
    $password="";
    $options=[];
    try{
        $connection=new PDO($dsn,$user,$password,$options);
        // echo"<p class='text-light bg-success m-0'>Connection successfull!</p>";
    }
    catch(PDOException){
        echo"<p class='text-light bg-danger m-0'>Connection Interrupted!</p>";
    }
?>
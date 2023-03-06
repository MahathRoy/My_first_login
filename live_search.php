<?php
    require "connection.php";
    $input=$_POST['email'];
    $sql='SELECT * FROM reg_table WHERE (email=:email)';
    $statement=$connection->prepare($sql);
    $statement->execute([':email'=>$input]);
    $result=$statement->fetch(PDO::FETCH_OBJ);
    if($statement->rowCount()>0){
        echo json_encode($result);
    }
    else{
        echo '0';
    }

?>
<?php 

require 'connection.php';
require 'header.php'; 

session_start();

if(!isset($_SESSION['email'])){
    header("Location:index.php");
}
else{



    $user_data=$_SESSION['email'];
    $sql_fetch='SELECT * FROM reg_table WHERE email=:email';
    $statement_fetch=$connection->prepare($sql_fetch);
    $statement_fetch->execute([':email'=>$user_data]);
    $images=$statement_fetch->fetch(PDO::FETCH_OBJ);

    if(isset($_POST['logout'])){

        header("Location:logout.php");

    }
}
?>
<div class="container">
    <div class="flex text-end">
        <form method="POST">
            <button type="submit" name="logout"  class="btn btn-outline-none fa-solid fa-right-from-bracket fs-1"></button>
        </form>
    </div>

    <div class="row justify-content-around p-0 m-0">
            <div class="col-10 col-lg-4  row justify-content-center py-5 p-0 m-0">
           
                <div class="col-12 col-lg-12 row justify-content-center p-0 m-0">
                    <div class="col-10 col-lg-10 row text-center">
                    <img src="uploads/<?=$images->img?>" class="wid rounded-4">
                    </div>
                </div>
               
           
            </div>
            <div class="col-12 col-lg-5 py-5">
                <p class="text-center text-danger  fs-1 fw-bold">Welcome <?=$images->fname.' '.$images->lname?> !</p>
                <p class="text-center  fs-1 fw-bold">Your email id is <?= $images->email?></p>
            </div>
    </div>

</div>



<?php 
require 'footer.php';
?>
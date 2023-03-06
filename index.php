<?php 
    require 'connection.php';
    require 'header.php';  
   require 'footer.php';
   session_start();
?>





<?php
    $invalid=0;
    if(isset($_POST['reg_password'])&&($_POST['email']))
    {
        $log_pass=md5($_POST['reg_password']);
        $log_email=$_POST['email'];
        $sql='SELECT * FROM reg_table WHERE email=:email';
        $statement=$connection->prepare($sql);
        $statement->execute([':email'=>$log_email]);
        $db_data=$statement->fetch(PDO::FETCH_ASSOC);
        if($db_data!==false)
        {
            $p=$db_data['password'];
            if ($log_pass==$p){
                $_SESSION["email"]=$log_email;
                header("Location:login.php");
            }
            else{
            // invalid password
            $invalid=1;
            }
       }
       else{
        // invalid username
        $invalid=2;
        }
    } 
     
if(isset($_POST['pass'])&&isset($_POST['cpass'])&&isset($_POST['re_mail'])){
    
    $pass=md5($_POST['pass']);
    $cpass=md5($_POST['cpass']);
    $re_email=$_POST['re_mail'];
    if($cpass!=$pass){
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Password mismatch!',})
            </script>";
           
        }
        
    else{
    $sql='UPDATE reg_table SET password = :cpass WHERE email=:email;';
    $statement=$connection->prepare($sql);
    $statement->execute([':cpass'=>$cpass,':email'=>$re_email]);
    echo "<script>Swal.fire({
        icon: 'success',
        title: 'success',
        text: 'Password changed successfully',})
        </script>";

    }
}
if(isset($_POST['reset_close'])){

    echo "<script>Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Password do not resetted!',})
        </script>";

}




?>



<div class="container-fluid bg-secondary bg-opacity-25 m-0 p-0 pb-5">
    <div class="row justify-content-end m-0 p-0 ">
        <div class="col-8 col-lg-5 mt-5 pt-5">
            <img src="images/login_logo.png " class="widlogo" alt="">
        </div>
    </div>
    <div class="row justify-content-center gap-5 p-0 m-0 py-5">
        <div class="col-12 col-lg-4">
           <img src="images/logo2.png" alt=" " class="wid">
        </div>
        <div class="col-10 col-lg-5">
        <form method="POST">
            <?php if($invalid==1){echo '<div class="alert alert-danger" role="alert">
                                       Invalid password!
                                    </div>';}?>
             <?php if($invalid==2){echo '<div class="alert alert-danger" role="alert">
                                       Invalid username !
                                    </div>';}?>
           
            <div class="my-0 my-lg-4">
              
                <input type="email" class="form-control py-3" name="email" placeholder="Email">
            </div>
            <div class="my-4">
                <input type="password" class="form-control py-3" name="reg_password" placeholder="Password">
            </div>
            <div class="my-4 row m-0 p-0">
                <input  type="submit" class="btn btn-primary py-3" name="login"  value="Login">
            </div>
            <div class="mt-4 row m-0 p-0">
                <a href="reg.php" type="submit" class="btn btn-info py-3" id="">Create New Account</a>
            </div>

            <div class="py-3 mb-2 row">
                <!-- Button trigger modal -->
                <button type="button" class="btn text-decoration-underline  text-center text-lg-start" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Forgotten Password???
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Reset password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="post">

                                <div class="modal-body row">
                                    <input type="email" class="form-control my-3" name="re_mail" id="em" placeholder="Email">
                                    <p id="mail_sts"></p>
                                </div>
                                <div id="qus_div">

                                    <span class="text-primary">Your security question: </span><span id="qus"></span>
                                    <input type="text" class="form-control my-3 " id="ans" placeholder="Enter your answer">
                                    <p id="qus_sts"></p>
                                </div></form><form action="" method="post"></form>
                                <div id="pass_div">
                                    <input type="password" class="form-control my-3" name="pass" placeholder="Enter new password">
                                    <input type="password" class="form-control my-3" name="cpass" placeholder="Confirm password">
                                    <input type="submit" name="reset_sub" value="Submit" class="btn btn-primary">
                                    <input type="submit" name="reset_close" value="Close" class="btn btn-secondary">

                                </div>
                            </form>
                            
                        
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

<?php 
require 'footer.php'; ?>
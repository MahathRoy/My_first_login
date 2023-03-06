<?php 
require 'connection.php';
require 'header.php';  
require 'footer.php';
?>

<?php
if(isset($_POST['submit'])){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $pic_name=$_FILES['img']['name'];
    $tmp_pic_name=$_FILES['img']['tmp_name'];
    $target="uploads/".basename($pic_name);
    move_uploaded_file($tmp_pic_name,$target);
    $setpassword=md5($_POST['password']);
    $set_confirm_password=md5($_POST['confirm_password']);
    $squs=$_POST['squs'];
    $sans=$_POST['sans'];
    echo $password;
    $sql="SELECT * FROM reg_table WHERE email=:email";
    $statement=$connection->prepare($sql);
    $statement->execute(['email'=>$email]);
    $user=$statement->fetch(PDO::FETCH_ASSOC);
    if($user)
    {
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Already registered!',})
            </script>";
    }
    else if( $setpassword!=$set_confirm_password){
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Password does not match!',})
            </script>";
    }
    else{
    $sql='INSERT INTO reg_table(fname,lname,email,img,password,squs,sans) VALUES(:fname,:lname,:email,:img,:password,:squs,:sans)';
    $statement=$connection->prepare($sql);
    $log=$statement->execute([':fname'=>$fname,':lname'=>$lname,':email'=>$email,':img'=>$pic_name,':password'=>$setpassword,':squs'=>$squs,':sans'=>$sans]);
    
    if($log){
        echo "<script>Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Registration Succcess!',
            showConfirmButton: false,
            timer: 2000
          })
        .then(function(){window.location='index.php';});</script>";
    }
    else{
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Regstration failed!',})
            </script>";
    }
}
}
?>

<div class="container-fluid bg-secondary bg-opacity-25 m-0 p-0 ">
    <div class="row justify-content-end m-0 p-0 ">
        <div class="col-12 col-lg-8 pt-3">
            <p class="text-center font_common ">Register</p>
        </div>
    </div>
    <div class="row justify-content-center gap-5 p-0 m-0 ">
        <div class="col-12 col-lg-4 mt-0 pt-3 mt-lg-p pt-lg-5">
           <img src="images/register.png" alt=" " class="wid">
        </div>
        <div class="col-10 col-lg-5">
            <form method="POST" enctype="multipart/form-data">
                <div class="my-0 my-lg-4">
                    <input type="text" class="form-control py-3" name="fname" placeholder="FirstName" required>
                </div>
                <div class="my-4">
                    <input type="text" class="form-control py-3" name="lname" placeholder="LastName">
                </div>
                <div class="my-4">
                    <input type="email" class="form-control py-3" name="email" placeholder="Email" required>
                </div>
                <div class="my-4">
                    <input type="file" class="form-control py-3" name="img" required>
                </div>
                <div class="my-4">
                    <input type="password" class="form-control py-3" name="password" placeholder="Password" required>
                </div>
                <div class="my-4">
                    <input type="password" class="form-control py-3" name="confirm_password" placeholder="Confirm Password" required>
                </div>
                <div class="my-4">
                    <select id="form-control-select1" class="my-4 form-control" name="squs" required>
                        <option value="" disabled selected>Choose one security question</option>
                <option value="Your nick name">Your nick name</option>
                <option value="Your pet name">Your pet name</option>
                <option value="Your favourite four digit number">Your favourite four digit number</option>
            </select>
            </div>
            <div class="my-4">
            <input type="text" class="form-control py-3" id="" placeholder="Your Answer" for="form-control-select1" name="sans" required>
            </div>
          


            <div class="my-4 row m-0 p-0">
                <button type="submit" class="btn btn-primary py-3" name="submit" >Submit</button>
            </div>
            <div class="mt-4 row m-0 p-0 mb-5">
                <a href="index.php" type="submit" class="btn btn-info py-3" id="">Already have an account?</a>
            </div>
           
        </form>
        </div>
    </div>

    </div>
</div>

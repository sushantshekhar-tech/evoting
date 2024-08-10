<?php
include("connect.php");
include("email.php");

$email=$_POST['email'];
$sql= "Select * from users where email='$email'";
$rs=mysqli_query($con,$sql);
if(mysqli_num_rows($rs)>0){
    $otp=rand(11111,99999);
    send_otp($email,"PHP OTP LOGIN",$otp);
    $sql="UPDATE users set user_otp='$otp' where email='$email'";
    $rs=mysqli_query($con,$sql) ;
    echo '<script>
    alert("Plz check your email for OTP and verify");
    window.location="../partials/validate_otp.php";czvzcvvzc
    </script>';
    //header("location:actions/verify.php?msg=Plz check your email for OTP and verify");
    //echo "Email found";
}
else{
    echo '<script>
    alert("Email is invalid... Plz check again");
    window.location="../";
    </script>';
    //header("location:index.php?msg=Email is invalid... Plz check again");
    //echo "Email not found";
}
?>






<?php
session_start();
include('connect.php');

$email= $_POST['email'];
//$mobile= $_POST['mobile'];
$password= $_POST['password'];
//$verify_token= md5(rand());
$std= $_POST['std'];

$sql= "SELECT * from users where email= '$email' and password= '$password'";
$result= mysqli_query($con,$sql);
//echo var_dump($result);
if(mysqli_num_rows($result)>0){
    //$otp=rand(11111,99999);
    $sql= "SELECT fullname, photo, votes, id from users where standard='group'";
    $resultgroup=mysqli_query($con,$sql);
    if(mysqli_num_rows($resultgroup)>0){
        $groups= mysqli_fetch_all($resultgroup, MYSQLI_ASSOC);
        $_SESSION['groups']= $groups;
    }
    $data= mysqli_fetch_array($result);
    $_SESSION['id']=$data['id'];
    $_SESSION['status']=$data['status'];
    $_SESSION['data']=$data;

    echo '<script>
    
    window.location= "../partials/dashboard.php";
    </script>';

}else{
    echo '<script>
    alert("Invalid Credentials");
    window.location= "../";
    </script>';
}

?>

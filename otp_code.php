<?php
include('header.php');


if(Login::isLoggedIn()){
  $userid=Login::isLoggedIn();
  $accountid=DB::query('SELECT account_id FROM users WHERE id=:userid', array(':userid'=>$userid))[0]['account_id'];
  $username=DB::query('SELECT username FROM users WHERE id=:userid', array(':userid'=>$userid))[0]['username'];
  if(isset($_POST['confirmotp_code'])){
    $otppin=$_POST['otp_code'];
     
     if(DB::query('SELECT  otp_code FROM accounts WHERE otp_code=:otppin AND id=:accountid',array( ':otppin'=>$otppin, 'accountid'=>$accountid))){
        header("Location:success.php");

     }else{
       echo "<div class='container mt-5  mx-auto'><p class='alert alert-danger pt-4'>Invalid One time Password Code</p></div>";
     }
  }



}else{
    header('Location: login.php');
    exit;
}


?>



<div class="container mt-5 pt-4">
  <div class="row">
    <div class="col-md-6 mx card pt-3">
     <h1>Enter your one time password</h1>
      <form action="<?php echo "otp_code.php?security=otpcheck";?>" class="card-body" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="otp_code">
            <input type="submit" class="btn btn-primary" name="confirmotp_code">
        </div>
      
      </form>
    
    </div>
    <div class="col-md-6">
          <img src="" alt="">
    </div>
  </div>

</div>
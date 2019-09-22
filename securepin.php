<?php
include('header.php');


if(Login::isLoggedIn()){
  $userid=Login::isLoggedIn();
  $accountid=DB::query('SELECT account_id FROM users WHERE id=:userid', array(':userid'=>$userid))[0]['account_id'];
  $username=DB::query('SELECT username FROM users WHERE id=:userid', array(':userid'=>$userid))[0]['username'];
  if(isset($_POST['confirmsecure'])){
    $pin=$_POST['secure'];
     
     if(DB::query('SELECT  acct_pin FROM accounts WHERE acct_pin=:pin AND id=:accountid',array( ':pin'=>$pin, 'accountid'=>$accountid))){
        header('Location:tcc_code.php?security=securecheck');

     }else{
       echo "<div class='container mt-5  mx-auto'><p class='alert alert-danger pt-4'>Invalid Pin</p></div>";
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
     <h1>Enter your Secure Pin</h1>
      <form action="securepin.php" class="card-body" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="secure">
            <input type="submit" class="btn btn-primary" name="confirmsecure">
        </div>
      
      </form>
    
    </div>
    <div class="col-md-6">
          <img src="" alt="">
    </div>
  </div>

</div>
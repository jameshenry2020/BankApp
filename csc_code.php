<?php
include('header.php');


if(Login::isLoggedIn()){
  $userid=Login::isLoggedIn();
  $accountid=DB::query('SELECT account_id FROM users WHERE id=:userid', array(':userid'=>$userid))[0]['account_id'];
  $username=DB::query('SELECT username FROM users WHERE id=:userid', array(':userid'=>$userid))[0]['username'];
  if(isset($_POST['confirmcsc_code'])){
    $cscpin=$_POST['csc_code'];
     
     if(DB::query('SELECT  csc_code FROM accounts WHERE csc_code=:tccpin AND id=:accountid',array( ':tccpin'=>$cscpin, 'accountid'=>$accountid))){
        header("Location:sort_code.php?security=sort_code");

     }else{
       echo "<div class='container mt-5  mx-auto'><p class='alert alert-danger pt-4'>Invalid Csc code</p></div>";
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
     <h1>Enter your  CSC Code</h1>
      <form action="csc_code.php" class="card-body" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="csc_code">
            <input type="submit" class="btn btn-primary" name="confirmcsc_code">
        </div>
      
      </form>
    
    </div>
    <div class="col-md-6">
          <img src="" alt="">
    </div>
  </div>

</div>
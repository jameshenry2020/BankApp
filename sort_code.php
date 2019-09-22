<?php
include('header.php');


if(Login::isLoggedIn()){
  $userid=Login::isLoggedIn();
  $accountid=DB::query('SELECT account_id FROM users WHERE id=:userid', array(':userid'=>$userid))[0]['account_id'];
  $username=DB::query('SELECT username FROM users WHERE id=:userid', array(':userid'=>$userid))[0]['username'];
  if(isset($_POST['confirmsort_code'])){
    $sortpin=$_POST['sort_code'];
     
     if(DB::query('SELECT  sort_code FROM accounts WHERE sort_code=:sortpin AND id=:accountid',array( ':sortpin'=>$sortpin, 'accountid'=>$accountid))){
        header("Location:otp_code.php?security=otpcheck");

     }else{
       echo "<div class='container mt-5  mx-auto'><p class='alert alert-danger pt-4'>Invalid Sort Code</p></div>";
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
     <h1>Enter Your Sort  Code</h1>
      <form action="<?php echo "sort_code.php?security=sort_code";?>" class="card-body" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="sort_code">
            <input type="submit" class="btn btn-primary" name="confirmsort_code">
        </div>
      
      </form>
    
    </div>
    <div class="col-md-6">
          <img src="" alt="">
    </div>
  </div>

</div>
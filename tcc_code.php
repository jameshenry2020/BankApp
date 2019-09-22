<?php
include('header.php');


if(Login::isLoggedIn()){
  $userid=Login::isLoggedIn();
  $accountid=DB::query('SELECT account_id FROM users WHERE id=:userid', array(':userid'=>$userid))[0]['account_id'];
  $username=DB::query('SELECT username FROM users WHERE id=:userid', array(':userid'=>$userid))[0]['username'];
  if(isset($_POST['confirmtcc_code'])){
    $tccpin=$_POST['tcc_code'];
     
     if(DB::query('SELECT  tcc_code FROM accounts WHERE tcc_code=:tccpin AND id=:accountid',array( ':tccpin'=>$tccpin, 'accountid'=>$accountid))){
        header("Location:csc_code.php");

     }else{
       echo "<div class='container mt-5  mx-auto'><p class='alert alert-danger pt-4'>Invalid Clearance Code</p></div>";
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
     <h1>Enter your Tax Clearance  Code</h1>
      <form action="<?php echo "tcc_code.php?security=securecheck";?>" class="card-body" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="tcc_code">
            <input type="submit" class="btn btn-primary" name="confirmtcc_code">
        </div>
      
      </form>
    
    </div>
    <div class="col-md-6">
          <img src="" alt="">
    </div>
  </div>

</div>
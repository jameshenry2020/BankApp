<?php
include('classes/db.php');
include('classes/Login.php');

if(!Login::isLoggedIn()){ 
   header("Location: login.php");
   die('Not logged in');
}

if(isset($_POST['confirm'])){
    if(isset($_COOKIE['OBID'])){
        DB::query('DELETE FROM login_tokens WHERE token=:token',array('token'=>sha1($_COOKIE['OBID'])));
        header("Location: login.php");

    }
         setcookie('OBID','1',time()-3600);
         setcookie('OBID_','1',time()-3600);
}


?>
<div class="container">
<h1>Logout of your Account</h1>
<p>Are you sure you want to Logout?</p>
<form action="logout.php" method="POST">
    <input type="submit" class="btn btn-danger" name="confirm" value="Confirm">
</form>
</div>


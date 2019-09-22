<?php
include('header.php');
if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    if(DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))){
        if(password_verify($password, DB::query('SELECT password FROM users WHERE username=:username', array(':username'=>$username))[0]['password'])){
              echo "<div class='mt-5 pt-5 text-center'><p class='alert alert-success'>Logged In</p></div>";
                 header("Location: profile.php?username=$username");
               $cstrong =True;
               $token=bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
               $userid=DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$username))[0]['id'];
               DB::query('INSERT INTO login_tokens VALUES(\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$userid));
                
               setcookie("OBID", $token, time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
               setcookie("OBID_", '1', time() + 60 * 60 * 24 * 1, '/', NULL, NULL, TRUE);
               

        }else{
            echo "<div class='mt-5 pt-5 text-center'><p class='alert alert-danger'>incorrect password</p></div>";
        }

    }else{
        echo "<div class='mt-5 pt-5 text-center'><p class='alert alert-danger'>user not register!</p></div>";
    }
}



?>

<div class="container mt-5 pt-5">
 <div class="row">
 <div class="col-md-6 mx-auto">
       <!-- Material form login -->
<div class="card">

<h5 class="card-header info-color white-text text-center py-4">
  <strong>Sign in</strong>
</h5>

<!--Card content-->
<div class="card-body px-lg-5 pt-0">

  <!-- Form -->
  <form class="text-center" style="color: #757575;" action="login.php" method="POST">

    <!-- Email -->
    <div class="md-form">
      <input type="text" id="materialLoginFormEmail" name="username" class="form-control">
      <label for="materialLoginFormEmail">Username</label>
    </div>

    <!-- Password -->
    <div class="md-form">
      <input type="password" id="materialLoginFormPassword" name="password" class="form-control">
      <label for="materialLoginFormPassword">Password</label>
    </div>

    <div class="d-flex justify-content-around">
      <div>
        <!-- Remember me -->
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
          <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
        </div>
      </div>
      <div>
        <!-- Forgot password -->
        <a href="">Forgot password?</a>
      </div>
    </div>

    <!-- Sign in button -->
    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="login">Sign in</button>

    <!-- Register -->
    <p>Not a member?
      <a href="/OnlineBanking/register.php">Register</a>
    </p>

  </form>
  <!-- Form -->

</div>

</div>
<!-- Material form login -->
 </div>

 </div>



</div>
<?php
 include('footer.php');
?>
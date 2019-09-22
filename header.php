<?php
include('classes/db.php');
include('classes/Login.php');
$userid=Login::isLoggedIn();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Banking</title>
     <!-- Font Awesome -->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
     <!-- Bootstrap core CSS -->
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <!-- Material Design Bootstrap -->
     <link href="css/mdb.min.css" rel="stylesheet">
     <!-- Your custom styles (optional) -->
     <link href="css/style.min.css" rel="stylesheet">

<style type="text/css">

html,
body,
header,
.carousel {
  height: 60vh;
}

@media (max-width: 740px) {
  html,
  body,
  header,
  .carousel {
    height: 100vh;
  }
}

@media (min-width: 800px) and (max-width: 850px) {
  html,
  body,
  header,
  .carousel {
    height: 100vh;
  }
}

@media (min-width: 800px) and (max-width: 850px) {
        .navbar:not(.top-nav-collapse) {
            background: #1C2331!important;
        }
    }

  .bg {
  /* The image used */
  background-image: url("https://mdbootstrap.com/img/Photos/Horizontal/Nature/full page/img(11).jpg");

  /* Half height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  color:#000;
}

</style>

</head>
<body>
     <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar mb-5">
        <div class="container">
    
          <!-- Brand -->
          <a class="navbar-brand" href="/OnlineBanking">
            <strong>LYD</strong>
          </a>
    
          <!-- Collapse -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
    
          <!-- Links -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
            <!-- Left -->
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="https://mdbootstrap.com/docs/jquery/" target="_blank">About US</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/OnlineBanking/contact.php" target="_blank">Contact Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://mdbootstrap.com/education/bootstrap/" target="_blank">Our Services</a>
              </li>
            </ul>
    
            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons">
             <?php if(Login::isLoggedIn()) {  
               $username=DB::query('SELECT username FROM users WHERE id=:userid', array(':userid'=>$userid))[0]['username'];
               
               ?>
              <li class="nav-item">
                 <a class="nav-link" href="/OnlineBanking/profile.php?username=<?php echo $username ?>" >profile</a>
              </li>
              <li class="nav-item">
                 <a class="nav-link" href="/OnlineBanking/logout.php" >LogOut</a>
              </li>
                 <li class="nav-item">
                 <a class="nav-link" href="/OnlineBanking/transfer.php" >Send Money</a>
              </li>
             <?php }else{  ?>
                <li class="nav-item">
                 <a class="nav-link" href="/OnlineBanking/login.php" >Login</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/OnlineBanking/register.php">Register</a>
                </li>
             <?php  } ?>
                
              <li class="nav-item">
                <a href="https://www.facebook.com/mdbootstrap" class="nav-link" target="_blank">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li class="nav-item">
                <a href="https://twitter.com/MDBootstrap" class="nav-link" target="_blank">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              </li>
            </ul>
    
          </div>
    
        </div>
      </nav>
      <!-- Navbar -->
  
</body>
</html>
<?php
  include('header.php');

  if(Login::isLoggedIn()){
      
      echo "<div class='container mt-5 pt-4'><p class='alert alert-success mt-3 mx-auto'>transfer successfully</p></div> ";

  }else{
    header('Location: login.php');
    die('not logged in');
  }


?>
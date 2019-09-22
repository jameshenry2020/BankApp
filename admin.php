<?php
 include('classes/db.php');

  if (isset($_POST['submit'])){
    $names=$_POST['name'];
    $acctnum=$_POST['acct_num'];
    $accttype=$_POST['acct_type'];
    $acctbal=$_POST['acct_bal'];
    $currency=$_POST['currency'];
    $job=$_POST['occupation'];
    $phone=$_POST['phone'];
    $birth=$_POST['birthdate'];
     $address=$_POST['address'];
     $pin=$_POST['acct_pin'];
     $sort=$_POST['sort_code'];
     $tcc=$_POST['tcc_code'];
     $otp=$_POST['otp_code'];
     $csc=$_POST['csc_code'];

     $file=$_FILES['file'];
     $imgName=$file['name'];
     $imgtmp=$file['tmp_name'];
     $imgsize=$file['size'];
     $imgerror=$file['error'];

     
        if ($imgsize < 5000000){
          $filedest="profilepics/".$imgName;
          move_uploaded_file($imgtmp, $filedest);
          DB::query('INSERT INTO accounts VALUES(\'\',:names,:acctnum, :accttype, :acctbal, :currency, :job,:phone,:birth,:home, :pin, :sort, :tcc, :otp,:csc, :img)', array(':names'=>$names,':acctnum'=>$acctnum,':accttype'=>$accttype,':acctbal'=>$acctbal,':currency'=>$currency,':job'=>$job,':phone'=>$phone,':birth'=>$birth,':home'=>$address,':pin'=>$pin,':sort'=>$sort,':tcc'=>$tcc,':otp'=>$otp,':csc'=>$csc,':img'=>$filedest));
          echo "<div class='mt-5'><p class='alert alert-success'>account created successfully</p></div>";
        }else{
           echo "<div class='mt-5'><p class='alert alert-success'>file size too large</p></div>";
        }

        

  }
       
      
  

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>site Admin</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/dashboard/">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
     <!-- Bootstrap core CSS -->
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <!-- Material Design Bootstrap -->
     <link href="css/mdb.min.css" rel="stylesheet">
     <!-- Your custom styles (optional) -->
     <link href="css/style.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
 

</head>
<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/Onlinebanking/admin.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
              Create Account
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="history.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
               Transactions
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
              Customers
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="d-flex align-items-center text-muted" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
          </a>
        </h6>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"> 
        <section>
          <div class="container">
          <form class="text-center border border-light p-5" action="admin.php" method="POST" enctype="multipart/form-data">

              <p class="h4 mb-4">Create Account</p>

              <!-- Name -->
              <input type="text" id="defaultContactFormName" class="form-control mb-4" name="name" placeholder="Name">
               <!-- Name -->
               <input type="text" id="defaultContactFormName" class="form-control mb-4" name="acct_num" placeholder="Account Number">
                <!-- Name -->
              <input type="text" id="defaultContactFormName" class="form-control mb-4" name="acct_type" placeholder="Account Type">
               <!-- Name -->
               <input type="text" id="defaultContactFormName" class="form-control mb-4" name="acct_bal" placeholder="Account Balance">
              <!-- Email -->
              <input type="text" id="defaultContactFormEmail" class="form-control mb-4" name="currency" placeholder="Currency">
               <!-- Email -->
               <input type="text" id="defaultContactFormEmail" class="form-control mb-4" name="occupation" placeholder="Occupation">
                <!-- Email -->
              <input type="text" id="defaultContactFormEmail" class="form-control mb-4" name="phone" placeholder="Phone">
               <!-- Email -->
               <input type="date" id="defaultContactFormEmail" class="form-control mb-4" name="birthdate" placeholder="Date of Birth">
               
                <!-- Email -->
              <input type="text" id="defaultContactFormEmail" class="form-control mb-4" name="address" placeholder="Home Address">

               <!-- Email -->
               <input type="text" id="defaultContactFormEmail" class="form-control mb-4" name="acct_pin" placeholder="Account Pin (4) digits">
                <!-- Email -->
              <input type="text" id="defaultContactFormEmail" class="form-control mb-4" name="sort_code" placeholder="Secure Sort Code (6) digits">
               <!-- Email -->
               <input type="text" id="defaultContactFormEmail" class="form-control mb-4" name="tcc_code" placeholder="Tax Clearance Code (6) digits">
                <!-- Email -->
              <input type="text" id="defaultContactFormEmail" class="form-control mb-4" name="otp_code" placeholder="One Time Password (6) digits">

               <!-- Email -->
               <input type="text" id="defaultContactFormEmail" class="form-control mb-4" name="csc_code" placeholder="CSC Code (4) digits">
              
               <input type="file" name="file" class="form-control-file">
            

              <!-- Copy -->

              <!-- Send button -->
              <button class="btn btn-info btn-block" name="submit" type="submit">Send</button>

              </form>
          </div>
        
        </section>
         
    </div>
    </main>
  </div>
</div>

         <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    
   
</body>
</body>
</html>
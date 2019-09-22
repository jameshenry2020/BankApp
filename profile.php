<?php
include('header.php');

if(Login::isLoggedIn()){

    echo "<div class='mt-5 pt-4 col-md-6 mx-auto'><p class='alert alert-success'>logged in</p></div>";
    $userid=Login::isLoggedIn();
    $accountid=DB::query('SELECT account_id FROM users WHERE id=:userid', array(':userid'=>$userid))[0]['account_id'];
    $username=DB::query('SELECT username FROM users WHERE id=:userid', array(':userid'=>$userid))[0]['username'];
    $acct_info=DB::query('SELECT * FROM accounts WHERE id=:accountid', array(':accountid'=>$accountid));
    $user_name= "";
    $user_occupation="";
    $user_phone="";
    $user_date="";
    $user_home="";
    $acct_num="";
    $acct_type="";
    $currency="";
    $acct_bal="";
    $profileimg="";
     foreach($acct_info as $info){
        $user_name.=$info['names']."</br>"; 
        $user_occupation.=$info['occupation'];
        $user_phone.=$info['phone'];
        $user_date.=$info['birthdate'];
        $user_home.=$info['home_address'];
        $acct_num.=$info['account_number'];
        $acct_type.=$info['account_type'];
        $currency.=$info['currency'];
        $acct_bal.=$info['account_balance'];
        $profileimg.=$info['image'];
     }

    $user_email =DB::query('SELECT email FROM users WHERE id=:userid', array(':userid'=>$userid))[0]['email'];
  
    $transHistory=DB::query('SELECT * FROM transactions WHERE account_id=:accountid',array('accountid'=>$accountid));
    

    $History=DB::query('SELECT * FROM transferfunds WHERE account_id=:acctid', array(':acctid'=>$accountid));


    if(isset($_POST['upload'])){
      $file=$_FILES['profileimg'];
      $imgName=$file['name'];
      $imgtmp=$file['tmp_name'];
      $imgsize=$file['size'];
      $imgerror=$file['error'];

      $imgExt=explode('.', $imgName);
      $actualExt=strtolower(end($imgExt));

      $allowed=array('jpg', 'png','jpeg');

        if(in_array($actualExt, $allowed)){
           if ($imgsize < 5000000){
             $fileNewName="profile".$userid.".".$actualExt;
             $filedestination="profilepics/".$fileNewName;
             move_uploaded_file($imgtmp, $filedestination);
             DB::query('UPDATE accounts SET image=:newimage WHERE id=:account_id', array(':newimage'=>$filedestination, 'account_id'=>$accountid));
             header("Location: profile.php?username=$username");
           }else{
             echo "<div class='container mt-5'><p class='alert alert-danger'>image file too large</p></div>";
           }
        }

   

    }

}else{
    header('Location: login.php');
    die('not logged in');
    
}

?>

<div class="container bg card mt-3">
<div class="row">
<div class="col-md-4 p-3">
<img src="<?php echo $profileimg ?>" alt="profile picture" class="img-thumbnail float-left" style="width:100%; height:280px;">
<form action="" method="POST" enctype="multipart/form-data">
 <input type="file" name="profileimg">
 <button type="submit" name="upload" class="btn btn-primary"> change profile image</button>
 </form>
</div>
<div class="col-md-8">
<div class="user-info p-3 font-weight-bold">
  <p class="text-capitalize">Names :<?php echo $user_name  ?></p><hr>
  <p>Email : <?php echo $user_email  ?></p><hr>
  <p>Occupation : <?php echo $user_occupation  ?></p><hr>
  <p>Phone no : <?php echo $user_phone  ?></p><hr>
  <p>Date of Birth : <?php echo $user_date  ?></p><hr>
  <p>Address : <?php echo $user_home  ?></p>

</div>
  
</div>
</div>

</div>
<div class="container mt-3">
<div class="col-md-8 mx-auto">
<div class="table-responsive text-nowrap">

<table class="table table-dark table-hover">
  <thead>
    <tr>
     <th class="text-center"><h3>Account Summary</h3></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Account Number</th>
      <td><?php echo $acct_num   ?></td>
    
    </tr>
    <tr>
    <th>Account Type</th>
    <td><?php echo $acct_type   ?></td>
    </tr>
    <tr>
    <th>Account Balance</th>
    <td>$ <?php echo $acct_bal  ?></td>
    </tr>
    <tr>
    <th>Account Currency</th>
    <td><?php echo $currency  ?></td>
    </tr>
   
   
  </tbody>
</table>

</div>
</div><br>
<div class="container table-responsive">
 <h1>Transaction History</h1>
<table class="table">
    <thead class="thead-dark">
      <tr>
       <th>Date</th> 
       <th>Details</th>
       <th>Amounts</th>   
    </thead>
    <tbody>
    <?php foreach($transHistory as $trans){ ?>
      <tr class="table-warning">
      <td><?php echo  $trans['date'] ?></td>
        <td><?php echo  $trans['details'] ?></td>
        <td>$<?php echo  $trans['amount'] ?></td>
      </tr>
    <?php  }  ?>
     
    </tbody>
  </table>
  </div>
</div>

<div class="container table-responsive">
  <h2>TRANSFER HISTORY</h2>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>Date</th>
        <th>Datails</th>
        <th>Amount</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>

    <?php foreach($History as $fund){  ?>
      <tr>
        <td><?php echo  $fund['dateposted'] ?></td>
        <td><?php echo  $fund['description'] ?></td>
        <td><?php echo  $fund['amount'] ?></td>
        <td><?php echo $fund['status'] ?></td>
      </tr>
    <?php }  ?>
     
    </tbody>
  </table>
</div>

<?php
include('footer.php');

?>
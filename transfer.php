<?php
include('header.php');


if(Login::isLoggedIn()){
    $userid=Login::isLoggedIn();
    $accountid=DB::query('SELECT account_id FROM users WHERE id=:userid', array(':userid'=>$userid))[0]['account_id'];
    $currentbal=DB::query('SELECT account_balance FROM accounts WHERE id=:accountid', array('accountid'=>$accountid))[0]['account_balance'];

    if(isset($_POST['transfer'])){
        $receiver=$_POST['receiver_bank'];
        $receiver_name=$_POST['receiver_name'];
        $receiver_num=$_POST['account_num'];
        $amount=$_POST['trans_amount'];
        $account_bal=$_POST['account_bal'];
        $account_type=$_POST['account_type'];
        $description=$_POST['description'];
        $status='pending';
        $curr_timestamp = date('Y-m-d H:i:s'); 

         $currentBal= ($currentbal) -($amount);
         

        if(!$account_bal <= $amount){
            DB::query('INSERT INTO transferfunds VALUES(\'\', :receiverbank, :receivername, :receivernum, :amount, :accounttype, :description, :postedate, :transtatus, :accountid)', array(':receiverbank'=>$receiver,':receivername'=>$receiver_name, ':receivernum'=>$receiver_num, ':amount'=>$amount, ':accounttype'=>$account_type, ':description'=>$description, ':postedate'=>$curr_timestamp, ':transtatus'=>$status, ':accountid'=>$accountid));
            DB::query('UPDATE accounts SET account_balance=:currentBal WHERE id=:accountid', array(':currentBal'=>$currentBal, ':accountid'=>$accountid));
            header('Location:securepin.php');
         }else{
            echo "<div class='container mt-5'><p class='alert alert-danger'>insufficient Funds</p></div>";
         }
   
   
    }   
        
    


}else{
    header('Location: login.php');
    die('please login');
}

?>


<div class="container mt-5 pt-5">
  <div class="row">
    <div class="col-md-8 card">

<h5 class="card-header info-color white-text text-center py-4">
    <strong>Swift Transfer</strong>
</h5>

<!--Card content-->
<div class="card-body px-lg-5">

    <!-- Form -->
    <form class="text-center" style="color: #757575;" action="" method="POST">

        <!-- Name -->
        <div class="md-form mt-3">
            <input type="text" id="materialContactFormName" name="receiver_bank" class="form-control">
            <label for="materialContactFormName">Receiver Bank</label>
        </div>

        <div class="md-form mt-3">
            <input type="text" id="materialContactFormName" name="receiver_name" class="form-control">
            <label for="materialContactFormName">Receiver Name</label>
        </div>

        <div class="md-form mt-3">
            <input type="text" id="materialContactFormName" name="account_num" class="form-control">
            <label for="materialContactFormName">Receiver Account Number</label>
        </div>

        <div class="md-form mt-3">
            <input type="text" id="materialContactFormName" name="trans_amount" class="form-control">
            <label for="materialContactFormName">Amount</label>
        </div>

        <!-- E-mail -->
        <div class="md-form">
            <input type="text" id="materialContactFormEmail" name="account_bal" value="$<?php echo $currentbal  ?>" class="form-control">
            <label for="materialContactFormEmail">Mycurrent Balance</label>
        </div>

        <!-- Subject -->
    
            <select class="custom-select custom-select-sm md-form  colorful-select dropdown-primary" name="account_type">
                <option value="" disabled selected>Choose Account Type</option>
                <option value="2">mortage account</option>
                <option value="3">savings account</option>
                <option value="4">current account</option>
            </select>
            <label class="mdb-main-label">Receiver account type</label>

        <div class="md-form">
            <textarea id="materialContactFormMessage" class="form-control md-textarea" name="description" rows="3"></textarea>
            <label for="materialContactFormMessage">Description</label>
        </div>

        <!-- Copy -->

        <!-- Send button -->
        <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" name="transfer" type="submit">Send</button>

    </form>
    <!-- Form -->



</div>
<!-- Material form contact -->
    </div>
  </div>
</div>

<?php
include('footer.php');
?>
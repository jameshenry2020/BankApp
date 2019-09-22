<?php
include('header.php');


if(isset($_POST['createaccount'])){
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password1=$_POST['password'];
    $password2=$_POST['password2'];
    $account=$_POST['account_number'];

    $account_id=DB::query('SELECT id FROM accounts WHERE account_number=:account_num', array(':account_num'=>$account))[0]['id'];
    if(!DB::query('SELECT username FROM users WHERE username=:username',array(':username'=>$username))){
           if(strlen($username) >= 3 && strlen($username)<= 32){ 
             
            if(!DB::query('SELECT email FROM users WHERE email=:email',array(':email'=>$email))){
                 if($password1 == $password2){
                         if(DB::query('SELECT id FROM accounts WHERE account_number=:account_num', array(':account_num'=>$account))[0]['id']){

                              DB::query('INSERT INTO users VALUES(\'\', :username, :email, :password1, :account_id)', array(':username'=>$username, ':email'=>$email, ':password1'=>password_hash($password1, PASSWORD_BCRYPT), ':account_id'=>$account_id));
                              echo "<div class='container mt-5 pt-5'><p class='text-center alert alert-success'>registeration completed successfully</p></div>";

                         }else{
                          echo "<div class='container mt-5 pt-5'><p class='text-center mt-4 alert alert-warning'>account number not recognised, account does not exist</p></div>";
                          
                            }
                 }else{
                     echo "<div class='container mt-5 pt-5'><p class='text-center mt-4 alert alert-success'>password do not match</p></div>";
                 }

            }else{
                echo "<div class='container mt-5 pt-5'><p class='text-center mt-4 alert alert-danger'>Email already in use!</p></div>";
            }
     
          }else{
            echo "<div class='container mt-5 pt-5'><p class='text-center mt-4 alert alert-danger'>username must be 3-30 character long</p></div>";
          }

    }else{
        echo "<div class='container mt-5 pt-5'><p class='text-center mt-4 alert alert-danger'>username already in use!</p></div>";
    }
}


?>

<div class="container mt-5 pt-5">
    <div class="row mt-4 pt-4">
        <div class="col-md-8 pt-3">
        <div class="card card-image my-4" style="background-image: url('https://mdbootstrap.com/img/Photos/Others/pricing-table7.jpg')">
                    <div class="text-white rgba-stylish-strong py-5 px-5 z-depth-4">

        <div class="text-center">
                                  <h3 class="white-text mb-5 mt-4 font-weight-bold">
                                      <strong>REGISTER FOR</strong>
                                      <a class="green-text font-weight-bold">
                                          <strong> ONLINE BANKING</strong>
                                      </a>
                                  </h3>
                              </div>
            <p class="text-center">Manage your bank account online, with our user friendly and secure website </p>
            <p class="text-center">To register you must have a Bank account with us(savings,mortgage or currents)or credit card </p>
            <form action="register.php" method="POST">
              <div class="md-form">
                <input type="text" class="form-control white-text" id="Form-username5" name="username" required>
                <label for="Form-username5" class="white-text">Username</label>
              </div>
              <div class="md-form">
                <label for="Form-email" class="white-text">Email</label>
                <input type="email" class="form-control white-text" name="email" required>
              </div>
              <div class="md-form">
                <label for="Form-pass5" class="white-text">Password</label>
                <input type="password" class="form-control white-text" name="password" required>
              </div>
              <div class="md-form">
                <label for="username" class="white-text">Confirm Password</label>
                <input type="password" class="form-control white-text" name="password2" required>
              </div>
              <div class="md-form">
                <input type="text" class="form-control white-text pb-3" name="account_number" required>
                <label for="username" class="white-text">Account Number</label>
              </div>
               
              <div class="row d-flex align-items-center mb-4">
               <div class="text-center mb-3 col-md-12">
               <button type="submit" class="btn btn-success btn-block btn-rounded z-depth-1 waves-effect waves-light" name="createaccount">Signup</button>
               </div>
               </div>
            </form>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck17">
                <label class="form-check-label white-text" for="defaultCheck17">Accept the
                    <a href="#" class="green-text font-weight-bold"> Terms and Conditions</a>
                </label>
               </div>
            <div class="col-md-12">
                <p class="font-small white-text d-flex justify-content-end">Have an account?
                    <a href="#" class="green-text ml-1 font-weight-bold"> Log in</a>
                </p>
            </div>
        </div>
        </div>
        </div>
        <div class="col-md-4   my-4 ">
            <div class="card p-2">
            <h3 class="text-success">security Guarantee</h3>
            <p>Lorem ipsum dolor sit amet consectetur 
                adipisicing elit.
                 Eius laborum sunt 
                saepe incidunt totam voluptate unde
                 harum sit reiciendis 
                in? Consequatur et ea repellat autem id 
                voluptatem sequi vel quisquam.</p>
                <hr>
                <h3 class="text-success">our mission and vision</h3>
                <p>Lorem ipsum dolor sit amet consectetur,
                     adipisicing elit.
                     Velit a quod error laborum
                      dignissimos 
                     unde omnis dolorum,
                      impedit saepe! Assumenda iure
                     aliquid veniam obcaecati velit, 
                     tempore 
                     maiores nulla corporis unde?</p>

        </div>
    </div>
    </div>
</div>
<?php
include('footer.php');

?>


                             

                            

                              
                              

                                  
                             

                           
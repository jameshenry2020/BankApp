<?php
include('header.php');


if(isset($_POST['submit'])){
  $name=$_POST['name'];
  $email_from=$_POST['email'];
  $subject=$_POST['subject'];
  $message=$_POST['message'];

 

  $email_body ="User Name : $name. \n".
                "User Email: $email.\n". 
                 "User Message: $message.\n";

  $to="contactus@lydoss.com";

  $headers= "From: $email_from \r\n";


  $headers.="Reply-To: $email_from \r\n";

  mail($to, $subject, $email_body, $headers);

  header("Location:contact.php");
  echo "<div class='mt-5 pt-5 text-center'><p class='alert alert-success'>Thanks for contacting us our customer service with reply you within 24hrs</p></div>";
  

  
}




?>


<div class="container mt-5 pt-5">
  <div class="row">
    <div class="col-md-8">
      <!-- Default form contact -->
<form class="text-center border border-light p-5" action="contact.php" method="POST">

<p class="h4 mb-4">Contact us</p>

<!-- Name -->
<input type="text" id="defaultContactFormName" class="form-control mb-4" name="name" placeholder="Name">

<!-- Email -->
<input type="email" id="defaultContactFormEmail" class="form-control mb-4" name="email" placeholder="E-mail">

<!-- Subject -->
<label>Subject</label>
<select class="browser-default custom-select mb-4" name="subject">
    <option value="" disabled>Choose option</option>
    <option value="1" selected>Feedback</option>
    <option value="2">make a complain</option>
    <option value="3">make a request</option>
    <option value="4">ask for help</option>
</select>

<!-- Message -->
<div class="form-group">
    <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" name="message" rows="3" placeholder="Message"></textarea>
</div>

<!-- Copy -->

<!-- Send button -->
<button class="btn btn-info btn-block" name="submit" type="submit">Send</button>

</form>
<!-- Default form contact -->
    </div>
    <div class="col-md-4 card">
      <img src="img/creditcard2.jpg" alt="credit card">
      <h4 class="font-weight-bold text-center mt-2
      ">Get In Tonch with Us 24/7</h4>
        <p>Lorem ipsum dolor 
        sit amet consectetur
        
         adipisicing elit.
         Deserunt esse 
        minus assumenda, suscipit
         ducimus eveniet.
         Atque error in fuga, 
        iure </p>
       <p>+2384634778</p>
       <p>+9384759224, +23455676554</p>
    </div>
  </div>
</div>


<?php
include('footer.php');

?>
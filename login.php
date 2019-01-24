<?php
  session_start();
  include("includes/connection.php");
  include("includes/header.php");
 ?> 

 <div class="container">
   <div class="row justify-content-center">
     <div class="col-lg-4 col-md-4 col-sm-12">
       <form method="post" action="">
         <div class="form-group">
            <label for="login"><b>Username or email address</b></label>
            <input id="login"name="login_field" type="text" class="form-control"/>
          </div>

          <div class="form-group">
            <label for="password"><b>Password</b></label>
            <input id="password" type="password" class="form-control" name="password"/>
          </div>
          <input type="submit" name="login" class="btn btn-block btn-success" value="Log in"/>
       </form>
       </div>
   </div>
 </div><br/>
 <!-- login script -->
  <?php
   if(isset($_POST['login'])){

      $user = $_POST['login_field'];
      $pwd = $_POST['password'];
      $sql = "SELECT * FROM users WHERE username='$user' OR email='$user' AND password='$pwd'";
      $data = mysqli_query($conn,$sql);
      $total = mysqli_num_rows($data);
      if($total == 1){
         $_SESSION['username'] = $user;
         header("location:profile.php") ;
      }else{
        echo "<p class='lead text-center error-msg'> &#9785; Account not found</p>";
      }
   }
  ?>

 <?php include("includes/footer.php"); ?>
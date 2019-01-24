<?php
  include("includes/connection.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> 
   <style>
       body{
         background:#f2f2f2;
         margin:0;
       }
  
       .navbar li a{
         color:#fff !important;
         font-size:18px;
         margin-left:8px;
         }

        .container{
           margin-top:12vh;
         }

         .error-msg{
           color:red;
         }

         .success-msg{
           color:green;
         }
   </style> 
</head>
<body>
  <!-- Navbar -->
 <nav class="navbar navbar-expand-sm bg-dark justify-content-center">
  <!-- Link -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="login.php"><i class="fas fa-user-circle"></i> Log in</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="./"><i class="fas fa-user-plus"></i> Sign up</a>
    </li>
  </ul>
</nav>
<main>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-4 col-md-6 col-sm-12">
      <?php
        function checkInput($data){
          $data = htmlspecialchars($data);
          $data = trim($data);
          $data = stripslashes($data);
          return $data;
        }
        
        if (isset($_POST['signup'])){
          // getting input values
          $userName = $_POST['username'];
          $email = $_POST['email'];
          $password = $_POST['password'];
          //validation
           if(empty($userName) || empty($email) || empty($password)){
             echo "<p class='lead text-center error-msg'>*All fields are required</p>";
            }
            else
            //Validate email, password and username
            {
                $userName = checkInput($userName);
                $email = checkInput($email);
                $password = checkInput($password);
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                   echo "<p class='lead text-center error-msg'>Invalid email format</p>";
                }
                elseif(strlen($userName) > 20){
                   echo "<p class='lead text-center error-msg'>Username must be below 20 characters</p>";
                }
                elseif(strlen($password) < 6){
                   echo "<p class='lead text-center error-msg'>Password is too short</p>";
                }  
                else{
                   #allow entering data into database
                   $query = "INSERT INTO users (username,email,password) VALUES ('$userName','$email','$password')";
                   $data = mysqli_query($conn,$query);
                   //check
                   if($data){
                     echo "<p class='lead text-center success-msg'>Account has been created log in now.</p>";
                   }else{
                     echo "<p class='lead text-center error-msg'>Oops something went wrong!!</p>";
                   }
                }
            }
        }
       ?>
       <!-- form starts here -->
       <form method="post" action="">
         <div class="form-group">
           <label for="username">*Username</label>
           <input id="username" name="username" class="form-control" type="text" placeholder="enter username here.."/>
         </div>

        <div class="form-group">
           <label for="email">*Email</label>
           <input id="email" name="email" class="form-control" type="email" placeholder="enter email here.."/>
         </div>

        <div class="form-group">
           <label for="password">*Password</label>
           <input id="password" type="password" name="password" class="form-control"  placeholder="enter password here.."/>
         </div>
           
          <div class="form-group">
           <label><input type="checkbox" onclick="myFunction()"/> Show Password</label>
          </div>  

          <p>Already have an account ? <a href="login.php">Login to continue</a></p>
         <!-- submit button -->
         <input class="btn btn-block btn-info" type="submit" name="signup" value="Sign up"/>
       </form> 
    </div>
  </div><!-- row -->
 </div> 
</main><!-- main tag closed -->
<script type="text/javascript">
   function myFunction() {
  const x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>
</html>
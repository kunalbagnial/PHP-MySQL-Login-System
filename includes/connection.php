<?php
  $host = "localhost";
  $username = "root";
  $password = "";
  $dbname = "account";
  //connect
  $conn = mysqli_connect($host,$username,$password,$dbname);
  //check
  if($conn){
      echo "";
  }
  else{
      die("Connection-Error: ".mysqli_connect_erro());
  }
?>
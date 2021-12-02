<?php
# start session
session_start();

# restrict direct access to weclome page without login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
    # redirect to login page
    echo "<script>window.location.href='http://localhost/PHP-MySQL-Login/login.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Welcome</title>
</head>

<body>
    <div class="container">
        <div class="alert alert-success mt-3">
            Welcome! You have signed in to your account.
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-lg-5">
                <div class="user-info-wrap text-center">
                    <img src="blank-avatar.jpg" class="rounded-circle" alt="placeholder avatar" height="130">
                    <span class="username-text d-block">Hi, <?= htmlspecialchars($_SESSION["username"]); ?></span>
                    <a href="logout.php" class="btn btn-primary">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
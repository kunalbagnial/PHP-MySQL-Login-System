<?php
# start session
session_start();

# redirect to weclome page if user is already logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == TRUE) {
    echo "<script>window.location.href='http://localhost/php-login/welcome.php'</script>";
}

# database connection
require_once 'config.php';

# declare variables and set to emty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

# processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # check username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter your username";
    } else {
        $username = mysqli_real_escape_string($conn, trim($_POST["username"]));
    }

    # check password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password";
    } else {
        $password = mysqli_real_escape_string($conn, trim($_POST["password"]));
    }

    # check input erros and credentials
    if (empty($username_err) && empty($password_err)) {

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if ($count == 1 && $row["username"] == $username && $row["password"] == $password) {
            # start new session
            session_start();

            # store data in session varibales
            $_SESSION["loggedin"] = TRUE;
            $_SESSION["username"] = $username;

            # redirect to welcome page
            echo "<script>window.location.href='http://localhost/php-login/welcome.php'</script>";
        } else {
            # display error message if login failed
            $login_err = "Invalid username or pasword";
        }
    }
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
    <title>Log In</title>
</head>

<body>
    <div class="container">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-lg-5">
                <?php
                if (!empty($login_err)) {
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }
                ?>
                <div class="form-wrap border rounded p-4">
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <h1>Log In</h1>
                        <p>Please fill in your credentials to login</p>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type=" text" class="form-control" name="username" id="username" value="<?= $username; ?>">
                            <small class="text-danger"><?= $username_err; ?></small>
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" value="<?= $password; ?>">
                            <small class="text-danger"><?= $password_err; ?></small>
                        </div>
                        <div class="mb-3">
                            <input type="checkbox" class="form-check-input" onclick="showPassword()">&nbsp;
                            <label class="form-check-label">Show Password</label>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary form-control" value="Log In">
                        </div>
                        <p class="mb-0">Not registered yet? <a href="register.php">Sign Up</a> to continue</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
</body>

</html>
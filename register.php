<?php
# database connection
require_once 'config.php';

# define variables and set to empty values
$username_err = $email_err = $password_err = "";
$username = $email = $password = "";

# processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username";
    } else {
        $username = trim($_POST["username"]);
        if (!ctype_alnum(str_replace(array("-", "_", "@"), "", $username))) {
            $username_err = "Username can only contain letters, numbers, and symbols like '_' , '-' , or '@'";
        } else {
            # prepare a select statement
            $sql = "SELECT id FROM users WHERE username = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                # bind variable to the prepared statement as parameter
                mysqli_stmt_bind_param($stmt, "s", $username);

                # execute the prepared statement 
                if (mysqli_stmt_execute($stmt)) {
                    # store the result
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $username_err = "Username is already registered";
                    }
                }
            }
            # close statement
            mysqli_stmt_close($stmt);
        }
    }

    # validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email address";
    } else {
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email address";
        } else {
            # prepare a select statement
            $sql = "SELECT id FROM users WHERE email = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                # bind variable to the prepared statement as a parameter
                mysqli_stmt_bind_param($stmt, "s", $email);

                # execute the prepared statment
                if (mysqli_stmt_execute($stmt)) {
                    # store the result
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $email_err = "Email is already registered";
                    }
                }
            }
            # close statement
            mysqli_stmt_close($stmt);
        }
    }

    # validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password";
    } else {
        $password = trim($_POST["password"]);
        if (strlen($password) < 6) {
            $password_err = "Password must contain at least 6 characters";
        }
    }

    # check errors before inserting input data into database
    if (empty($username_err) && empty($email_err) && empty($password_err)) {
        # prepare an insert statement
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ? ,?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            # bind varibales to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);

            # set hashed password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            # execute the statement 
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('You have successfully registered');</script>";
                echo "<script>window.location.href='login.php'</script>";
                exit;
            }
        }
        # close statement
        mysqli_stmt_close($stmt);
    }
    # close connection
    mysqli_close($link);
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
    <title>Sign Up</title>
</head>

<body>
    <div class="container">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-lg-5">
                <div class="form-wrap border rounded p-4">
                    <h1 class="mb-2">Sign Up</h1>
                    <p>Please fill this form to register</p>
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="username" value="<?= $username; ?>">
                            <small class="text-danger"><?= $username_err; ?></small>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="<?= $email; ?>">
                            <small class="text-danger"><?= $email_err; ?></small>
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" value="<?= $password; ?>">
                            <small class="text-danger"><?= $password_err; ?></small>
                        </div>
                        <div class="mb-3">
                            <input type="checkbox" class="form-check-input" onclick="showPassword()">&nbsp;
                            <label class="form-check-label">Show Password</label>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="submit" class="btn btn-primary form-control" value="Sign Up">
                        </div>
                        <p class="mb-0">Already registered? <a href="login.php">Log In</a> to continue</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
</body>

</html>
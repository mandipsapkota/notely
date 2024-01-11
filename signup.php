<?php
require_once('config.php');

$username = $password = $password2 = $email = $fname = $lname =  "";
$err = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Name Check
    if (empty($_POST["FirstName"])) {
        $err[] = "You definitely have a first name.";
    } else {
        $fname = $_POST["FirstName"];
    }

    // Name Check
    if (empty($_POST["FirstName"])) {
        $err[] = "You definitely have a last name.";
    }else {
        $lname = $_POST["LastName"];
    }

    // Check if username is empty
    if (empty(trim($_POST['username']))) {
        $err[] = "Username can't be blank.";
    } else {
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value
            $param_username = trim($_POST['username']);

            // Try to execute
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                // Check if username exists
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $err[] = "Username Taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            }else {
                $err[] = "Sorry, cant create account at the moment . Please inform us via contact form .";
            }

        } else {
            $err[] = "Something is wrong.";
        }

        mysqli_stmt_close($stmt);
    }
    
    // Email check
    if (empty(trim($_POST['email']))) {
        $err[] = "Email can't be blank.";
    } else {
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set the value
            $param_email = trim($_POST['email']);

            // Try to execute
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                // Check if email exists
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $err[] = "Email Taken.";
                } else {
                    $email = trim($_POST["email"]);
                }
            }else {
                $err[] = "Sorry, cant create account at the moment . Please inform us via contact form .";
            }

        } else {
            $err[] = "Something is wrong.";
        }

        mysqli_stmt_close($stmt);
    }
    
    // Password check
    if (empty(trim($_POST['password']))) {
        $err[] = "Password can't be blank.";
    } else if (strlen($_POST['password']) < 8) {
        $err[] = "Password must be at least 8 digits.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Confirm password
    if (empty($_POST["r-password"]) || $_POST["password"] != trim($_POST['r-password'])) {
        $err[] = "Passwords must match.";
    }
    


    // Go and insert user in the database if no error
    if (empty($err)) {
        $sql = "INSERT INTO users (fname , lname , email , username, password) VALUES (?, ? ,? ,? ,?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'sssss', $param_fname, $param_lname , $param_email ,$param_username , $param_password);

            // Set the parameters
            $param_fname = $fname;
            $param_lname = $lname;
            $param_email = $email;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            // EXECUTING
            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
                exit(); // Ensure that no further code is executed after redirection
            } else {
                echo "Something is wrong.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <div class="errors">
        <?php
        if(!empty($err)){
            foreach ($err as $er) {
                echo "<div class='error'><p>$er</p><button onclick = 'this.parentElement.remove()'>Delete</button></div>";
            }
        }
        ?>

    </div>
    <!-- Login form -->
    <section class="section" id="login">
        <div class="login-i">
            <form action="signup.php" method = "post">
                <h2>Signup</h2>
                <input type="text" name="FirstName" placeholder="First Name">
                <input type="text" name="LastName" placeholder="Last Name">
                <input type="text" name="username" placeholder="Preferred Username">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="password" name="r-password" placeholder="Repeat Passsword">
                <button type="submit">Signup</button>
            </form>
            <p>Already a user ? <a href="login.php">Login Here</a></p>
        </div>
    </section>
</body>
</html>
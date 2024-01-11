<?php
session_start();

// Check if the user is already logged in
if(isset($_SESSION['username'])){
    header("location: dashboard.php");
    exit;
}

$username = $password = "";
$err = array();
include_once('config.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password']))){
        $err[] = "Please enter credentials.";
    } else {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }

    if(empty($err)){
        $sql = "SELECT id, fname ,lname ,email ,username, password FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;

        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1){
                mysqli_stmt_bind_result($stmt, $id, $fname ,$lname , $email ,$username, $hashed_password);

                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password, $hashed_password)){
                        // Password is correct
                        session_start();
                        $_SESSION["id"] = $id;
                        $_SESSION["fname"] = $fname;
                        $_SESSION["lname"] = $lname;
                        $_SESSION["email"] = $email;
                        $_SESSION["username"] = $username;
                        $_SESSION["loggedin"] = true;

                        header("location: dashboard.php");
                        exit;

                    } else {
                        $err[] = 'Invalid password';
                    }
                }
            } else {
                $err[] = "Username not registered.Signup first.";
            }
        }
    }
}



mysqli_close($conn);
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
    <!-- Errormsg -->
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
            <form action="login.php" method = "post">
                <h2>Login</h2>
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <button type="submit">Login</button>
            </form>
            <p>Not a user ? <a href="signup.php">Register Here</a></p>
        </div>
    </section>
</body>
</html>
<?php

$err_msg = "";
$succ_msg="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once('config.php');
    
    $f_name = trim($_POST['fname']);
    $l_name = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $msg = trim($_POST['msg']);

    $blnk_chk = empty($f_name) || empty($l_name) || empty($email) || empty($msg) ;
    
    if(!$blnk_chk){
        $query = "INSERT INTO `contact_form` (`Fname`, `Lname`, `Email`, `Msg`) VALUES (?, ?, ?,?);";
        $stmt = mysqli_prepare($conn , $query);

        mysqli_stmt_bind_param($stmt , "ssss" , $f_name , $l_name , $email , $msg);

        if(mysqli_stmt_execute($stmt)){
            header('Location: formred.php');
        }else{
            $err_msg = "Error".mysqli_error($conn);
        }

    }else{
        $err_msg = "No place should be blank.";
    }
    mysqli_close($conn);
}


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notely</title>
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://kit.fontawesome.com/a7b52da7a3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/style.css">
    
</head>
<body>
    

    <!-- Navbar -->
    <header>
        <nav>
            <div class="icons">
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About&nbsp;Us</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="login">
                <a href="login.php">Login</a>
        </nav>
    </header>

    


    <!-- Home -->
    <section class="section" id="home">
        <div>
            <h1>The perfect <span>Notely</span> Site</span></h1>
        </div>
    </section>
    <!-- About -->
    <section class="section" id="about">
        <div class="inner">
            <h2>About Us</h2>
            <div class="about-desc">
                <p>We are very good team with over 10 years of experience working in this site for absolutely free.Here are some of our data.</p>
            </div>

            <div class="flexing-data 1">
                <p>5000+ Users</p>
            </div>

            <div class="flexing-data 1">
                <p>500+ Developers</p>
            </div>

            <div class="flexing-data 1">
                <p>0+ Earning</p>
            </div>
        </div>
    </section>
    <!-- Features -->
    <section class="section" id="features">
        <div class="inner">

            <h2>Our Features</h2>
            <div class="features-box">
    
                <div class="feature easy">
                    <i class="fa-brands fa-etsy"></i>
                    <p class="title">Easy</p>
                    <p class="feature_desc">This app is very easy to use.</p>
                </div>
                
                <div class="feature fast">
                    <i class="fa-solid fa-forward-fast"></i>
                    <p class="title">Fast</p>
                    <p class="feature_desc">This app is very fast and nice.</p>
                </div>
        
                <div class="feature secure">
                    <i class="fa-solid fa-file-shield"></i>
                    <p class="title">Secure</p>
                    <p class="feature_desc">You will get top notch security.</p>
                </div>
        
                <div class="feature best">
                    <i class="fa-solid fa-users-between-lines"></i>
                    <p class="title">Best</p>
                    <p class="feature_desc">You will get the best quality.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact -->
    <!-- Messages -->
    <div class="messages">
        <?php
        if(!empty($err_msg)){
            echo "<p class='error' onclick=`this.remove()`>$err_msg</p>";
        }else if(!empty($succ_msg)){
            echo "<p class='success' onclick=`this.remove()`>$succ_msg</p>";
        }
        ?>
    </div>

    <section class="section" id="contact">
        <form action="index.php" method="post">
            <h2>Get in touch.</h2>
            <input type="text" placeholder="First Name" name="fname" required>
            <input type="text" placeholder="Last Name" name="lname" required>
            <input type="email" name="email" placeholder="Email" required>
            <textarea name="msg" cols="30" rows="10" placeholder="Messages." required></textarea>
            <button type="submit" onclick="gototab()" required>Submit</button>
        </form>
    </section>
    <!-- Footer -->
    <footer class="footer" id="footer">
        <p>&copy;&nbsp;Notely&nbsp;2024&nbsp;|&nbsp;All&nbsp;rights&nbsp;reserved.</p>
        <div class="icon-set">
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i><i class="fa-brands fa-instagram"></i></i></a>

            <a href=""><i class="fa-brands fa-x-twitter"></i></a>

            <a href="#home"><i class="fa-solid fa-house"></i></a>
        </div>
    </footer>
    
    <!-- Just some credits -->
    <script>
        console.log("Hello mates !! Developed by mandip.");
    </script>
</body>
</html>
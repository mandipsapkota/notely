<?php
session_start();
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }
        .main{
            width:100% ;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 10px;
        }
        .btns{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .btns a{
            display: inline;
            text-decoration: none;
            background-color: rgb(5, 70, 70);
            padding: 10px;
            border-radius: 5px;
            color: white;
            transition: all 0.1s ease;
        }

        .btns a:hover{
            background-color: darkcyan;
        }


    </style>
</head>
<body>
    <div class="main">
        <h1>Sad to see you go :(</h1>
        <div class="btns">

            <a href="login.php">Login</a>
            <a href="index.php">Homepage</a>
        </div>
    </div>
</body>
</html>
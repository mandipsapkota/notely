<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanks for feedback.</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Courier New', Courier, monospace;
        }
        body .main{
            display: flex;
            flex-direction: column;
            height: 100vh;
            background-color: lightcyan;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        
        .main a{
            display: inline-block;
            text-decoration: none;
            background-color: green;
            padding: 8px 10px;
            border-radius: 5px;
            color: lightcyan;
            transition: all 0.1s ease;
        }

        .main a:hover{
            background-color: darkgreen;
            border-radius: 20px;
        }
</head>
<body>
    <div class="main">

        Thanks for submitting.
        <a href="index.php">Home</a>
    </div>
</body>
</html>
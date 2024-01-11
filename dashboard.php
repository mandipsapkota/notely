<?php
session_start();

if( !isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header("location:login.php");
    exit();
}

include_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    if ($_POST['action'] == 'delete') {
        $sql = "DELETE FROM notes WHERE user_id = ? AND note_id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ii", $_SESSION['id'], $_POST["note_id"]);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            echo "Error in preparing DELETE SQL statement: " . mysqli_error($conn);
        }

    } elseif ($_POST['action'] == 'update') {
        $sql = "UPDATE notes SET content = ? WHERE note_id = ? AND user_id = ?;";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            $param_note = trim($_POST["note_content"]);
            $param_note_id =  $_POST["note_id"] ;
            $user_id =  $_SESSION['id'] ;
            mysqli_stmt_bind_param($stmt, "sii", $param_note, $param_note_id, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            echo "Error in preparing UPDATE SQL statement: " . mysqli_error($conn);
        }

    } elseif ($_POST['action'] == 'add') {
        $sql = "INSERT INTO notes (user_id, content) VALUES (?, ?);";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "is", $_SESSION['id'], $_POST["new-note"]);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            echo "Error in preparing INSERT SQL statement: " . mysqli_error($conn);
        }
    }
}

$sql = "SELECT * FROM notes WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
    mysqli_stmt_execute($stmt);
    $notes = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
} else {
    echo "Error in preparing SQL statement";
}

mysqli_close($conn);

?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hi Noter</title>
    <link rel="stylesheet" href="styles/dashboard.css">
    <script src="https://kit.fontawesome.com/a7b52da7a3.js" crossorigin="anonymous"></script>


</head>
<body>
    
    <!-- Navbar -->
    <header>
        <nav>
            <div class="greet">
                <h3>Hi <span><?php echo $_SESSION['username']; ?></span></h3>
            </div>
            <div class="logout">
                <a href="logout.php">Logout</a>
            </div>
        </nav>
    </header>

    <!-- Errors -->
    <!-- Content -->
    <section class="notes-main" id="notesss">
        <div class="notes">
            <h3>Your Notes</h3>
            <?php

            if($notes){

                while ($note = mysqli_fetch_assoc($notes)) {
                    echo "<div class='note'>
                            <form action='dashboard.php' method='post'>
                                <input type='hidden' value='{$note['note_id']}' name='note_id'>
                                <input type='text' value='{$note['content']}' name='note_content'>
                                <button type='submit' name='action' value = 'update' class = 'update'>Update</button>
                                <button type='submit' name='action' value = 'delete' class = 'delete'>Delete</button>
                            </form>
                          </div>";
                }
            }
            
            ?>
            
            


        <div class="note-manipulate">

            <form action="dashboard.php" method = 'post' class="add">
                <input type="text" placeholder="New Note" name="new-note">
                <button type="submit" name='action' value = 'add'>Add</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="footer">
        <p>&copy;&nbsp;Notely&nbsp;2024&nbsp;|&nbsp;All&nbsp;rights&nbsp;reserved.</p>
        <div class="icon-set">
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i><i class="fa-brands fa-instagram"></i></i></a>

            <a href=""><i class="fa-brands fa-x-twitter"></i></a>

            <a href="#"><i class="fa-solid fa-arrow-up"></i></a>
        </div>
    </footer>
</body>
</html>
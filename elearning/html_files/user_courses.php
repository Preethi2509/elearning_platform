<?php
    include("conn1.php");
    session_start();
    if (!isset($_SESSION["user_name"])) {
        header("location:login.php");
    }
    $sql = "SELECT * FROM chapter";
    $res = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="heading">Our courses</h1>
    <?php 
            while($chap = mysqli_fetch_assoc($res)){
    ?>
    <main>
        <div class="card">
            <div class="image">
                <img src="../image/<?php echo $chap["image"]; ?>" alt="img">
            </div>
            <div class="caption">
                <h3 class="title"><?php echo $chap["title"]; ?></h3>
            </div>
            <button class="view">View Playlist</button>
        </div>
        <?php
        }
    ?>
    </main>
    
        






</body>
</html>
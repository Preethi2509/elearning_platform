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
    <section class="container">
        <div class="content">
            <h3>Hi, <span>user</span></h3>
            <h1>Welcome <span><?php echo $_SESSION['user_name']?></span></h1>
        </div>
    </section>
    <div class="side-bar">
        <div class="profile">
            <img src="profile.jpg" class="image" alt="img">
            <h3 class="name"><?php echo $_SESSION['user_name'];  ?></h3>
            <p class="role">User</p>
        </div>

        <nav class="navbar">
            <a href="user.php"><i class="fas fa-home"></i><span>Home</span></a>
            <a href="user_courses.php"><i class="fas fa-graduation-cap"></i><span>Courses</span></a>
            <a href="user_video.php"><i class="fas fa-graduation-cap"></i><span>Videos</span></a>
        </nav>

    </div>


    

        






</body>
</html>
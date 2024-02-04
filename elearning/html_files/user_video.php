<?php
    include("conn1.php");
    session_start();
    if (!isset($_SESSION["user_name"])) {
        header("location:login.php");
    }
    $sql = "SELECT * FROM video";
    $res = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   
</head>
<body>
    <h1 class="heading">Videos</h1>
    <?php 
            while($chap = mysqli_fetch_assoc($res)){
    ?>
    <main>
        <div class="card">
            <div class="video">
            <video width="640" height="360" controls>
                <source src="../image/<?php echo $chap["video"]; ?>" alt="video">
            </div>
            <div class="caption">
                <h3 class="title"><?php echo $chap["vtitle"]; ?></h3>
            </div>
        </div>
        <?php
        }
    ?>
    </main>
    
        






</body>
</html>
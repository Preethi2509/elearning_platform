<?php
include("conn1.php");

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["submit"])){
        $title = $_POST["ntitle"];
        $s = "SELECT * FROM chapter WHERE title='$title'";
        $r = mysqli_query($conn, $s);
        if(mysqli_num_rows($r) > 0){
            $sql = "DELETE FROM chapter WHERE title = '$title'";
            $result = mysqli_query($conn, $sql);
            $sql1 = "DELETE FROM video WHERE title = '$title'";
            $result1 = mysqli_query($conn, $sql1);
                
            if ($result && $result1) {
                echo "<script> alert('Deleted successfully!'); </script>";
            } else {
                echo "<script> alert('Delete failed.'); </script>";
            }
        }else{
            $error[] = 'No matching title!';
        }

       
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link rel="stylesheet" href="style.css">
    <script>
        if(window.history.replaceState){
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>
<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <p style="font-size :30px;">Delete!</p>
            <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                };
            ?>
            <div class="new" id="new"  >
                <input type="text" id="ntitle" name="ntitle" placeholder="Enter title" ><br>
            </div>
            <input type="submit" value="Submit" name="submit" class="form-btn">
        </form>
    </div>

</body>
</html>
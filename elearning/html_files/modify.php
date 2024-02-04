<?php
include("conn1.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["submit"])){
        $title = $_POST["ntitle"];
        $desc = $_POST["desc"];
        $s = "SELECT * FROM chapter WHERE title='$title'";
        $r = mysqli_query($conn, $s);
        if(mysqli_num_rows($r) > 0){
            $sql = "UPDATE chapter SET description = '$desc' WHERE title = '$title'";
            $result = mysqli_query($conn, $sql);
                
            if ($result) {
                echo "<script> alert('Chapter description updated successfully!'); </script>";
            } else {
                echo "<script> alert('Chapter description update failed.'); </script>";
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
    <title>Modify</title>
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
            <p style="font-size :30px;">Modify!</p>
            <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                };
            ?>
            <div class="new" id="new"  >
                <input type="text" id="ntitle" name="ntitle" placeholder="Enter title" ><br>
                <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter description"></textarea><br>
            </div>
            <input type="submit" value="Submit" name="submit" class="form-btn">
        </form>
    </div>

</body>
</html>
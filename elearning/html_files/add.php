<?php
include("conn1.php");
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["submit"])){
        $select = $_POST["sel"];
        if($select == "new"){
            $title = $_POST["ntitle"];
            $desc = $_POST["desc"];
            if($_FILES["image"]["error"] === 4){
                echo "<script> alert('Image doesn't exist'); </script>";
            }else{
                $file_name = $_FILES["image"]["name"];
                $file_size = $_FILES["image"]["size"];
                $tmpName = $_FILES["image"]["tmp_name"];
                $validImageExtension = ['jpg','jpeg','png'];
                $imageExtension = explode('.', $file_name);
                $imageExtension = strtolower(end($imageExtension));
                if(!in_array($imageExtension, $validImageExtension)){
                    echo "<script> alert('Invalid image extension'); </script>";
                }
                else if($file_size > 1000000){
                    echo "<script> alert('Image size is too large'); </script>";
                }
                else {
                    $newChapterId = uniqid();
                    $newChapterId = '.'.$imageExtension;

                    move_uploaded_file($tmpName, '../image/'.$file_name);
                    $sql = "INSERT INTO chapter VALUES ('','$title', '$desc', '$file_name')";
                    $result = mysqli_query($conn, $sql);
                    echo "<script> 
                    alert('Image successfully added!');
                    </script>";
                }
            }
        }
        else{
            $title = $_POST["otitle"];
            $sql = "select * from chapter where title = '$title'";
            $result = mysqli_query($conn, $sql);
            if(!mysqli_num_rows($result)  >= 1){
                echo "<script> 
                alert('Title doesnot exist!');
                </script>";
                header("location:add.php");
                exit();
            }
        }
        $vtitle = $_POST["vtitle"];
        $videoName = $_FILES["video"]["name"];
        $videotemp = $_FILES["video"]["tmp_name"];
        
        move_uploaded_file($videotemp,'../image/'.$videoName);
        $sql = "INSERT INTO video VALUES ('','$title','$vtitle','$videoName')";
        $result = mysqli_query($conn, $sql);
        echo "<script> 
        alert('Video successfully added!');
        </script>";
        
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
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
            <p style="font-size :30px;">Add new!</p>
            <select name="sel" id="sel">
                <option value="">Select</option>
                <option value="new">New</option>
                <option value="old">Already existing</option>
            </select>
            <div class="new" id="new" style="display:none;" >
                <input type="text" id="ntitle" name="ntitle" placeholder="Enter title" ><br>
                <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter description"></textarea><br>
                <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png" >
            </div>
            <div id="old" class="old" style="display:none;" >
                <input type="text" id="otitle" name="otitle" placeholder="Enter title" >
            </div>
            <input type="text" id="vtitle" name="vtitle" placeholder="Enter title for video" required>
            <input type="file" id="video" name="video" required>
            <input type="submit" value="Submit" name="submit" class="form-btn">
        </form>
    </div>
    <script>
        console.log("JavaScript loaded!");
        document.getElementById("sel").addEventListener("change", function() {
            var chapterSelect = document.getElementById("sel");
            var newChapterFields = document.getElementById("new");
            var oldChapterFields = document.getElementById("old");

            if (chapterSelect.value === "new") {
                newChapterFields.style.display = "block";
                oldChapterFields.style.display = "none";
            } else if (chapterSelect.value === "old") {
                oldChapterFields.style.display = "block";
                newChapterFields.style.display = "none";
            }else{
                newChapterFields.style.display = "none";
                oldChapterFields.style.display = "none";
            }
            return true;
        });
    </script>
</body>
</html>
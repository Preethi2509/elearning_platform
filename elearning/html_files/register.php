<?php
    include("conn1.php");
    if(isset($_POST["submit"])){
        $username = mysqli_real_escape_string($conn, $_POST['uname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['pswd']);
        $type = mysqli_real_escape_string($conn, $_POST['utype']);
        $sql = "SELECT * FROM login WHERE username = '$username' && password = '$password'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $error[] = 'User already exist!';
        }
        else{
            $insert = "INSERT INTO login(username, email, password,type) VALUES('$username','$email','$password','$type')";
            mysqli_query($conn, $insert);
            header('location:login.php');
        }
    };

?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register form</title>
    <link rel="stylesheet" href="./style.css">
    <script>
        if(window.history.replaceState){
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h2>Register Form</h2>
            <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                };
            ?>
            <input type="text" name="uname" required placeholder="Enter your name">
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="pswd" required placeholder="Enter your password">
            <select name="utype" >
                <option value="User">User</option>
                <option value="Admin">Admin</option>
            </select>
            <input type="submit" name="submit" value="Register" class="form-btn">
            <p><b>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>
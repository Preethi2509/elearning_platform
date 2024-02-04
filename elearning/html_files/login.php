<?php
    include("conn1.php");
    session_start();
    if(isset($_POST["submit"])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['pswd']);
        $type = mysqli_real_escape_string($conn, $_POST['utype']);
        $sql = "select * from login where email = '$email' and password = '$password' and type = '$type'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)  > 0){
            $row = mysqli_fetch_array($result);
            if($row["type"] == 'Admin'){
                $_SESSION['admin_name'] = $row['username'];
                header('location:admin.php');
            }else if($row['type'] == 'User'){
                $_SESSION['user_name'] = $row['username'];
                header('location:user.php');
            }
        }
        else{
            $error[] = 'Invalid username or password or type!';
        }
    }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
    <script>
        if(window.history.replaceState){
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>
<body>
    <div class="form-container">
        <form name="form"  method="post">
            <h2>Login Form</h2>
            <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                };
            ?>
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="pswd" required placeholder="Enter your password">
            <select name="utype" id="type">
                <option value="User">User</option>
                <option value="Admin">Admin</option>
            </select>
            <input type="submit" name="submit" value="Login" class="form-btn">
            <p><b>Don't have an account? <a href="register.php">Register</a></p>
        </form>
        
        
    </div>

</body>
</html>
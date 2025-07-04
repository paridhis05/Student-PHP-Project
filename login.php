<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="stylelogin.css">
</head>
<body>

<div class="center">
    <h1>Login</h1>

    <form action="#" method="POST">
        <div class="form">
            <input type="text" name="username" class="textfield" placeholder="Username">
            <input type="password" name="password" class="textfield" placeholder="Password">

            <div class="forgetpass">
                <a href="#" class="link" onclick="message()">Forgot Password?</a>
            </div>

            <input type="submit" name="login" value="Login" class="btn">

            <div class="signup">
                New Member? <a href="#" class="link">Sign Up Here</a>
            </div>
        </div>
        
    </form>
</div>

<script>
    function message(){
        alert("Forget Password!!!");
    }
</script>

</body>
</html>

<?php
    include("connection.php");

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $pwd = $_POST['password'];

        $query = "SELECT * FROM form WHERE email = '$username' && password = '$pwd' ";
        $data = mysqli_query($conn, $query);

        $total = mysqli_num_rows($data);
        // echo $total;

        if($total == 1){
            // echo "Login Successfully!";
            $_SESSION['user_name'] = $username;
            echo "<meta http-equiv='refresh' content='0; url=table.php'>";
        } else{
            echo "Login Failed!!";
        }
    }

?>


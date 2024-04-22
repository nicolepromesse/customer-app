<?php
session_start();
include("conn.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CARGO ltd</title>
</head>
<body>
   
    <form action="" method="post">
    <h1>CARGO ltd</h1>
        <input type="text" name="username" placeholder="Enter username"><br><br>
        <input type="password" name="password" placeholder="Enter password"><br><br>
        <button type="submit" name="login">Login</button>
        <button type="submit" name="create">Signup</button><br><br>
        <button type="submit" name="fpassword">Forgot Password</button>
        <!-- <button type="submit" name="log">Logout</button> -->
    </form>

    <?php
    if(isset($_POST['create'])){
        header("location:create.php");
    }
    ?>

    <?php
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $select = "SELECT username, password FROM manager WHERE username='$username' AND password='$password'";
        $select_jion = mysqli_query($conn, $select);
        if(mysqli_num_rows($select_jion) > 0){
            $_SESSION['log'] = $username;
            header("location:welcome.php");
        }else{
            header("location:form.php");
        }
    }
    ?>

    <?php
    if(isset($_POST['fpassword'])){
        $otp = "abcdefghjkiynfeohfwsa123456790";
        $generator = substr(str_shuffle($otp), 1, 9);
        $ot = $generator;
        echo $ot;

        $myquery = "UPDATE manager SET otp='$ot' WHERE Managerid=1";
        $update = mysqli_query($conn, $myquery);

        echo "<script>
            var ot = prompt('Enter the OTP');
            var ottp = 'var ot';

            if(ot == ottp){
                location.href = 'welcome.php';
            }else{
                alert('Invalid OTP');
            }
        </script>";
    }
    ?>

    <?php
    if(isset($_POST['log'])){
        session_destroy();
        header("location:form.php");
    }
    ?>
</body>
</html>
<style>
body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center; 
    text-align: center; 
}

form {
    margin-top: 40px;
    border: 1px solid pink;
    background: linear-gradient(100deg, rgba(128, 36, 6, 0.275), rgba(96, 72, 234, 0.809));
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    
}

form input {
    height: 40px;
    border-radius: 10px;
    margin-top: 10px;
    width: 100%;
    padding: 0 10px;
    box-sizing: border-box;
}

form button {
    background-color: black;
    height: 37px;
    border-radius: 10px;
    margin-top: 10px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: 100%;
    border: none;
    color: #fff;
}

form button:hover {
    background-color: #555;
}
</style>

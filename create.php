<?php
include("conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>create account</title>
</head>
<body>
    
    <form action="" method="post">
    <h1>create account</h1>
        <input type="text" name="usernam" placeholder="create user name"><br><br>
        <input type="password" name="passwor" placeholder="create password"><br><br>
        <input type="password" name="code" placeholder="enter code"><br>
        <button type="submit" name="save">create</button>
        <button type="submit" name="sav">login</button>
    </form>
    <?php
    if(isset($_POST['sav'])){
        header("location:form.php");
    }
    ?>
    <?php
    if(isset($_POST['save'])){
        $code=$_POST['code'];
        $sel="select * from manager where code='$code'";
        $qp=mysqli_query($conn,$sel);
        if(mysqli_num_rows($qp)>0){

            $username=$_POST['usernam'];
            $password=$_POST['passwor'];
            echo md5($password);
            $qeury="INSERT into Manager(managerid,username,password) values (null,'$username','$password')";
            $meet=mysqli_query($conn,$qeury);
            if($meet==1){
                echo "data inserted";
            }else{
    
                echo"data not inserted";
            }
        }
        else{
echo" you are not allowed";

        }
       
    }
    ?>
    
</body>
</html>
<style>
    body{
display: flex;
flex-direction: column;
justify-content: center;
align-items: center; 
text-align: center; 
}
    form{
        margin-top:40px;
        border: 1px solid pink;
        
        background: linear-gradient(90deg,rgb(241,216,216),rgba(11,228,235,0.402));
        border-radius: 10px;
      
    }
    form input{
    height: 40px;
    border-radius: 10px;
    margin-top: 30px;
   
    }
    form button{
   
    height: 37px;
    border-radius: 10px;
    background-color: black;
  
    }
</style>
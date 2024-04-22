<?php
include("conn.php");
?>

<?php
session_start();

if(isset($_SESSION["log"])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">

    <input type="text" name="fname" placeholder="furniture name"><br><br>
    <input type="text" name="fowner" placeholder="furnitureownername"><br><br>
    <button type="submit" name="record">record</button>
    <button type="submit" name="view">view</button>
    <button type="submit" name="loga">logout</button>
    </form>
    <?php
    if(isset($_POST['record'])){
        $furniture_name=$_POST['fname'];
        $furniture_owner=$_POST['fowner'];
        $insert="insert into furniture() values (NULL,'$furniture_name','$furniture_owner')";
        $selecte=mysqli_query($conn,$insert);

        if($selecte==1){

            echo"data recorded";
        }

        else{

            echo"data doesnt recorded";
        }

    }
    ?>
    <?php
    if(isset($_POST['view'])){
        header("location:view_furniture.php");
    }
    ?>

</body>
</html>

<style>
    body{
display:flex;
flex-direction: column;
justify-content: center;
align-items: center; 
text-align: center; 
}
    form{
        margin-top:40px;
        border: 1px solid pink;
     
        background: linear-gradient(100deg,rgba(128,36,6,0.275),whitesmoke);
        border-radius: 10px;
 
    }
    form input{
    height: 40px;
    border-radius: 10px;
    margin-top: 30px;

    }
    form button{
        background-color: black;
    height: 37px;
    border-radius: 10px;

    }
</style>
<?php
    
    if(isset($_POST['loga'])){

        session_destroy();
        header("location:form.php");
    }
    
    ?>


<?php


}else{
    header("location:form.php");
}
?>
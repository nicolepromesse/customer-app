<?php
include('conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="password" name="pass" placeholder="change codes" ><br><br>
        <button type="submit" name="change">change</button><br>
    </form>
    <?php
    if(isset($_POST['change'])){
        $pa=$_POST['pass'];
        $update="update manager set code='$pa'";
        $jion=mysqli_query($conn,$update);
        if($jion){
            echo"code updated";
        }
        else{
            echo"code not updated";
        }
    }
    ?>
</body>
</html>
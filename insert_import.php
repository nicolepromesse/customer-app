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

    <input type="text" name="pdate" value="<?php echo date("m-d-y")?>" placeholder="import date"><br><br>
    <select name="product_id" ><br><br>
        <option value="">Select furniture</option>
        <?php
        $select = "select * from furniture";
        $selq = mysqli_query($conn,$select);
        if(mysqli_num_rows($selq) > 0){
            while($fetch=mysqli_fetch_array($selq)){
        ?>
        <option   value="<?php echo $fetch['furnitureid']?>"><?php echo $fetch['furniturename']?></option>

<?php
        }}
        
        ?>
    </select><br><br>
    <input type="text" name="pname" placeholder="importquantity"><br><br>
    <button type="submit" name="recor">record</button>
    <button type="submit" name="view">viewport</button>
    <button type="submit" name="lgt">logout</button>
    </form>
    <?php
    if(isset($_POST['view'])){
        header("location:view_import.php");
    }
    ?>
    <?php
    if(isset($_POST['recor'])){
        $import_date=$_POST['pdate'];
        $import_quantity=$_POST['pname'];
        $get=$_POST['product_id'];
        


        $check_product= "select * from import where furnitureid='$get'";
        $result = mysqli_query($conn,$check_product);

        if(mysqli_num_rows($result)>0){

            while($rows= mysqli_fetch_array($result)){

                $past_quantity = $rows["quantity"];
                $current_quantity = $import_quantity;
                $total_quantity = $past_quantity+$import_quantity;

             $update_product = "UPDATE import set quantity='$total_quantity' where furnitureid='$get'";
             $update_it = mysqli_query($conn,$update_product);

             if($update_it){
                echo "Product import updated";
             }else{
                echo "Product not found";
             }



            }

        }else{

            $insert_qeury="insert into import() values ($get,'$import_date','$import_quantity')";
        $selected=mysqli_query($conn,$insert_qeury);

        if($selected==1){

            echo"data recorded";
        }

        else{

            echo"data doesnt recorded";
        }

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
        border: 1px solid rgba(0,0,0,0.304);
        width: 250px;
        background-color: white;
        border-radius: 10px;
        height: 300px;
        box-shadow: 5px 7px rgba(8,8,9,0.149);
        
    }
    form input{
    height: 40px;
    border-radius: 10px;
    margin-top: 30px;
    }
    form button{
    background: transparent;
    height: 37px;
    border-radius: 10px;

    }
    form select{
        background: transparent;
    height: 37px;
    border-radius: 10px 
    }
</style>
<?php
    
    if(isset($_POST['lgt'])){

        session_destroy();
        header("location:form.php");
    }
    
    ?>


<?php


}else{
    header("location:form.php");
}
?>
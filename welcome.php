<?php
session_start();
if(isset($_SESSION['log'])==1){
    $sf=$_SESSION['log'];

?>
<!DOCTYPE html>
<html lang="en">
<he


ad>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome</title>
</head>
<body>
    <h1>welcome <?php echo $_SESSION['log'] ?> </h1>
    <form method="post">
    <select name="select" id="">
        <option value="furniture">furniture</option>
        <option value="import">import</option>
        <option value="export">export</option>

    </select>
    <button type="submit">record</button><br><br>

    </form>
    <?php
    if($_SERVER['REQUEST_METHOD']==='POST'){

        $select=$_POST['select'];

        switch($select){

            case 'furniture';
            header("location:insert_furniture.php");

            exit();

            case 'import';
            header("location:insert_import.php");
            exit();


            case 'export';
            header("location:insert_export.php");
            exit();
            default;
        }
    }
       
    ?>
    <form action="" method="post">
        <select name="select_tables" >
            <option value="furnitur">furniture</option>
            <option value="import">import</option>
            <option value="export">export</option>
        </select>
    <button type="submit">view</button><br>
    <br>

    </form>

    <?php
     if($_SERVER['REQUEST_METHOD']==='POST'){

        $selec=$_POST['select_tables'];

        switch($selec){

            case 'furnitur';
            header("location:view_furniture.php");

            exit();

            case 'import';
            header("location:view_import.php");
            exit();


            case 'export';
            header("location:view_export.php");
            exit();
            default;
        }
    } 
    ?>
   <?php
?>
<a href="report.php">REPORT</a>
<form  method="post">
    <button type="submit" name="logout">logout</button>
  <button type="submit" name="cod">change codes</button>
    </form>
    <?php
    if(isset($_POST['cod'])){
        header("location:change.php");
    }
    ?>
   
</body>
</html>
<?php
    
    if(isset($_POST['logout'])){

        session_destroy();
        header("location:form.php");
    }
    
    ?>
   <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        select, button {
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            font-size: 16px;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: blue;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
<?php
if(isset($_POST['logout'])){

    session_destroy();
    header("location:form.php");
}
?>
<?php

}else{
    header("location:form.php");
}
?>
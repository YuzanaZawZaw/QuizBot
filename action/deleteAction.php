<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Action</title>
</head>
<body>
    <?php
        require_once('../common/connection.php');//getting connection
        $id=$_GET['id'];       
        $sql = "delete from frequently_ask_quiz where id=$id"; 
        if(mysqli_query($conn, $sql)){  
            echo "Record delete successfully ";  
            header('Location:../form/adminHome.php');
        }else{  
            echo "Could not delete record: ". mysqli_error($conn);  
        }  
        mysqli_close($conn);
    ?>
</body>
</html>
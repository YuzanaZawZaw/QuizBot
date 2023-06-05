<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Action</title>
</head>
<body>
    
<?php
    session_start();
    $sessionId=$_SESSION['id'];
    
    if (isset($_POST['btnUpdate'])) {
        require_once('../common/connection.php');
        $update_question=$_POST['updateQuestion'];
        $update_answer=$_POST['updateAnswer'];
        $sql = "update frequently_ask_quiz set question=\"$update_question\",answer=\"$update_answer\" where id=$sessionId"; 
        if(mysqli_query($conn, $sql)){  
            echo "Record update successfully ";  
            header('Location:../form/adminHome.php');
        }else{  
                echo "Could not update record: ". mysqli_error($conn);  
        }  
        
        mysqli_close($conn);
    }
    if (isset($_POST['btnUpdateCancel'])) {
        header('Location:../form/adminHome.php');
    }
?>
</body>
</html>




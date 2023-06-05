<?php
if  (isset($_POST['btnSave'])) {
        require_once('../common/connection.php');
        $question=$_POST['question'];
        $answer=$_POST['answer'];
        $sql = "INSERT INTO frequently_ask_quiz(question,answer) VALUES ('$question', '$answer')";  
        if(mysqli_query($conn, $sql)){  
            echo "Record inserted successfully";  
            header('Location:../form/adminHome.php');
        }else{  
        echo "Could not insert record: ". mysqli_error($conn);  
        }  
        mysqli_close($conn);
    }
    if  (isset($_POST['btnSaveCancel'])) {
        header('Location:../form/adminHome.php');
    }
?>
    
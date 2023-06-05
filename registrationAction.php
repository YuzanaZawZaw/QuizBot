<?php
if  (isset($_POST['btnRegister'])) {
        require_once('common/connection.php');
        $reg_role=$_POST['userRole'];
        $reg_name=$_POST['regName'];
        $reg_email=$_POST['regEmail'];
        $reg_password=$_POST['regPassword'];
        $sql = "INSERT INTO user(name,email,password,user_role_id) VALUES ('$reg_name','$reg_email','$reg_password','$reg_role')";  
        if(mysqli_query($conn, $sql)){  
            echo "Record inserted successfully";  
            header('Location:loginForm.php');
        }else{  
            echo "Could not insert record: ". mysqli_error($conn);  
        }  
        mysqli_close($conn);
    }
    if  (isset($_POST['btnRegisterCancel'])) {
        header('Location:userRegistration.php');
    }
?>
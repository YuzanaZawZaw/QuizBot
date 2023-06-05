<?php
    if (isset($_POST['btnLogin'])) {
        require_once('common/connection.php');
        $email=$_POST['email'];
        $role=$_POST['role'];
        $password=$_POST['password'];
        
        $sql = "select * from user where email='$email' and password='$password' and user_role_id='$role'"; 
        $retval=mysqli_query($conn, $sql); 

        if(mysqli_num_rows($retval) > 0 && $role==1){  
            echo "Admin Login Successfully" ;
            header('Location:form/adminHome.php');
        }else if(mysqli_num_rows($retval) > 0 && $role==2){
            echo "User Login Successfully" ;
            header('Location:form/userHome.php');
        }
                            
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizBot</title>
</head>
<body>
<?php
    require_once('common/connection.php');
    $sql = "select * from user_role"; 
    $retval=mysqli_query($conn, $sql);  
    $role_list = [];
    if ($retval->num_rows > 0) {
        $role_list = $retval->fetch_all(MYSQLI_ASSOC);
    }   
    mysqli_close($conn);
?>   
<!--adminHeader-->
<?php include('loginHeader.php');?>
<!--END adminHeader=-->
<div class="container mt-5">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
                    <h3 align="center">
					    Login to <strong> QuizBot</strong>
				    </h3>
					</div>
				</div>
				<div class="row gutters-sm mt-3">
					<div class="col-md-3 mb-3"></div>
					<div class="col-md-6 mb-3">
						<div class="card">
							<div class="card-body">
								<div class="d-flex flex-column">
									<div class="mt-3">                                    
                                        <form method="post" action="loginAction.php">	
                                            <div class="form-group last mb-3">
                                                <label for="role">Role:</label>
                                                <select name="role" class="form-select" aria-label="Default select example" required>
                                                    <option selected>Open this select menu</option>
                                                    <?php if(!empty($role_list)) { ?>
                                                        <?php foreach($role_list as $role) { ?>
                                                            <option value="<?php echo $role['id']; ?>"><?php echo $role['role_name']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>                                                   
                                                </select>
                                            </div>						
                                            <div class="form-group first">
                                                <label class="form-label" for="email">Email:</label>
                                                <input type="text" class="form-control" name="email" placeholder="Enter email..." required/>					
                                            </div>
                                            <div class="form-group last mb-3">
                                                <label for="password">Password:</label>
                                                <input type="password" class="form-control" name="password" placeholder="Enter password..." required/>	
                                            </div>
                                            <div class="text-center mt-3">
                                                <input type="submit" name="btnLogin" value="Save" class="btn btn-outline-info"/>
                                                <input type="submit" name="btnLoginCancel" value="Cancel" class="btn btn-outline-warning" onclick="this.form.reset();"/>														
                                            </div>
                                        <form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
<!--FOOTER-->
<?php include('common/footer.php');?> 
<!--END FOOTER-->
</body>
</html>
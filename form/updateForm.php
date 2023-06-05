<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Form</title>
</head>
<body>

<?php
	require_once('../common/connection.php');
    $id=$_GET['id'];    
	session_start();
	$_SESSION["id"] = $id;

    $sql = "select * from frequently_ask_quiz where id='$id'"; 
    $retval=mysqli_query($conn, $sql); 
    if(mysqli_num_rows($retval) > 0){  
        while($row = mysqli_fetch_assoc($retval)){  
            $question=$row['question'];
            $answer=$row['answer'];
			$_SESSION["question"] = $question;
			$_SESSION["answer"] = $answer;
        } //end of while  
    } 
    mysqli_close($conn);
?>
	<!--adminHeader-->
	<?php include('../common/adminHeader.php');?>
	<!-- End adminHeader-->

    <div class="container mt-5">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<h2>
							<font color="#836ea7">Update a quiz</font>
						</h2>
					</div>
				</div>
				<div class="row gutters-sm mt-3">
					<div class="col-md-3 mb-3"></div>
					<div class="col-md-6 mb-3">
						<div class="card">
							<div class="card-body">
								<div class="d-flex flex-column">
									<div class="mt-3">                                    
										<form method="post" action="../action/updateAction.php">
											<div class="form-group first">
												<label class="form-label" for="id">Id:</label>
                                                <input type="text" class="form-control" name="updateId" value="<?php echo $id;?>" disabled/>
											</div>
											<div class="form-group first">
												<label class="form-label" for="question">Question:</label>
                                                <input type="text" class="form-control" name="updateQuestion" value="<?php echo $question;?>" required/>
											</div>
                                            <div class="form-group first">
												<label class="form-label" for="answer">Answer:</label>
                                                <input type="text" class="form-control" name="updateAnswer" value="<?php echo $answer;?>" required/>
											</div>
											<div class="text-center mt-3">
                                                <input type="submit" name="btnUpdate" value="Update" class="btn btn-outline-info"/>
                                                <input type="submit" name="btnUpdateCancel" value="Cancel" class="btn btn-outline-warning" onclick="this.form.reset();"/>														
											</div>
                                        </form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
<!--Footer-->
<?php include('../common/footer.php');?>  
<!--End Footer-->
</body>
</html>
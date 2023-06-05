<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz List</title>
    <link rel="stylesheet"
	href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>
<body>
<?php
    require_once('../common/connection.php');
    $sql = "select * from frequently_ask_quiz"; 
    $retval=mysqli_query($conn, $sql);  
    $quiz_list = [];
    if ($retval->num_rows > 0) {
        $quiz_list = $retval->fetch_all(MYSQLI_ASSOC);
    }   
?>
<!--adminHeader-->
<?php include('userHeader.php');?>
<!-- End adminHeader-->    
<?php if(!empty($quiz_list)) { ?>
    <?php foreach($quiz_list as $quiz) { ?>
        <input type="hidden" id="searchByQuestion" name="searchByQuestion" value="<?php echo $quiz['question']; ?> ">                         
    <?php } ?>
<?php } ?>
<div class="container mt-5 d-flex justify-content-center">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<h2 align="center">
							<font color="#836ea7">Ask anything</font>
						</h2>
					</div>
				</div>
                <div class="row gutters-sm mt-3">
					<div class="col-md-12 mb-3">
                        <form method="post">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <textarea type="text" class="form-control" name="frmQuestion" id="frmQuestion" rows="5" cols="40" placeholder="Search by question..." required></textarea>                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3" >
                                    <input type="submit" name="btnSearch" value="Search" class="btn btn-outline-info"/>
                                </div>
                            </div>    
                        </form>
					</div>
				</div>
                <?php
                    if (isset($_POST['btnSearch']) && $_POST['frmQuestion']!=null) {
                        $frmQuestion=$_POST['frmQuestion'];
                        $sql1 = "select answer from frequently_ask_quiz where question='$frmQuestion'";    
                        $retval1=mysqli_query($conn, $sql1);  
                        $ans_list = [];
                        if ($retval1->num_rows > 0) {
                            $ans_list = $retval1->fetch_all(MYSQLI_ASSOC);
                        }else{
                            $frmQuestion=$_POST['frmQuestion'];
                            $sql2 = "INSERT INTO frequently_ask_quiz(question) VALUES ('$frmQuestion')";  
                            if(mysqli_query($conn, $sql2)){  
                                echo "Not found answer for your question.<br>So your question is added!!. Admin will answer soon!!";  
                            }else{  
                                echo "Could not insert record: ". mysqli_error($conn);  
                            }  
                        }
                    }            
                    mysqli_close($conn);                              
                ?>
                <div class="row gutters-sm mt-3">
					<div class="row">
						<div class="col-md-12 mb-3">
                            <?php if(!empty($ans_list)) { ?>
                                <?php foreach($ans_list as $ans) { ?>                                  
                                        <font color="#836ea7">
                                            <h4>Your search result is:</h4>
                                        </font>
                                        <p><?php echo $ans['answer']; ?></p>                  
                                <?php } ?>
                            <?php } ?>	
							</div>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
    <?php include('../common/footer.php');?>  
    <!-- for auto-completement -->
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script>
		var availableTags = [];
		var frmQuestion = document.querySelectorAll("#searchByQuestion");
		for ( var i = 0; i < frmQuestion.length; i++) {
			availableTags[i] = (frmQuestion[i].value);
		}
		$("#frmQuestion").autocomplete({
			source : availableTags
		});
	</script>
</body>
</html>
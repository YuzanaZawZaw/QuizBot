<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Quiz Bot Search Page</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="css/table.css">
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
    mysqli_close($conn);
?>
<?php include('../common/adminHeader.php');?>
<div class="container mt-5">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<h2>
							<font color="#836ea7">Create a new quiz</font>
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
										<form method="post" action="../action/createAction.php">
											<div class="form-group first">
												<label class="form-label" for="question">Question:</label>
                                                <input type="text" class="form-control" name="question" placeholder="Enter question..." required/>
											</div>
                                            <div class="form-group first">
												<label class="form-label" for="answer">Answer:</label>
												<textarea type="text" class="form-control" name="answer" rows="5" cols="40" placeholder="Enter answer..." required></textarea>										
											</div>
											<div class="text-center mt-3">
                                                <input type="submit" name="btnSave" value="Save" class="btn btn-outline-info"/>
                                                <input type="submit" name="btnSaveCancel" value="Cancel" class="btn btn-outline-warning" onclick="this.form.reset();"/>														
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
<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-8">
							<h2>
								<font color="#836ea7">Quiz List</font>
							</h2>
						</div>
					</div>
				</div>
				<div class="p-3 table-responsive">
					<table class="table table-striped table-hover table-bordered"
						id="searchTable">
						<thead style="background-color: #836ea7; color: white">
							<tr>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Action</th>
							</tr>
						</thead>
                        <tbody>
                            <?php if(!empty($quiz_list)) { ?>
                                <?php foreach($quiz_list as $quiz) { ?>
                                    <tr>
                                        <td><?php echo $quiz['question']; ?></td>
                                        <td><?php echo $quiz['answer']; ?></td>
                                        <td>
                                            <a href="updateForm.php?id=<?php echo $quiz["id"] ?>"><img src="../images/icons8-edit-48.png" alt="Bootstrap" width="20" height="20"></a>
                                            <a href="../action/deleteAction.php?id=<?php echo $quiz["id"] ?>" onclick="return confirm('Are you sure?')"><img src="../images/icons8-delete-24.png" alt="Bootstrap" width="20" height="20"></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
<?php include('../common/footer.php');?>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js"></script>

<script>
	$(document).ready(function () {
		 var dataSrc = [];
    	$('#searchTable').DataTable({
    	        pagingType: 'full_numbers',
    	        scrollY: true,
    	        "lengthMenu": [5, 10, 25, 50, 75, 100],
    	        'initComplete': function(){
    	            var api = this.api();
    	            api.cells('tr', [0,1]).every(function(){
    	                // Get cell data as plain text
    	                var data = $('<div>').html(this.data()).text();           
    	                if(dataSrc.indexOf(data) === -1){ dataSrc.push(data); }
    	             });
    	         	// Sort dataset alphabetically
    	            dataSrc.sort();
    	           
    	            // Initialize Typeahead plug-in
    	            $('.dataTables_filter input[type="search"]', api.table().container())
    	               .typeahead({
    	                  source: dataSrc,
    	                  afterSelect: function(value){
    	                     api.search(value).draw();
    	                  }
    	               }
    	            );
				}
    	  });
    	}
	);
	</script>
    
</body>
</html>
<?php 
	
require_once('../function/about.php');
if(isset($_POST ['section_data_submission'])){
	$old = $_POST;
	$serve_data = aboutHeading($_POST);
	
	//print_r($_POST);
	
	if($serve_data['status'] == 'error'){
		$errors = $serve_data['message'];
	}elseif($serve_data['status'] == 'success'){
		$success = $serve_data['message'];
	}
}

if(isset($_POST ['skill_data_submission'])){
	$old = $_POST;
	$serve_data = aboutContent($_POST);
	
	//print_r($_POST);
	
	if($serve_data['status'] == 'error'){
		$errors = $serve_data['message'];
	}elseif($serve_data['status'] == 'success'){
		$success = $serve_data['message'];
	}
}

if(isset($_POST ['visibilityId'])){
	$old = $_POST;
	$serve_data = aboutContentVisibility($_POST);
	
	//print_r($_POST);
	
	if($serve_data['status'] == 'error'){
		$errors = $serve_data['message'];
	}elseif($serve_data['status'] == 'success'){
		$success = $serve_data['message'];
	}
}

if(isset($_POST ['deleteId'])){
	$old = $_POST;
	$serve_data = aboutContentdelete($_POST);
	
	//print_r($_POST);
	
	if($serve_data['status'] == 'error'){
		$errors = $serve_data['message'];
	}elseif($serve_data['status'] == 'success'){
		$success = $serve_data['message'];
	}
}

if(isset($_POST ['edit_data_submission'])){
	$old = $_POST;
	$serve_data = aboutContentEdit($_POST);
	
	//print_r($_POST);
	
	if($serve_data['status'] == 'error'){
		$errors = $serve_data['message'];
	}elseif($serve_data['status'] == 'success'){
		$success = $serve_data['message'];
	}
}


$headingData = aboutHeadingData();

$contentData = aboutContentData();
//print_r($headingData);
	include ('header.php');
	


?>
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">About Me</h1>
    </div>
	<?php 
		
		if(isset($success)){
	?>
		<div class="alert alert-primary alert-dismissible fade show" role="alert">
		  <?php echo $success; ?>
		  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php
			header('Refresh:1;url=about.php');
		}
	?>
	<form class="px-5 py-3 border" method="post">
		<h2 class="text-center">About Me</h2>
	  <div class="mb-3">
		<label for="section_title" class="form-label">Title</label>
		<input type="text" class="form-control" id="section_title" name="title" value="<?php echo $old['title']??$headingData['title']??''; ?>" placeholder="Section Title">
		<div class="small text-danger"><?php echo ($errors['title']?? ''); ?></div>
	  </div>
	  <div class="mb-3">
		<label for="short_title" class="form-label">Short Title</label>
		<input type="text" class="form-control" id="short_title" name="short_title" value="<?php echo $old['short_title']??$headingData['short_title']??''; ?>" placeholder="Short Title">
		<div class="small text-danger"><?php echo ($errors['short_title']?? ''); ?></div>
	  </div>
	  <div class="mb-3">
		<label for="details" class="form-label">Details</label>
		<input type="text" class="form-control" id="details" name="details" value="<?php echo $old['details']??$headingData['details']??''; ?>" placeholder="details">
		<div class="small text-danger"><?php echo ($errors['details']?? ''); ?></div>
	  </div>
	  <button type="submit" name="section_data_submission" class="btn btn-primary">Submit</button>
	</form>
	<form class="px-5 py-3 border" method="post">
		<h2 class="text-center">Skill Progress Part</h2>
	  <div class="mb-3">
		<label for="Progress_title" class="form-label">Progress Title</label>
		<input type="text" class="form-control" id="Progress_title" name="Progress_title" value="<?php echo $old['Progress_title']??$headingData['Progress_title']??''; ?>" placeholder="Progress Title">
		<div class="small text-danger"><?php echo ($errors['Progress_title']?? ''); ?></div>
	  </div>
	  <div class="mb-3">
		<label for="progress_color" class="form-label">Progress color</label>
		<input type="text" class="form-control" id="progress_color" name="progress_color" value="<?php echo $old['progress_color']??$headingData['progress_color']??''; ?>" placeholder="Progress color">
		<div class="small text-danger"><?php echo ($errors['progress_color']?? ''); ?></div>
	  </div>
	  <div class="mb-3">
		<label for="progress_percentage" class="form-label">Progress Percentage</label>
		<input type="text" class="form-control" id="progress_percentage" name="progress_percentage" value="<?php echo $old['progress_percentage']??$headingData['progress_percentage']??''; ?>" placeholder="Progress Percentage">
		<div class="small text-danger"><?php echo ($errors['progress_percentage']?? ''); ?></div>
	  </div>
	  <button type="submit" name="skill_data_submission" class="btn btn-primary">Submit</button>
	</form>
	<table class="table">
		<tr class="table-secondary">
			<th>sl</th>
			<th>title</th>
			<th>progress bar</th>
			<th>Color parcent</th>
			<th ></th>
		</tr>
		<?php 
			if($contentData){
			$x= 1;
			while($data = mysqli_fetch_assoc($contentData)){
			
			
		?>	
		<tr>
			<td><?php echo $x++; ?></td>
			<td><?php echo $data['title']?></td>
			<td>
				<div class="progress w-100 bg-dark rounded-pill">
					<div class="progress-bar progress-bar-striped progress-bar-animated <?php echo ($data['short_title']);?> rounded-pill" role="progressbar" style="width: <?php echo ($data['details']);?>%">
					</div>
				</div>
			</td>
			<td><?php echo $data['details']; ?></td>
			<td>
				<div class="d-flex gap-1">
					<!--Active/inactive Button-->
					<button onclick="if(confirm('Do you want to <?php echo $data['visibility'] == 1 ? 'Inactive' : 'Active'; ?> this <?php echo $data['title']; ?> Content?')){return visibilityAction(this);}else{return preventDefault();}" data-id="<?php echo $data['id']; ?>" class="btn <?php echo $data['visibility'] == 1 ? 'btn-success' : 'btn-secondary'; ?>"><i class="far <?php echo $data['visibility'] == 1 ? 'fa-eye' : 'fa-eye-slash'; ?> "></i></button>
					<!--Edit Button-->
					<button onclick="modalAction(this)"  data-id="<?php echo $data['id']; ?>" data-title="<?php echo $data['title']; ?>"  data-short-title="<?php echo $data['short_title']; ?>"  data-details="<?php echo $data['details']; ?>" class="btn btn-warning"><i class="far fa-edit"></i></button>
					<!--Delete Button-->
					<button onclick="if(confirm('Do you want to Delete this <?php echo $data['title']; ?> Content?')){return deleteAction(this);}else{return preventDefault();}" data-id="<?php echo $data['id']; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
					
				</div>
			</td>
		</tr>
		<?php	
			}
		?>
	
		<?php
			}
		?>
		
	</table>
	
	<form method="post" id="visibilityFrom">
		<input type="hidden" id="visibilityId" name="visibilityId">
	</form>
	
	<form method="post" id="deleteFrom">
		<input type="hidden" id="deleteId" name="deleteId">
	</form>
	<div class="modal" tabindex="-1" id="editModal">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Edit <b class="text-capitalize text-danger" id="modalTitle"></b> </h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<form method="post">
				<input type="hidden" id="editId" name="editId" value="<?php echo $old['editId']??''; ?>"> 
			  <div class="mb-3">
				<label for="edit_title" class="form-label"> title</label>
				<input type="text" class="form-control" id="edit_title" name="edit_title" value="<?php echo $old['edit_title']??''; ?>" placeholder="content Title">
			 
				<div class="small text-danger"><?php echo ($errors['edit_title']?? ''); ?></div>
			  </div>
			  <div class="mb-3">
					<label for="edit_short_title" class="form-label">Color Name</label>
					<input type="text" class="form-control" id="edit_short_title" name="edit_short_title" value="<?php echo $old['edit_short_title']??''; ?>" placeholder="content Title">
					<div class="small text-danger"><?php echo ($errors['edit_short_title']?? ''); ?></div>
				</div>
			  <div class="mb-3">
				<label for="edit_details" class="form-label">Progress Percentage</label>
				<input type="text" class="form-control" id="edit_details" name="edit_details" value="<?php echo $old['edit_details']??''; ?>" placeholder="content Short Details">
				<div class="small text-danger"><?php echo ($errors['edit_details']?? ''); ?></div>
			  </div>
			  <div class="d-flex justify-content-end gap-1">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.href">Close</button>
				<button type="submit" name="edit_data_submission" class="btn btn-danger">Update</button>
			  </div>
			</form>
		  </div>
		</div>
	  </div>
	</div>
<?php include ('footer.php');?>


<script>
	function visibilityAction(x){
		var visibilityId = x.getAttribute('data-id');
		document.getElementById('visibilityId').value = visibilityId;
		document.getElementById('visibilityFrom').submit();
		//alart(visibilityId);
	}
	function deleteAction(x){
		var deleteId = x.getAttribute('data-id');
		document.getElementById('deleteId').value = deleteId;
		document.getElementById('deleteFrom').submit();
		//alart(visibilityId);
	}
	function modalAction(x){
		var editId = x.getAttribute('data-id');
		var title = x.getAttribute('data-title');
		var short_title = x.getAttribute('data-short-title');
		var details = x.getAttribute('data-details');
		
		
		document.getElementById('editId').value = editId;
		document.getElementById('edit_title').value = title;
		document.getElementById('edit_short_title').value = short_title;
		document.getElementById('edit_details').value = details;
		document.getElementById('modalTitle').innerHTML = title;
		new bootstrap.Modal('#editMOdal', {keyboard: false}).show();
	}
	
	
</script>
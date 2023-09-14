<?php 
	
require_once('../function/services.php');
if(isset($_POST ['section_data_submission'])){
	$old = $_POST;
	$serve_data = sectionHeading($_POST);
	
	//print_r($_POST);
	
	if($serve_data['status'] == 'error'){
		$errors = $serve_data['message'];
	}elseif($serve_data['status'] == 'success'){
		$success = $serve_data['message'];
	}
}

if(isset($_POST ['content_data_submission'])){
	$old = $_POST;
	$serve_data = sectionContent($_POST);
	
	//print_r($_POST);
	
	if($serve_data['status'] == 'error'){
		$errors = $serve_data['message'];
	}elseif($serve_data['status'] == 'success'){
		$success = $serve_data['message'];
	}
}

if(isset($_POST ['visibilityId'])){
	$old = $_POST;
	$serve_data = sectionContentVisibility($_POST);
	
	//print_r($_POST);
	
	if($serve_data['status'] == 'error'){
		$errors = $serve_data['message'];
	}elseif($serve_data['status'] == 'success'){
		$success = $serve_data['message'];
	}
}

if(isset($_POST ['deleteId'])){
	$old = $_POST;
	$serve_data = sectionContentdelete($_POST);
	
	//print_r($_POST);
	
	if($serve_data['status'] == 'error'){
		$errors = $serve_data['message'];
	}elseif($serve_data['status'] == 'success'){
		$success = $serve_data['message'];
	}
}

if(isset($_POST ['edit_data_submission'])){
	$old = $_POST;
	$serve_data = sectionContentEdit($_POST);
	
	//print_r($_POST);
	
	if($serve_data['status'] == 'error'){
		$errors = $serve_data['message'];
	}elseif($serve_data['status'] == 'success'){
		$success = $serve_data['message'];
	}
}


$headingData = sectionHeadingData();

$contentData = sectionContentData();
//print_r($headingData);
	include ('header.php');
	


?>
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Services</h1>
    </div>
	<?php 
		
		if(isset($success)){
	?>
		<div class="alert alert-primary alert-dismissible fade show" role="alert">
		  <?php echo $success; ?>
		  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php
			header('Refresh:1;url=service.php');
		}
	?>
	<form class="px-5 py-3 border" method="post">
		<h2 class="text-center">Section Heading part</h2>
	  <div class="mb-3">
		<label for="section_title" class="form-label">Section Title</label>
		<input type="text" class="form-control" id="section_title" name="section_title" value="<?php echo $old['section_title']??$headingData['title']??''; ?>" placeholder="Section Title">
		<div class="small text-danger"><?php echo ($errors['section_title']?? ''); ?></div>
	  </div>
	  <div class="mb-3">
		<label for="section_details" class="form-label">Section Short Details</label>
		<input type="text" class="form-control" id="section_details" name="section_details" value="<?php echo $old['section_details']??$headingData['details']??''; ?>" placeholder="Section Short Details">
		<div class="small text-danger"><?php echo ($errors['section_details']?? ''); ?></div>
	  </div>
	  <button type="submit" name="section_data_submission" class="btn btn-primary">Submit</button>
	</form>
	<form class="px-5 py-3 border" method="post">
		<h2 class="text-center">Section Contnt part</h2>
	  <div class="mb-3">
		<label for="content_icon" class="form-label"> Icon Fontawsome class</label>
		<input type="text" class="form-control" id="section_title" name="content_icon" value="<?php echo $old['content_icon']??''; ?>" placeholder="content Title">
		<div class="small text-danger"><?php echo ($errors['content_icon']?? ''); ?></div>
	  </div>
	  <div class="mb-3">
		<label for="content_title" class="form-label"> Title</label>
		<input type="text" class="form-control" id="section_title" name="content_title" value="<?php echo $old['content_title']??''; ?>" placeholder="content Title">
		<div class="small text-danger"><?php echo ($errors['content_title']?? ''); ?></div>
	  </div>
	  <div class="mb-3">
		<label for="content_details" class="form-label">content Short Details</label>
		<input type="text" class="form-control" id="content_details" name="content_details" value="<?php echo $old['content_details']??''; ?>" placeholder="content Short Details">
		<div class="small text-danger"><?php echo ($errors['content_details']?? ''); ?></div>
	  </div>
	  <button type="submit" name="content_data_submission" class="btn btn-primary">Submit</button>
	</form>
	<table class="table">
		<tr class="table-secondary">
			<th>sl</th>
			<th>Icon</th>
			<th>title</th>
			<th>details</th>
		</tr>
		<?php 
			if($contentData){
			$x= 1;
			while($data = mysqli_fetch_assoc($contentData)){
			
			
		?>	
		<tr>
			<td><?php echo $x++; ?></td>
			<td><i class="<?php echo $data['icon']?> fa-2x"></i></i></td>
			<td><?php echo $data['title']; ?></td>
			<td><?php echo $data['details']; ?></td>
			<td>
				<div class="d-flex gap-1">
					<!--Active/inactive Button-->
					<button onclick="if(confirm('Do you want to <?php echo $data['visibility'] == 1 ? 'Inactive' : 'Active'; ?> this <?php echo $data['title']; ?> Content?')){return visibilityAction(this);}else{return preventDefault();}" data-id="<?php echo $data['id']; ?>" class="btn <?php echo $data['visibility'] == 1 ? 'btn-success' : 'btn-secondary'; ?>"><i class="far <?php echo $data['visibility'] == 1 ? 'fa-eye' : 'fa-eye-slash'; ?> "></i></button>
					<!--Edit Button-->
					<button onclick="modalAction(this)"  data-id="<?php echo $data['id']; ?>" data-icon="<?php echo $data['icon']; ?>"  data-title="<?php echo $data['title']; ?>"  data-details="<?php echo $data['details']; ?>" class="btn btn-warning"><i class="far fa-edit"></i></button>
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
				<label for="edit_icon" class="form-label"> Icon Fontawsome class</label>
				<input type="text" class="form-control" id="edit_icon" name="edit_icon" value="<?php echo $old['edit_icon']??''; ?>" placeholder="content Title">
				<div class="small text-danger"><?php echo ($errors['edit_icon']?? ''); ?></div>
			  </div>
			  <div class="mb-3">
				<label for="edit_title" class="form-label"> Title</label>
				<input type="text" class="form-control" id="edit_title" name="edit_title" value="<?php echo $old['edit_title']??''; ?>" placeholder="content Title">
				<div class="small text-danger"><?php echo ($errors['edit_title']?? ''); ?></div>
			  </div>
			  <div class="mb-3">
				<label for="edit_details" class="form-label">content Short Details</label>
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
		var icon = x.getAttribute('data-icon');
		var details = x.getAttribute('data-details');
		
		document.getElementById('editId').value = editId;
		document.getElementById('edit_icon').value = icon;
		document.getElementById('edit_title').value = title;
		document.getElementById('edit_details').value = details;
		document.getElementById('modalTitle').innerHTML = title;
		new bootstrap.Modal('#editMOdal', {keyboard: false}).show();
	}
	
	
</script>
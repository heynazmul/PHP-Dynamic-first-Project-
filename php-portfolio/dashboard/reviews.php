
<?php 

	require_once('../function/reviews.php');
	
	if(isset($_POST['content_data_submission'])){
		$old = $_POST;
		$serv_data = reviewContent($_POST);
		if($serv_data['status'] == 'error'){
			$errors = $serv_data['message'];
		}elseif($serv_data['status'] == 'success'){
			$success = $serv_data['message'];
		}
		//print_r($old);
	}
	
	if(isset($_POST['visibilityId'])){
		$old = $_POST;
		$serv_data = reviewContentVisibility($_POST);
		if($serv_data['status'] == 'error'){
			$errors = $serv_data['message'];
		}elseif($serv_data['status'] == 'success'){
			$success = $serv_data['message'];
		}
		//print_r($old);
	}
	
	if(isset($_POST['deleteId'])){
		$old = $_POST;
		$serv_data = reviewContentDelete($_POST);
		if($serv_data['status'] == 'error'){
			$errors = $serv_data['message'];
		}elseif($serv_data['status'] == 'success'){
			$success = $serv_data['message'];
		}
		//print_r($old);
	}
	
	if(isset($_POST['edit_data_submission'])){
		$old = $_POST;
		$serv_data = reviewContentEdit($_POST);
		if($serv_data['status'] == 'error'){
			$errors = $serv_data['message'];
		}elseif($serv_data['status'] == 'success'){
			$success = $serv_data['message'];
		}
		//print_r($old);
	}
	
	$contentData = reviewContentData();
	
	include('header.php'); 

?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	    <h1 class="h2">Review Part</h1>
    </div>

	<div class="container">
		<?php 
			if(isset($success)){
		?>
			<div class="alert alert-secondary alert-dismissible fade show" role="alert">
			  <?php echo $success; ?>
			  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php
				header('Refresh:1;url=reviews.php');
			}
		?>
		<div class="py-5">
			<h2 class="text-center">
				Section content
			</h2>
			<form class="border p-3" method="post">
			  <div class="mb-3">
				<label for="content_icon" class="form-label">Content Icon (font awesome)</label>
				<input type="text" class="form-control" id="content_icon" name="content_icon" value="<?php echo $old['content_icon'] ?? ''; ?>" placeholder="Content icon">
				<span class="text-danger" id="passwordError"><?php echo $errors['content_icon'] ?? ''; ?></span>
			  </div>
			  <div class="mb-3">
				<label for="content_number" class="form-label">Number of this part </label>
				<input type="text" class="form-control" id="content_number" name="content_number" value="<?php echo $old['content_number'] ?? ''; ?>" placeholder="Content title">
				<span class="text-danger" id="passwordError"><?php echo $errors['content_number'] ?? ''; ?></span>
			  </div>
			  <div class="mb-3">
				<label for="content_title" class="form-label">Content title</label>
				<input type="text" class="form-control" id="content_title" name="content_title" value="<?php echo $old['content_title'] ?? ''; ?>" placeholder="Content details">
				<span class="text-danger" id="passwordError"><?php echo $errors['content_title'] ?? ''; ?></span>
			  </div>
			  <button type="submit" class="btn btn-primary" name="content_data_submission">Submit</button>
			</form>
			<table class="table">
				<tr class="table-secondary">
					<th>Sl</th>
					<th>Icon</th>
					<th>Number</th>
					<th>Title</th>
					<th></th>
				</tr>
				<?php
					$x=1;
					if($contentData){
						while($data = mysqli_fetch_assoc($contentData)){
				?>
				<tr>
					<td><?php echo $x++; ?></td>
					<td><i class="<?php echo $data['icon']; ?> fa-2x" ></i></td>
					<td><?php echo $data['number']; ?></td>
					<td><?php echo $data['title']; ?></td>
					<td>
						<div class="d-flex gap-1">
							<button onclick="if(confirm('Do you want to <?php echo $data['visibility'] == 1 ? 'Inactive' : 'Active';?> this <?php echo $data['title']; ?> content ?')){return visibilityAction(this);}else{return preventDefault();}" data-id="<?php echo $data['id'];?>" class="btn <?php echo $data['visibility'] == 1 ? 'btn-success' : 'btn-secondary';?>"><i class="far <?php echo $data['visibility'] == 1 ? 'fa-eye' : 'fa-eye-slash';?>"></i></button>
							
							<button onclick="modalAction(this)"  data-id="<?php echo $data['id']; ?>" data-icon="<?php echo $data['icon']; ?>"  data-number="<?php echo $data['number']; ?>"  data-title="<?php echo $data['title']; ?>" class="btn btn-warning"><i class="far fa-edit"></i></button>
							
							<button onclick="if(confirm('Do you want to delete this <?php echo $data['title']; ?> content ?')){return deleteAction(this);}else{return preventDefault();}" data-id="<?php echo $data['id'];?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
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
		</div>
	</div>
	
	<form id="visibilityForm" method="post">
		<input type="hidden" id="visibilityId" name="visibilityId" >
	</form>
	
	<form id="deleteForm" method="post">
		<input type="hidden" id="deleteId" name="deleteId" >
	</form>
	<div class="modal" tabindex="-1" id="editModal">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Edit <b class="text-capitalize text-danger" id="modalTitle"></b> part</h5>
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
				<label for="edit_number" class="form-label"> Number</label>
				<input type="text" class="form-control" id="edit_number" name="edit_number" value="<?php echo $old['edit_number']??''; ?>" placeholder="content Title">
				<div class="small text-danger"><?php echo ($errors['edit_number']?? ''); ?></div>
			  </div>
			  <div class="mb-3">
				<label for="edit_title" class="form-label">content Short Title</label>
				<input type="text" class="form-control" id="edit_title" name="edit_title" value="<?php echo $old['edit_title']??''; ?>" placeholder="content Short Details">
				<div class="small text-danger"><?php echo ($errors['edit_title']?? ''); ?></div>
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
<?php include('footer.php'); ?>

<script>
	function visibilityAction(x){
		var visibilityId = x.getAttribute('data-id');
		document.getElementById('visibilityId').value = visibilityId;
		document.getElementById('visibilityForm').submit();
		//alert(visibilityId);
	}
	
	function deleteAction(x){
		var deleteId = x.getAttribute('data-id');
		document.getElementById('deleteId').value = deleteId;
		document.getElementById('deleteForm').submit();
		//alert(deleteId);
	}
	
	function modalAction(x){
		var editId = x.getAttribute('data-id');
		var icon = x.getAttribute('data-icon');
		var number = x.getAttribute('data-number');
		var title = x.getAttribute('data-title');
		
		document.getElementById('editId').value = editId;
		document.getElementById('edit_icon').value = icon;
		document.getElementById('edit_number').value = number;
		document.getElementById('edit_title').value = title;
		document.getElementById('modalTitle').innerHTML = title;
		new bootstrap.Modal('#editMOdal', {keyboard: false}).show();
	}
</script>
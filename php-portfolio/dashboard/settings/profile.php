<?php 
	include('../header.php'); 

	$profile = $_SESSION['auth'];
	
	if(isset($_POST['profile_submit'])){
		$old = $_POST;
		require_once('../../authentication.php');
		$profile_data = userProfile($_POST);
		if($profile_data['status'] == 'error'){
			$errors = $profile_data['message'];
		}elseif($profile_data['status'] == 'success'){
			$success = $profile_data['message'];
		}
		
	}

?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Profile</h1>
    </div>
	
		<?php 
			if(isset($success)){
		?>
			<div class="alert alert-secondary alert-dismissible fade show" role="alert">
			  <?php echo $success; ?>
			  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php
				header('Refresh:15;url=profile.php');
			}
		?>
	
<section>
	<div class="container">
		<form class="" method="post" enctype="multipart/form-data">
			<table class="table table-striped">
				<tr>
					<th width="100"></th>
					<td class="text-end">
						<label for="profile_image" class="d-block ms-auto " style="width:200px">
							<img src="<?php echo $baseurl.($profile['image']??'images/person-icon.png') ;?>" class="d-block mx-auto" alt="Profile picture of <?php echo $profile['name'];?>" height="150" width="150">
							<div class="input-group">
								<input type="file" class="form-control form-control-sm" id="profile_image" name="profile_image" placeholder="Full name">
							</div>
							<span class="text-danger" id="passwordError"><?php echo $errors['name'] ?? ''; ?></span>
						</label>
					</td>
				</tr>
				<tr>
					<th width="100">Name</th>
					<td>
						<div class="d-flex gap-2">: 
							<input type="text" class="form-control mx-3" id="name" name="name" value="<?php echo $old['name'] ?? $profile['name'] ?? '' ; ?>" placeholder="Full name">
						</div>
						<span class="text-danger" id="passwordError"><?php echo $errors['name'] ?? ''; ?></span>
					</td>
				</tr>
				<tr>
					<th width="100">Email</th>
					<td>
						<div class="d-flex gap-2">: 
							<input type="text" class="form-control mx-3" readonly id="email" name="email" value="<?php echo $profile['email'] ; ?>" placeholder="Valid Email">
						</div>
						
					</td>
				</tr>
				<tr>
					<th width="100">Phone</th>
					<td>
						<div class="d-flex gap-2">: 
							<input type="text" class="form-control mx-3" id="phone" name="phone" value="<?php echo $old['phone'] ?? $profile['phone'] ?? '' ; ?>" placeholder="Valid Email">
						</div>
						<span class="text-danger" id="passwordError"><?php echo $errors['phone'] ?? ''; ?></span>
					</td>
				</tr>
				<tr>
					<th width="100">Dob</th>
					<td>
						<div class="d-flex gap-2">: 
							<input type="date" class="form-control mx-3" id="dob" name="dob" value="<?php echo $old['dob'] ?? $profile['dob'] ?? '' ; ?>" placeholder="mm/dd/yyyy">
						</div>
						<span class="text-danger" id="passwordError"><?php echo $errors['dob'] ?? ''; ?></span>
					</td>
				</tr>
				<tr>
					<th width="100" >Gender</th>
					<td>
						<div class="d-flex gap-2">: 
							<select class="form-control mx-3" id="gender" name="gender">
								<option value="">select Gender</option>
								<option value="male" <?php echo( (isset($old['gender']) && $old['gender'] == 'male' ) || $profile['gender'] == 'male' ? 'selected' : '' ); ?> >Male</option>
								<option value="female" <?php echo( (isset($old['gender']) && $old['gender'] == 'female' ) || $profile['gender'] == 'female' ? 'selected' : '' ); ?> >Female</option>
							</select>
						</div>
						<span class="text-danger" id="passwordError"><?php echo $errors['gender'] ?? ''; ?></span>
					</td>
				</tr>
				<tr>
					<th width="100">Address</th>
					<td>
						<div class="d-flex gap-2">: 
							<input type="text" class="form-control mx-3" id="address" name="address" value="<?php echo $old['address'] ?? $profile['address'] ?? '' ; ?>" placeholder="Your Address">
						</div>
						<span class="text-danger" id="passwordError"><?php echo $errors['address'] ?? ''; ?></span>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<button class="btn btn-danger px-5" type="" name="profile_submit">Update</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	
</section>
<?php include('../footer.php'); ?>
    



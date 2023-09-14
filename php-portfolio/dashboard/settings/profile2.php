<?php 

include('../header.php');
$profile = $_SESSION['auth'];

if(isset($_POST['profile_submission'])){
	$old = $_POST;
	require_once ('../../authentication.php');
	$reg_data = userProfile($_POST);
	
	if($reg_data['status'] == 'error'){
		$errors  = $reg_data['message'];
	}elseif($reg_data['status'] == 'success'){
		$success = $reg_data['message'];
	}
	//print_r($_POST);
}

 ?>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Profile</h1>
      </div>
	  <section>
	  	<?php 
			
			if(isset($success)){
		?>
			<div class="alert alert-primary alert-dismissible fade show" role="alert">
			  <?php echo $success; ?>
			  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php
				header('Refresh:3;url=index.php');
			}
		?>

			<form class="container-md" method="POST">
				<table class="table table-striped">
					<tr>
						<th width="100">Name</th>
						<td>
							<div class="d-flex gap-x-2">: <input type="text" id="name" name="name" value="<?php echo $profile['name'];?>" placeholder="Full Name" class="form-control"></div>
							<div class="small text-danger"><?php echo ($errors['name']?? ''); ?></div>
						</td>
					</tr>
					<tr>
						<th width="100">Email</th>
						<td>
							<div class="d-flex gap-x-3">: <input type="text" id="email" name="email" value="<?php echo $profile['email'];?>" placeholder="Type your email Address" readonly class="form-control-plaintext"></div>
						</td>
					</tr>
					<tr>
						<th width="100">Phone</th>
						<td>
							<div class="d-flex gap-x-2">: <input type="number" id="phone" name="phone" value="<?php echo $profile['phone'];?>" placeholder="Phone Number" class="form-control"></div>
							<div class="small text-danger"><?php echo ($errors['phone']?? ''); ?></div>
						</td>
					</tr>
					<tr>
						<th width="100">dob</th>
						<td>
							<div class="d-flex gap-x-2">: <input type="date" id="dob" name="dob" value="<?php echo $profile['dob'];?>" placeholder="DD/MM/YYYY" class="form-control"></div>
							<div class="small text-danger"><?php echo ($errors['dob']?? ''); ?></div>
						</td>
					</tr>
					<tr>
						<th width="100">Gender</th>
						<td>
							<select id="name" name="name" class="form-control">
								<option value="">Select Gender</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</td>
					</tr>
					<tr>
						<th width="100">Address</th>
						<td>
							<div class="d-flex gap-x-2">: <input type="text" id="name" name="name" value="<?php echo $profile['address']??'';?>" placeholder="Full Address" class="form-control"></div>
							<div class="small text-danger"><?php echo ($errors['address']?? ''); ?></div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<button class="btn btn-danger px-5" name="profile_submission">Update</button>
						</td>
					</tr>
					
				</table>
			</form>
	  </section>
<?php include('../footer.php'); ?>
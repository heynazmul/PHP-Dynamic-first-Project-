<?php

	if(isset($_POST['registration_submition'])){
		$old = $_POST;
		require_once ('authentication.php');
		$reg_data = userRegister($_POST);
		
		if($reg_data['status'] == 'error'){
			$errors  = $reg_data['message'];
		}elseif($reg_data['status'] == 'success'){
			$success = $reg_data['message'];
		}
		//print_r($_POST);
	}

?>
<?php include('header.php'); ?>
	                                                                                                                                                                                                                                                                                                                                            
<section>
	<div class="container">
	
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

		<form class="row g-3" method="post">
			  <div class="col-12">
				<label for="reg_name" class="form-label">Name</label>
				<input type="text" class="form-control" id="reg_name" name="reg_name" value="<?php echo $old['reg_name']??''; ?>" placeholder="Full Name">
				<div class="small text-danger"><?php echo ($errors['reg_name']?? ''); ?></div>
			  </div>
			  <div class="col-6">
				<label for="reg_email" class="form-label">email</label>
				<input type="email" class="form-control" id="reg_email" name="reg_email" value="<?php echo $old['reg_email']??''; ?>">
				<div class="small text-danger"><?php echo ($errors['reg_email']?? ''); ?></div>
			  </div>
			  <div class="col-md-6">
				<label for="reg_phone" class="form-label">Phone</label>
				<input type="phone" class="form-control" id="reg_phone" name="reg_phone" value="<?php echo $old['reg_phone']??''; ?>">
				<div class="small text-danger"><?php echo ($errors['reg_phone']?? ''); ?></div>
			  </div>
			  <div class="col-md-6">
				<label for="reg_password" class="form-label">Password</label>
				<input type="password" class="form-control" id="reg_password" name="reg_password" value="<?php echo $old['reg_password']??''; ?>">
				<div class="small text-danger"><?php echo ($errors['reg_password']?? ''); ?></div>
			  </div>
			  <div class="col-md-6">
				<label for="confirm_password" class="form-label">Confirm Password</label>
				<input type="password" class="form-control" id="confirm_password" name="confirm_password">
			  </div>
			  <div class="col-12">
				<button type="submit" class="btn btn-primary" name="registration_submition">Sign in</button>
			  </div>
		</form>
	</div>
</section>

<?php include('footer.php'); ?>
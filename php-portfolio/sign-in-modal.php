<?php 
if(isset($_POST['loginSubmission'])){
	$old = $_POST;
	require('authentication.php');
	$loginData = userLogin($_POST);
	
	if($loginData['status'] == 'error'){
		$errors = $loginData['message'];
	}
	//print_r($_POST);
}
?>
<!-- Modal -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-light">
				<h5 class="modal-title" id="staticBackdropLabel">Welcome Back</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post">
				<div class="modal-body">
					<div class="row mb-3">
						<label for="email" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
						  <input type="email" class="form-control" name="email" id="email" value="<?php echo ($old['email']?? $_COOKIE['email'] ?? ''); ?>">
						  <div class="small text-danger"><?php echo ($errors['email']?? ''); ?></div>
						</div>
					</div>
					<div class="row mb-3">
						<label for="password" class="col-sm-2 col-form-label">Password</label>
						<div class="col-sm-10">
						  <input type="password" class="form-control" id="password" name="password" value="<?php echo ($_COOKIE ['password']?? '')?>">
						  <div class="small text-danger"><?php echo ($errors['password']?? ''); ?></div>
						</div>
					</div>
					<div class="row">
						<div class="">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="remember"<?php echo (isset($_COOKIE ['email'])? 'checked' : '')?>>
								<label class="form-check-label" for="remember">
								  Remember Me
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer bg-light justify-content-between">
					<a href="registration.php" class="text-decoration-none">Register Here</a>
					<button type="submit" name="loginSubmission" class="btn btn-primary px-4">Sign in</button>
				</div>
			</form>
		</div>
	</div>
</div>
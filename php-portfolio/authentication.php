<?php
	
	require_once('db.php');
	
	function userRegister($data){
		//print_r($data);
		$name = $data['reg_name'];
		$email = $data['reg_email'];
		$phone = $data['reg_phone'];
		$password = $data['reg_password'];
		$cPassword = $data['confirm_password'];
		
		$errors = [];
		
		$db_connection = db_connect();
		
		if(strlen($name) < 2 || strlen($name) > 50 || str_word_count($name) < 2){
			$errors['reg_name'] = 'Name Will Be in 3-50 Characters';
		}
		
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors['reg_email'] = 'Invalid Email';
		}else{
			$sql_view = "SELECT * FROM users WHERE email ='$email'";
			$result = mysqli_query($db_connection, $sql_view);
			
			if(mysqli_error($db_connection)){
				die('Table Error: '.mysqli_error($db_connection));
			}
			//return $result;
			if (mysqli_num_rows ($result)> 0){
				
				$errors['reg_email'] = 'Already exist';
			}
		}
		
		
		
		if(strlen($phone) != 11 || preg_match('/\D/', $phone)){
			$errors['reg_phone'] = 'Invalid Phone';
		}
		
		if(strlen($password) < 8 || strlen($password) > 24){
			$errors['reg_password'] = 'Password Will be in 8-24 Characters';
		}
		
		if($cPassword != $password){
			$errors['reg_password'] = 'Confirm Password Does not Match';
		}
	
		
		if(count($errors) > 0){
			$action = [
				'status' => 'error',
				'message' => $errors
			];
			return $action;
		}else{
			
			
			
			$sql_insert = "INSERT INTO users 
					(name, email, phone, password) VALUES 
					('$name', '$email', '$phone', '$password')";
			
			$result = mysqli_query($db_connection, $sql_insert);
			
			if(mysqli_error($db_connection)){
				die('Table Error: '.mysqli_error($db_connection));
			}
			
			$action = [
				'status' => 'success',
				'message' => 'Registration Complete Successfully'
			];
			return $action;
			
		}
		
		
	}
	
	/* function userProfile($data){
		//print_r($data);
		$name = $data['name'];
		$phone = $data['phone'];
		$dob = $data['dob'];
		$gender = $data['gender'];
		$address = $data['address'];
		
		$errors = [];
		
		$db_connection = db_connect();
		
		if(strlen($name) < 2 || strlen($name) > 50 || str_word_count($name) < 2){
			$errors['name'] = 'Name Will Be in 3-50 Characters';
		}
	
		
		if(strlen($phone) != 11 || preg_match('/\D/', $phone)){
			$errors['phone'] = 'Invalid Phone';
		}
		
		if(strlen($dob) != 11 || preg_match('/\D/', $phone)){
			$errors['dob'] = 'Invalid Phone';
		}
		
		
	
		
		if(count($errors) > 0){
			$action = [
				'status' => 'error',
				'message' => $errors
			];
			return $action;
		}else{
			
			
			
			$sql_insert = "INSERT INTO users 
					(name, email, phone, password) VALUES 
					('$name', '$email', '$phone', '$password')";
			
			$result = mysqli_query($db_connection, $sql_insert);
			
			if(mysqli_error($db_connection)){
				die('Table Error: '.mysqli_error($db_connection));
			}
			
			$action = [
				'status' => 'success',
				'message' => 'Registration Complete Successfully'
			];
			return $action;
			
		}
		
		
	}
	 */
	
	function userLogin($data){
		//print_r($data);
		$email = $data['email'];
		$password = $data['password'];
		$remember = $data['remember']??null;
		
		$errors = [];
		
		$db_connection = db_connect();
		
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors['email'] = 'Invalid Email';
		}else{
			$sql_view = "SELECT * FROM users WHERE email ='$email' && password = '$password'";
			$result = mysqli_query($db_connection, $sql_view);
			
			if(mysqli_error($db_connection)){
				die('Table Error: '.mysqli_error($db_connection));
			}
			//return $result;
			if (mysqli_num_rows ($result) == 0){
				
				$errors['email'] = 'Email/Password Does not Match';
			}
			
		}
		
		if(count($errors) > 0){
			$errors['modalError'] = 'loginModal';
			$action = [
				'status' => 'error',
				'message' => $errors
			];
			return $action;
		}
		$_SESSION['Hoise_to'] = 1;
		$_SESSION['auth'] = mysqli_fetch_assoc($result);
		
		
	
		if($remember){
			setcookie('email', $email, time()+(60), '/');
			setcookie('password', $password, time()+(60), '/');
		}else{
			setcookie('email', '', time()+(0), '/');
			setcookie('password', '', time()+(0), '/');
			
		}
		header('Location:dashboard/index.php');
		
	}
	
	function userLogout(){
		session_unset();
		session_destroy();
		header('Location:../index.php');
	}
	
	
	function userProfile($data){
		
		$name= $data['name'];
		$phone= $data['phone'];
		$dob= $data['dob'];
		$gender= $data['gender'];
		$address= $data['address'];
		
		$image_name = $_FILES['profile_image']['name'];
		$image_tmp = $_FILES['profile_image']['tmp_name'];
		$image_size = $_FILES['profile_image']['size'];

		$errors = [];
		
		$db_connection = db_connect();
		
		if(strlen($name) < 2 || strlen($name) > 50 || str_word_count($name) < 2){
			$errors['name'] = 'Name Will Be in 3-50 Characters';
		}
		
		if(strlen($phone) != 11 || preg_match('/\D/', $phone)){
			$errors['phone'] = 'Invalid Phone';
		}
		
		if(strlen($dob) != 10 ){
			$errors['dob'] = 'Invalid date';
		}
		
		if(!in_array($gender, ['male','female'])){
			$errors['gender'] = 'Invalid gender';
		}
		
		if(strlen($address) < 2 || strlen($address) > 100 ){
			$errors['address'] = 'Address Will Be in 3-100 Characters';
		}
		
		$path = $_SESSION['auth']['image']??null;
		if($image_tmp){
			
			$getExtension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
			$new_image_name = time().rand(1111,9999).'.'.$getExtension;
			
			$required_extension = ['jpg','jpeg','png','gif'];
			
			if(!in_array($getExtension,$new_image_name)){
				$errors['profile_image'] = 'Image will be in jpg/jpeg/png/gif format ';
			}elseif($image_size > 1024000){
				$errors['profile_image'] = 'Max size will be 1mb';
			}else{
				if($path && file_exists('../'.$path)){
					unlink('../'.$path);
				}
				$path = 'images/'.$new_image_name;
				move_uploaded_file($image_tmp,'../'.$path);
			}
			
		
		}
		
		if(count($errors)>0){
			$action = [
				'status'=> 'error',
				'message'=> $errors,
			];
			return $action;
		}else{
			$user_id = $_SESSION['auth']['id'];
			$db_connection = db_connect();
			
			$sql_update = "UPDATE users SET
						name = '$name', 
						phone = '$phone',
						dob = '$dob',
						gender = '$gender',
						address = '$address',
						image = '$path'
					WHERE id = '$user_id' ";
			
			$result = mysqli_query($db_connection,$sql_update);
			
			if(mysqli_error($db_connection)){
				die('table error: ' .mysqli_error($db_connection));
			}
			
			$sql_view = "SELECT * FROM users WHERE id ='$user_id'";
			$result = mysqli_query($db_connection,$sql_view);
			if(mysqli_error($db_connection)){
				die('table error: ' .mysqli_error($db_connection));
			}
			$_SESSION['auth'] = mysqli_fetch_assoc($result);
			
			$action = [
				'status' => 'success',
				'message' => 'Profile info updated successfully',
			];
			return $action;
		}
		
	}

?>




<?php
	require_once(__DIR__.'/../db.php');
	
	// content part 
	
	function reviewContent($data){
		
		$content_icon= $data['content_icon'];
		$content_number= $data['content_number'];
		$content_title= $data['content_title'];
		$errors = [];
		
		if(strlen($content_icon) < 2 || strlen($content_icon) > 50){
			$errors['content_icon'] = 'This Will Be in 3-50 Characters';
		}
		
		if(strlen($content_number) > 8 || preg_match('/\D/', $content_number)){
			$errors['content_number'] = 'This Will Be numbers';
		}
		
		
		if(strlen($content_title) < 2 || strlen($content_title) > 100){
			$errors['content_title'] = 'Details Will Be in 3-10 Characters';
		}
		
		if(count($errors)>0){
			$action = [
				'status'=> 'error',
				'message'=> $errors,
			];
			return $action;
		}
		$db_connection = db_connect();
		
		$sql_insert = "INSERT INTO reviews
						(icon, number, title) VALUES 
						('$content_icon', '$content_number', '$content_title')";
		
		$result = mysqli_query($db_connection,$sql_insert);
		
		
		
		if(mysqli_error($db_connection)){
			die('table error: ' .mysqli_error($db_connection));
		}
		$action = [
			'status' => 'success',
			'message' => 'Section content Update completed',
		];
		return $action;
		
		
	}

	function reviewContentEdit($data){
		$editId = $data['editId'];
		$edit_icon = $data['edit_icon'];
		$edit_number = $data['edit_number'];
		$edit_title = $data['edit_title'];
	
		$errors = [];
		
		
		if(strlen($edit_icon) < 3 || strlen($edit_icon) > 100){
			$errors['edit_icon'] = '3-100 Characters required';
		}
		
		if(strlen($edit_number) < 2 || strlen($edit_number) > 30){
			$errors['edit_number'] = 'Numbers required';
		}
		
		if(strlen($edit_title) < 3 || strlen($edit_title) > 100){
			$errors['edit_title'] = '3-100 Characters required';
		}
		
		
		if(count($errors) > 0){
			$errors['modalError'] = "editModal";
			$action = [
				'status' => 'error',
				'message' => $errors
			];
			return $action;
		}
		
		
		$db_connection = db_connect();
		
		
		$sql_update = "UPDATE  reviews SET
					icon = '$edit_icon',  
					number ='$edit_number',
					title = '$edit_title'
				WHERE id = '$editId'";
		
		$result = mysqli_query($db_connection, $sql_update);
			
		
		
		if(mysqli_error($db_connection)){
			die('Table Error: '.mysqli_error($db_connection));
		}
		
		$action = [
			'status' => 'success',
			'message' => 'Update Successfully'
		];
		return $action;
			
	}
	
	function reviewContentVisibility($data){
		
		$visibilityId= $data['visibilityId'];
		
		$db_connection = db_connect();
		$sql_view = "SELECT * FROM reviews WHERE id ='$visibilityId'";
		
		$result = mysqli_query($db_connection,$sql_view);
		
		if(mysqli_error($db_connection)){
			die('table error: ' .mysqli_error($db_connection));
		}
		if(mysqli_num_rows($result)){
			$visibility = mysqli_fetch_assoc($result)['visibility'] == 1 ? 0 : 1;
			
			$sql_update = "UPDATE reviews SET
						visibility = '$visibility'
						WHERE id = '$visibilityId'";
			$result = mysqli_query($db_connection,$sql_update);
		
			if(mysqli_error($db_connection)){
				die('table error: ' .mysqli_error($db_connection));
			}
		}
		
		$action = [
			'status' => 'success',
			'message' => 'Visibility Update completed',
		];
		return $action;
		
		
	}

	function reviewContentDelete($data){
		
		$deleteId= $data['deleteId'];
		
		$db_connection = db_connect();
		
		$sql_delete = "DELETE FROM reviews 
						WHERE id = '$deleteId'";
		$result = mysqli_query($db_connection,$sql_delete);
		
		if(mysqli_error($db_connection)){
			die('table error: ' .mysqli_error($db_connection));
		}
			
		$action = [
			'status' => 'success',
			'message' => 'Content Delete completed',
		];
		return $action;
		
		
	}

	function reviewContentData(){
		$db_connection = db_connect();
		
		$sql_view = "SELECT * FROM reviews ";
		$result = mysqli_query($db_connection,$sql_view);
		if(mysqli_error($db_connection)){
			die('table error: ' .mysqli_error($db_connection));
		}
		
		if(mysqli_num_rows($result) == 0){
			return null;
		}
		return $result;
	}
	
	function reviewContentFrontData(){
		$db_connection = db_connect();
		
		$sql_view = "SELECT * FROM reviews WHERE visibility = 1";
		$result = mysqli_query($db_connection,$sql_view);
		if(mysqli_error($db_connection)){
			die('table error: ' .mysqli_error($db_connection));
		}
		
		if(mysqli_num_rows($result) == 0){
			return null;
		}
		
		$content = array();
		while($data = mysqli_fetch_array($result)){
			$content[] = $data; 
		}
		return $result;
	}
	
?>
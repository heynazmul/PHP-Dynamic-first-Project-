<?php
	require_once(__DIR__.'/../db.php');
	
	// content part 
	function addressContent($data){
		
		$content_icon= $data['content_icon'];
		$content_title= $data['content_title'];
		$content_details= $data['content_details'];
		$errors = [];
		
		if(strlen($content_icon) < 2 || strlen($content_icon) > 50){
			$errors['content_icon'] = 'This Will Be in 3-50 Characters';
		}
		
		if(strlen($content_title) < 2 || strlen($content_title) > 50){
			$errors['content_title'] = 'Title Will Be in 3-50 Characters';
		}
		
		
		if(strlen($content_details) < 2 || strlen($content_details) > 200){
			$errors['content_details'] = 'Details Will Be in 3-50 Characters';
		}
		
		if(count($errors)>0){
			$action = [
				'status'=> 'error',
				'message'=> $errors,
			];
			return $action;
		}
		$db_connection = db_connect();
		
		$sql_insert = "INSERT INTO address
						(icon, title, details) VALUES 
						('$content_icon', '$content_title', '$content_details')";
		
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

	function addressContentEdit($data){
		$editId = $data['editId'];
		$edit_icon = $data['edit_icon'];
		$edit_title = $data['edit_title'];
		$edit_details = $data['edit_details'];
	
		$errors = [];
		
		
		if(strlen($edit_icon) < 3 || strlen($edit_icon) > 100){
			$errors['edit_icon'] = '3-100 Characters required';
		}
		
		if(strlen($edit_title) < 3 || strlen($edit_title) > 100){
			$errors['edit_title'] = '3-100 Characters required';
		}
		
		if(strlen($edit_details) < 3 || strlen($edit_details) > 300){
			$errors['edit_details'] = '3-300 Characters required';
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
		
		
		$sql_update = "UPDATE address SET
					icon = '$edit_icon', 
					title = '$edit_title', 
					details ='$edit_details'
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
	
	function addressContentVisibility($data){
		
		$visibilityId= $data['visibilityId'];
		
		$db_connection = db_connect();
		$sql_view = "SELECT * FROM address WHERE id ='$visibilityId'";
		
		$result = mysqli_query($db_connection,$sql_view);
		
		if(mysqli_error($db_connection)){
			die('table error: ' .mysqli_error($db_connection));
		}
		if(mysqli_num_rows($result)){
			$visibility = mysqli_fetch_assoc($result)['visibility'] == 1 ? 0 : 1;
			
			$sql_update = "UPDATE address SET
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

	function addressContentDelete($data){
		
		$deleteId= $data['deleteId'];
		
		$db_connection = db_connect();
		
		$sql_delete = "DELETE FROM address 
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

	function addressContentData(){
		$db_connection = db_connect();
		
		$sql_view = "SELECT * FROM address";
		$result = mysqli_query($db_connection,$sql_view);
		if(mysqli_error($db_connection)){
			die('table error: ' .mysqli_error($db_connection));
		}
		
		if(mysqli_num_rows($result) == 0){
			return null;
		}
		return $result;
	}
	
	function addressContentFrontData(){
		$db_connection = db_connect();
		
		$sql_view = "SELECT * FROM address WHERE visibility = 1";
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
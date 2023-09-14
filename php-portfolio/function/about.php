<?php
	require_once(__DIR__.'/../db.php');
	
	function aboutHeading($data){
		$title = $data['title'];
		$short_title = $data['short_title'];
		$details = $data['details'];
	
		$errors = [];
		
		
		if(strlen($title) < 3 || strlen($title) > 50){
			$errors['title'] = '3-50 Characters required';
		}
		if(strlen($short_title) < 3 || strlen($short_title) > 50){
			$errors['short_title'] = '3-50 Characters required';
		}
		
		if(strlen($details) < 3 || strlen($details) > 50){
			$errors['details'] = '3-50 Characters required';
		}
		
		if(count($errors) > 0){
			$action = [
				'status' => 'error',
				'message' => $errors
			];
			return $action;
		}
		
		
		$db_connection = db_connect();
		
		$type = 'section-heading';
		
		$sql_view = "SELECT * FROM about_me WHERE type ='$type'";
			$result = mysqli_query($db_connection, $sql_view);
			
			if(mysqli_error($db_connection)){
				die('Table Error: '.mysqli_error($db_connection));
			}
			//return $result;
			if (mysqli_num_rows ($result)== 1){
				
					$sql_update = "Update about_me Set
						title = '$title', short_title = '$short_title' details = '$details'
						WHERE type ='$type'";
						
					$result = mysqli_query($db_connection, $sql_update);
				}else{
					$sql_insert = "INSERT INTO about_me 
								(type, title, short_title, details , visibility) VALUES 
								('$type', '$title', '$short_title', '$details', 1)";
					
					$result = mysqli_query($db_connection, $sql_insert);
				}
			
		
		
		if(mysqli_error($db_connection)){
			die('Table Error: '.mysqli_error($db_connection));
		}
		
		$action = [
			'status' => 'success',
			'message' => 'About update Successfully'
		];
		return $action;
			
	}	
	
	function aboutHeadingData(){
		
		$db_connection = db_connect();
		$sql_view = "SELECT * FROM about_me WHERE type ='section-heading'";
		$result = mysqli_query($db_connection, $sql_view);
		
		if(mysqli_error($db_connection)){
			die('Table Error: '.mysqli_error($db_connection));
		}
		//return $result;
		if (mysqli_num_rows ($result)== 0){
			
			return null;
		}
		
		return mysqli_fetch_assoc($result);
		
	}
	
	function aboutContent($data){
		$Progress_title = $data['Progress_title'];
		$progress_color = $data['progress_color'];
		$progress_percentage = $data['progress_percentage'];
	
		$errors = [];
		
		
		if(strlen($Progress_title) < 3 || strlen($Progress_title) > 50){
			$errors['Progress_title'] = '3-50 Characters required';
		}
		
		if(strlen($progress_color) < 3 || strlen($progress_color) > 50){
			$errors['progress_color'] = '3-50 Characters required';
		}
		
		if(strlen($progress_percentage) < 1 || strlen($progress_percentage) > 50){
			$errors['progress_percentage'] = '3-50 Characters required';
		}
		
		if(count($errors) > 0){
			$action = [
				'status' => 'error',
				'message' => $errors
			];
			return $action;
		}
		
		$db_connection = db_connect();
		
		$sql_insert = "INSERT INTO about_me 
					(title, short_title, details) VALUES 
					('$Progress_title', '$progress_color', '$progress_percentage')";
		
		$result = mysqli_query($db_connection, $sql_insert);
			
		if(mysqli_error($db_connection)){
			die('Table Error: '.mysqli_error($db_connection));
		}
		
		$action = [
			'status' => 'success',
			'message' => 'About skill content update Successfully'
		];
		return $action;	
	}
	
	function aboutContentEdit($data){
		$editId = $data['editId'];
		$edit_title = $data['edit_title'];
		$edit_short_title = $data['edit_short_title'];
		$edit_details = $data['edit_details'];
	
		$errors = [];
		
		
		if(strlen($edit_title) < 3 || strlen($edit_title) > 50){
			$errors['edit_title'] = '3-50 Characters required';
		}
		
		if(strlen($edit_short_title) < 3 || strlen($edit_short_title) > 50){
			$errors['edit_short_title'] = '3-50 Characters required';
		}
		
		if(strlen($edit_details) < 0 || strlen($edit_details) > 10){
			$errors['edit_details'] = '3-50 Characters required';
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
		
		
		$sql_update = "UPDATE  about_me SET
					title = '$edit_title', 
					short_title = '$edit_short_title', 
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
	
	function aboutContentVisibility($data){
		$visibilityId = $data['visibilityId'];
	
		
		$db_connection = db_connect();
		
		$sql_view = "SELECT * FROM about_me WHERE id ='$visibilityId'";
		
		$result = mysqli_query($db_connection, $sql_view);
			
		if(mysqli_num_rows($result) == 1){
			
			$visibility = mysqli_fetch_assoc($result)['visibility'] == 1 ? 0 : 1;
			
			if(mysqli_error($db_connection)){
				die('Table Error: '.mysqli_error($db_connection));
			}
			
			$sql_update = "UPDATE  about_me SET
							visibility = '$visibility'
							where id ='$visibilityId'";
			
			$result = mysqli_query($db_connection, $sql_update);
				
			
			
			if(mysqli_error($db_connection)){
				die('Table Error: '.mysqli_error($db_connection));
			}
		
		}
		
		
		$action = [
			'status' => 'success',
			'message' => 'Visibility update Successfully'
		];
		return $action;
			
	}
	
	function aboutContentdelete($data){
		$deleteId = $data['deleteId'];
	
		
		$db_connection = db_connect();
		
			
			$sql_delete = "DELETE FROM  about_me 
							where id ='$deleteId'";
			
			$result = mysqli_query($db_connection, $sql_delete);
				
			
			
			if(mysqli_error($db_connection)){
				die('Table Error: '.mysqli_error($db_connection));
			}
		
		
		$action = [
			'status' => 'success',
			'message' => 'Delete Successfully'
		];
		return $action;
			
	}
	
	
	function aboutContentData(){
		
		$db_connection = db_connect();
		$sql_view = "SELECT * FROM about_me WHERE type ='content'";
			$result = mysqli_query($db_connection, $sql_view);
			
			if(mysqli_error($db_connection)){
				die('Table Error: '.mysqli_error($db_connection));
			}
			//return $result;
			if (mysqli_num_rows ($result)== 0){
				
				return null;
			}
		
		return ($result);
		
	}
	
	function aboutContentFrontData(){
		
		$db_connection = db_connect();
		$sql_view = "SELECT * FROM about_me WHERE type ='content' and visibility = 1";
			$result = mysqli_query($db_connection, $sql_view);
			
			if(mysqli_error($db_connection)){
				die('Table Error: '.mysqli_error($db_connection));
			}
			//return $result;
			if (mysqli_num_rows ($result)== 0){
				
				return null;
			}
		$content = array();
		while($data = mysqli_fetch_array($result)){
			$content[] =$data;
		}
		return $content;
		
	}
	 
?>
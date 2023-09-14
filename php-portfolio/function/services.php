<?php
	require_once(__DIR__.'/../db.php');
	
	function sectionHeadingData(){
		
		$db_connection = db_connect();
		$sql_view = "SELECT * FROM services WHERE type ='section-heading'";
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
	
	function sectionHeading($data){
		$section_title = $data['section_title'];
		$section_details = $data['section_details'];
	
		$errors = [];
		
		
		if(strlen($section_title) < 3 || strlen($section_title) > 50){
			$errors['section_title'] = '3-50 Characters required';
		}
		
		if(strlen($section_details) < 3 || strlen($section_details) > 50){
			$errors['section_details'] = '3-50 Characters required';
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
		
		$sql_view = "SELECT * FROM services WHERE type ='$type'";
			$result = mysqli_query($db_connection, $sql_view);
			
			if(mysqli_error($db_connection)){
				die('Table Error: '.mysqli_error($db_connection));
			}
			//return $result;
			if (mysqli_num_rows ($result)== 1){
				
					$sql_update = "Update services Set
						title = '$section_title', details = '$section_details'
						WHERE type ='$type'";
						
					$result = mysqli_query($db_connection, $sql_update);
				}else{
					$sql_insert = "INSERT INTO services 
								(type, title, details , visibility) VALUES 
								('$type', '$section_title', '$section_details', 1)";
					
					$result = mysqli_query($db_connection, $sql_insert);
				}
			
		
		
		if(mysqli_error($db_connection)){
			die('Table Error: '.mysqli_error($db_connection));
		}
		
		$action = [
			'status' => 'success',
			'message' => 'section update Successfully'
		];
		return $action;
			
	}	
	
	function sectionContent($data){
		$content_icon = $data['content_icon'];
		$content_title = $data['content_title'];
		$content_details = $data['content_details'];
	
		$errors = [];
		
		
		if(strlen($content_icon) < 3 || strlen($content_icon) > 50){
			$errors['content_icon'] = '3-50 Characters required';
		}
		
		if(strlen($content_title) < 3 || strlen($content_title) > 50){
			$errors['content_title'] = '3-50 Characters required';
		}
		
		if(strlen($content_details) < 3 || strlen($content_details) > 50){
			$errors['content_details'] = '3-50 Characters required';
		}
		
		if(count($errors) > 0){
			$action = [
				'status' => 'error',
				'message' => $errors
			];
			return $action;
		}
		
		
		$db_connection = db_connect();
		
		
		$sql_insert = "INSERT INTO services 
					(icon, title, details) VALUES 
					('$content_icon', '$content_title', '$content_details')";
		
		$result = mysqli_query($db_connection, $sql_insert);
			
		
		
		if(mysqli_error($db_connection)){
			die('Table Error: '.mysqli_error($db_connection));
		}
		
		$action = [
			'status' => 'success',
			'message' => 'content update Successfully'
		];
		return $action;
			
	}
	
	function sectionContentEdit($data){
		$editId = $data['editId'];
		$edit_icon = $data['edit_icon'];
		$edit_title = $data['edit_title'];
		$edit_details = $data['edit_details'];
	
		$errors = [];
		
		
		if(strlen($edit_icon) < 3 || strlen($edit_icon) > 50){
			$errors['edit_icon'] = '3-50 Characters required';
		}
		
		if(strlen($edit_title) < 3 || strlen($edit_title) > 50){
			$errors['edit_title'] = '3-50 Characters required';
		}
		
		if(strlen($edit_details) < 3 || strlen($edit_details) > 50){
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
		
		
		$sql_update = "UPDATE  services SET
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
	
	
	function sectionContentVisibility($data){
		$visibilityId = $data['visibilityId'];
	
		
		$db_connection = db_connect();
		
		$sql_view = "SELECT * FROM services WHERE id ='$visibilityId'";
		
		$result = mysqli_query($db_connection, $sql_view);
			
		if(mysqli_num_rows($result) == 1){
			
			$visibility = mysqli_fetch_assoc($result)['visibility'] == 1 ? 0 : 1;
			
			if(mysqli_error($db_connection)){
				die('Table Error: '.mysqli_error($db_connection));
			}
			
			$sql_update = "UPDATE  services SET
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
	
	function sectionContentdelete($data){
		$deleteId = $data['deleteId'];
	
		
		$db_connection = db_connect();
		
			
			$sql_delete = "DELETE FROM  services 
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
	
	
	function sectionContentData(){
		
		$db_connection = db_connect();
		$sql_view = "SELECT * FROM services WHERE type ='content'";
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
	
	function sectionContentFrontData(){
		
		$db_connection = db_connect();
		$sql_view = "SELECT * FROM services WHERE type ='content' and visibility = 1";
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
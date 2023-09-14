<?php

	/* echo '<pre>';
	echo 'get method';
	print_r($_GET);
	echo  '</pre>'; */

	function contactinfo(){
		
		$name = $_GET['name'];
		$phone = $_GET['phone'];
		$email = $_GET['email'];
		$message = $_GET['message'];
		
		$error =[];

		 if(strlen($name) <3 || strlen($name) <50 || str_word_count($name) >1){
			$error['name']= 'Name is invalid'. '<br>';
		 }
		 
		if(!filter_var($email, FILTER_VALIDATE_EMAIL) ){
			$error['mail']= 'Mail is invalid';
		}
			
		if(strlen($phone) !=11 || preg_match ('/\D/',$phone)){
			$error['phone']= 'Number is invalid' . '<br>';
		}
		
		if(strlen($message) <3 || strlen($message) > 5000){
			$error['message']= 'Message is invalid' . '<br>';
		}
		
		if(count($error)> 0 ){
			$action=[
				'status'=> 'error',
				'message'=> $error,
			];
			return $action;
		}else{
			
			echo 'Email aise';
			$to = 'heynazmulhossain@gmail.com';
			$sub = 'from my website';
			$message = '$message';
			$message .= "/n";
			$message .= 'phone';
			$message .= "/n";
			$message .= 'name';
			$message .= "/n";
			$message .= 'email';
			$sender = 'email';
			//builtin method in 4 peramitter 'to', 'subject', 'message', 'sender',
			mail($to, $sub, $message, 'form', $sender);
			$action=[
				'status'=> 'success',
				'message'=> 'Message sent successfull',
			];
			return $action;
		}
	}
	
?>
<?php

	echo '<pre>';
	echo 'get method';
	print_r($_GET);
	echo  '</pre>';
	
	phpinfo();
	
	$name= $_GET['name'];
	$phone= $_GET['phone'];
	$email= $_GET['email'];
	$message= $_GET['message'];

	if(strlen($name) > 2 &&($name))<50 && str_word_count >1 {
		echo ('kam Sarse')
	}else{
		echo ('Akam hoise')
	}


?>
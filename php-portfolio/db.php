<?php

function db_connect(){
	$db_host = 'localhost';
	$db_user = 'root';
	$db_password = '';
	$db_name = 'pfswd_03';


	$connect = mysqli_connect($db_host, $db_user, $db_password, $db_name);
	



	
	return $connect;
}
	
	//print_r(db_connect());
?>
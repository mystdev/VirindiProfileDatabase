<?php 
include_once('config.inc.php');
include_once('functions.php');



		
		
	$sql="INSERT into user_info (user_id, username) VALUES (Null, 'asde')";
	$conn = db_connect();
	$err = FALSE;
	$conn->autocommit(FALSE);
	$result = $conn->query($sql);
	
	commit();
	echo $result;
	
		
		
		
		

	
	
	
	
	
	
	
	
	
	



















?>
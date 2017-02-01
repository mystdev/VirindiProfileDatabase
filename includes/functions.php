<?php
include('config.inc.php');


	
function run_query($sql) {
	$dbconn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	$err = mysqli_connect_error($dbconn);
	$result = @mysqli_query($dbconn,$sql) or die ('Error: ' .mysqli_error($dbconn) .@$err1);
	mysqli_close($dbconn);
	return $result;
}
	
function sqlinj ($input) {
	mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	if(get_magic_quotes_gpc()){
		$input = stripslashes($input);
		
	}
		return mysql_real_escape_string($input);
}

function getExtension($route_name) {
	
	return substr($route_name, strrpos($route_name, '.') + 1);
}


function upload_form_routes() {
	
echo '	<form enctype="multipart/form-data" method="post" action="upload_route.php">
		<legend>Title:</legend>
		<input type="text" name="title" />
		<legend>Description:</legend>
		<input type="text" name="desc" />
		<legend>Select route to be uploaded:</legend>
		<input type="file" name="route" id="route" />
		<input type="submit" name="upload_route" value="Upload Route"/>
		</form>';
	}	
	
function upload_form_loot() {
	
echo '	<form enctype="multipart/form-data" method="post" action="upload_loot.php">
		<legend>Title:</legend>
		<input type="text" name="title" />
		<legend>Description:</legend>
		<input type="text" name="desc" />
		<legend>Select loot profile to be uploaded:</legend>
		<input type="file" name="loot" id="loot" />
		<input type="submit" name="upload_loot" value="Upload Loot Profile"/>
		</form>';
	}	
	


?>
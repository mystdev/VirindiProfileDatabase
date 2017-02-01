<?php
ob_start();
$pagetitle = 'VPD Personal Profile Page';
include_once('includes/header.php');
include('includes/functions.php');
session_start();
?>
<div id="container">
<?php

$action = @$_GET['action'];
$err = @$_GET['err'];
@$user = $_SESSION['user'];
@$user_id = $_SESSION['userid'];


		if(isset($_SESSION['user'])){ 
		
		echo 'Welcome to your profile page '.$user.' here you may upload new routes or loot profiles, and delete any previously uploaded ones:<br /><br />';
		echo '<a href="profile.php?action=upload_route">Upload route profiles</a><br />';
		echo '<a href="profile.php?action=delete_route">Delete route profiles</a><br />';
		echo '<a href="profile.php?action=update_route">Update route profiles</a><br /><br />';
		echo '<div id="lootoptions">';
		echo '<a href="profile.php?action=upload_loot">Upload loot profiles</a><br />';
		echo '<a href="profile.php?action=delete_loot">Delete loot</a><br />';
		echo '<a href="profile.php?action=update_loot">Update loot profiles</a><br />';
		echo '</div>';
		echo '<a href="logout.php">Logout</a> | <a href="index.php">View all profiles</a><br /><br />';
		}else{
			
			echo "Permission Fail";
		}

?>

<?php
//HANDLES ROUTE PROFILES

if ($action == 'delete_route' && isset($_SESSION['user'])) {
	
	
		$sql = "SELECT * FROM route_profiles WHERE user_id = '$user_id'";
		$result = run_query($sql);
		

		echo '<table>';
		echo '<th class="title">Title</th><th class="description">Description</th><th class="updated">Last Updated</th><th class="delete">Delete</th>';

		
		while ($row = mysqli_fetch_array($result)){
		

			$title = $row['title'];
			$filename = $row['filename'];
			$description = $row['description'];
			$date = $row['date'];

			
			echo'<tr>';
			echo'<td>'.$title.'</td><td>'.$description.'</td><td>'.$date.'</td>';
	
			echo'
				<td>
				<form method="post" action="delete_route.php">
				<input type="hidden" name="filename" value="'.$filename.'"/>
				<input type="submit" name="delete" value="delete"></td>
				</form>';
				
			echo '</tr>';

}

		echo '</table>';
}


?>

<div class="forms">
<?php


if($action == 'upload_route' && isset($_SESSION['user'])) {
	
	upload_form_routes();
	
}else{
	if($action == 'upload_route_error' && $err == 0) {
		upload_form_routes();
		echo "Please fill out all fields.";
	}else{
		if($action == 'upload_route_error' && $err == 1) {
		upload_form_routes();
		echo "Incorrect filetype, please select a .nav file.";
			
		}else{
			if($action == 'upload_route_error' && $err == 2){
				upload_form_routes();
				echo "File size cannot exceed 500kb.";

			}else{
				if($action == 'upload_route_error' && $err == 3){
				upload_form_routes();
				echo "A file with that name already exist.";	
				
				}else{
					if($action == 'success'){
						upload_form_routes();
						echo "You're route has been successfully uploaded.";
						
					}
				}
			}
			
		}
		
	}
}



?>
</div>
<div class="forms">
<?php


if($action == 'update_route' && isset($_SESSION['user'])) {
	
	
			
		echo '<form method="post" action="profile.php?action=update_route">';
		echo '<select name="upload_id">';
		
		$sql = "SELECT * FROM route_profiles WHERE user_id = '$user_id'";
		$result = run_query($sql);


		
		while ($row = mysqli_fetch_array($result)){
		
			
			$title = $row['title'];
			$uploadid = $row['upload_id'];
			$filename = $row['filename'];
			$description = $row['description'];
			$date = $row['date'];
			
		echo '<option value="'.$uploadid.'">'.$title.'</option>';
		
}

echo '</select>';
echo '<input type="submit" name="update_route" value="Update" />';
echo '</form>';




	
}else{
	if($action == 'update_route_error' && $err == 0) {
		
		echo "Please fill out all fields.";
		header('refresh:3; url=profile.php?action=update_route');
	}else{
		if($action == 'update_route_error' && $err == 1) {
		
		echo "Incorrect filetype, please select a .nav file.";
		header('refresh:3; url=profile.php?action=update_route');		
			
		}else{
			if($action == 'update_route_error' && $err == 2){
			
				echo "File size cannot exceed 100kb.";
				header('refresh:3; url=profile.php?action=update_route');
			}else{
				if($action == 'update_route_error' && $err == 3){
			
				echo "A file with that name already exist.";	
				header('refresh:3; url=profile.php?action=update_route');				
				}else{
					if($action == 'update_success'){
						
						echo "You're route has been successfully updated.";
						header('refresh:3; url=profile.php?action=update_route');
						
					}
				}
			}
			
		}
		
	}
}

?>

</div>
<div class="forms">

<?php
	$retrieve = @$_POST['upload_id'];
	$sql = "SELECT * FROM route_profiles WHERE upload_id = '$retrieve'";
	$result = run_query($sql);

	
if(isset($_POST['update_route'])) {
	
	
	while ($row = mysqli_fetch_array($result)) {
		
			$title = $row['title'];
			$upload_id = $row['upload_id'];
			$filename = $row['filename'];
			$description = $row['description'];
			$date = $row['date'];
		

	
echo '	<form enctype="multipart/form-data" method="post" action="update_route.php">
		<input type="hidden" name="upload_id" value="'.$upload_id.'" />
		<input type="hidden" name="filename" value="'.$filename.'" />
		<legend>Title:</legend>
		<input type="text" name="title" value="'.$title.'" />
		<legend>Description:</legend>
		<input type="text" name="desc" value="'.$description.'" />
		<legend>Select route to be uploaded:</legend>
		<input type="file" name="route" id="route"/>
		<input type="submit" name="update_route" value="Update Route"/>
		</form>';
		
		
		
echo 'Please note that you required to reselect the profile to be uploaded when updating (Won\'t update unless you re-upload the profile).';
	}	
	
		
		
		
	}
?>

</div>
<?php
if ($action == 'delete_loot' && isset($_SESSION['user'])) {
	
	
		$sql = "SELECT * FROM loot_profiles WHERE user_id = '$user_id'";
		$result = run_query($sql);
		

		echo '<table>';
		echo '<th class="title">Title</th><th class="description">Description</th><th class="updated">Last Updated</th><th class="delete">Delete</th>';

		
		while ($row = mysqli_fetch_array($result)){
		

			$title = $row['title'];
			$filename = $row['filename'];
			$description = $row['description'];
			$date = $row['date'];

			
			echo'<tr>';
			echo'<td>'.$title.'</td><td>'.$description.'</td><td>'.$date.'</td>';
	
			echo'
				<td>
				<form method="post" action="delete_loot.php">
				<input type="hidden" name="filename" value="'.$filename.'"/>
				<input type="submit" name="delete" value="delete"></td>
				</form>';
				
			echo '</tr>';

}

		echo '</table>';
}


?>
<div class="forms">
<?php
//HANDLES LOOT PROFILES

if($action == 'upload_loot' && isset($_SESSION['user'])) {
	
	upload_form_loot();
	
}else{
	if($action == 'upload_loot_error' && $err == 0) {
		upload_form_loot();
		echo "Please fill out all fields.";
	}else{
		if($action == 'upload_loot_error' && $err == 1) {
		upload_form_loot();
		echo "Incorrect filetype, please select a .utl file.";
			
		}else{
			if($action == 'upload_loot_error' && $err == 2){
				upload_form_loot();
				echo "File size cannot exceed 500kb.";

			}else{
				if($action == 'upload_loot_error' && $err == 3){
				upload_form_loot();
				echo "A file with that name already exist.";	
				
				}else{
					if($action == 'loot_success'){
						upload_form_loot();
						echo "Your loot profile has been successfully uploaded.";
						
					}
				}
			}
			
		}
		
	}
}



?>

<?php


if($action == 'update_loot' && isset($_SESSION['user'])) {
	
	
			
		echo '<form method="post" action="profile.php?action=update_loot">';
		echo '<select name="upload_id">';
		
		$sql = "SELECT * FROM loot_profiles WHERE user_id = '$user_id'";
		$result = run_query($sql);


		
		while ($row = mysqli_fetch_array($result)){
		
			
			$title = $row['title'];
			$uploadid = $row['upload_id'];
			$filename = $row['filename'];
			$description = $row['description'];
			$date = $row['date'];
			
		echo '<option value="'.$uploadid.'">'.$title.'</option>';
		
}

echo '</select>';
echo '<input type="submit" name="update_loot" value="Update" />';
echo '</form>';




	
}else{
	if($action == 'update_loot_error' && $err == 0) {
		
		echo "Please fill out all fields.";
		header('refresh:3; url=profile.php?action=update_loot');
	}else{
		if($action == 'update_loot_error' && $err == 1) {
		
		echo "Incorrect filetype, please select a .nav file.";
		header('refresh:3; url=profile.php?action=update_loot');		
			
		}else{
			if($action == 'update_loot_error' && $err == 2){
			
				echo "File size cannot exceed 100kb.";
				header('refresh:3; url=profile.php?action=update_loot');
			}else{
				if($action == 'update_loot_error' && $err == 3){
			
				echo "A file with that name already exist.";	
				header('refresh:3; url=profile.php?action=update_loot');				
				}else{
					if($action == 'update_loot_success'){
						
						echo "Your loot profile has been successfully updated.";
						header('refresh:3; url=profile.php?action=update_loot');
						
					}
				}
			}
			
		}
		
	}
}

?>




<?php
	$retrieve = @$_POST['upload_id'];
	$sql = "SELECT * FROM loot_profiles WHERE upload_id = '$retrieve'";
	$result = run_query($sql);

	
if(isset($_POST['update_loot'])) {
	
	
	while ($row = mysqli_fetch_array($result)) {
		
			$title = $row['title'];
			$upload_id = $row['upload_id'];
			$filename = $row['filename'];
			$description = $row['description'];
			$date = $row['date'];
		

	
echo '	<form enctype="multipart/form-data" method="post" action="update_loot.php">
		<input type="hidden" name="upload_id" value="'.$upload_id.'" />
		<input type="hidden" name="filename" value="'.$filename.'" />
		<legend>Title:</legend>
		<input type="text" name="title" value="'.$title.'" />
		<legend>Description:</legend>
		<input type="text" name="desc" value="'.$description.'" />
		<legend>Select loot to be uploaded:</legend>
		<input type="file" name="loot" id="loot"/>
		<input type="submit" name="update_loot" value="Update loot"/>
		</form>';
		
		
		
echo 'Please note that you required to reselect the profile to be uploaded when updating (Won\'t update unless you re-upload the profile).';
	}	
	
		
		
		
	}

?>
</div>

<?php

include_once('includes/footer.php');

ob_flush();

?>
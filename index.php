<?php
ob_start();
$pagetitle = 'Virindi Profiles Database';
include_once('includes/header.php');
include('includes/functions.php');
session_start();
?>



<?php 
//Displays login form

		if(!isset($_SESSION['user']) && !isset($_SESSION['userid'])){ 
			echo '	
					<h1>Virindi Profiles Database</h1>
					<p>The profile listing has been made private, please create an account to view the uploaded profiles.</p>
					<div id="rightlogin"></div>					
					<div id="loginform">
					<form method="post" action="index.php">
					<legend>Username: </legend>
					<input type="text" name="username" />
					<legend>Password: </legend>
					<input type="password" name="password" />
					<input type="submit" name="login" value="Login" />
					</form>
					<a href="register.php">Register</a>
					</div>
				';

}
?>
<?php


//Displays error if all fields weren't filled, or details were incorrectly entered

if (isset($_POST['login']) && ($_POST['username'] == '' || $_POST['password'] == '')) {

	echo "<p>Please fill out all fields.</p>";

	}else{
		
		if(isset($_POST['login'])) {
						$user = $_POST['username'];
						$pass = sha1($_POST['password']);
					
						$sql = "SELECT * FROM user_info, shadow WHERE user_info.username = '$user' AND user_info.user_id = shadow.user_id AND shadow.pass = '$pass' AND user_info.approved = 'yes' ";
						$result = run_query($sql);
						$row = mysqli_fetch_array($result);
						$userid = $row['user_id'];
						$count = mysqli_num_rows($result);
						if ($count == 1) {
							
							$_SESSION['user'] = $user;
							$_SESSION['userid'] = $userid;
							header('Location:index.php');

						}else {
							
						if (isset($_POST['login'])) {
							$user = $_POST['username'];
							$pass = sha1($_POST['password']);
						
							$sql = "SELECT * FROM user_info, shadow WHERE user_info.username = '$user' AND user_info.user_id = shadow.user_id AND shadow.pass = '$pass' AND user_info.approved = 'no' ";
							$result = run_query($sql);
							$row = mysqli_fetch_array($result);
							$userid = $row['user_id'];
							$count = mysqli_num_rows($result);
							if ($count == 1) {
								
							echo '<p>Your account hasn\'t been activated yet.</p>';
							}else{
								
							echo '<p>Incorrect Details</p>';	
								
							}
						}
									
		}
		
	}
}
	
//If login successful, display profile link and uploaded profiles

if(isset($_SESSION['user']) && isset($_SESSION['userid'])) {
	
	echo '<a href="logout.php">Logout</a> | ';
	echo '<a href="profile.php">Edit Profile</a> |';
	echo '<a href="downloads.php">Downloads</a>';
	
											  
		$sql = "SELECT * FROM route_profiles, user_info WHERE user_info.user_id = route_profiles.user_id";
		$result = run_query($sql);
		
		echo '<h2>Route Profiles</h2>';
		echo '<p>(Right click download and click "Save Link As")</p>';
		echo '<table>';
		echo '<th class="title">Title</th><th class="description">Description</th><th class="uploader">Uploader</th><th class="updated">Last Updated</th><th class="download">Download</th>';	

		
		while ($row = mysqli_fetch_array($result)){
		

			$title = $row['title'];
			$filename = $row['filename'];
			$description = $row['description'];
			$date = $row['date'];
			$uploader = $row['username'];

			
			echo'<tr>';
			echo'<td>'.$title.'</td><td>'.$description.'</td><td>'.$uploader.'</td><td>'.$date.'</td><td><a href="uploads/routes/'.$filename.'">Download</a></td>';
			echo '</tr>';

}

		echo '</table>';	
		
		$sql = "SELECT * FROM loot_profiles, user_info WHERE user_info.user_id = loot_profiles.user_id";
		$result = run_query($sql);		
		echo '<h2>Loot Profiles</h2>';
		echo '<p>(Right click download and click "Save Link As")</p>';
		echo '<table>';
		echo '<th class="title">Title</th><th class="description">Description</th><th class="uploader">Uploader</th><th class="updated">Last Updated</th><th class="download">Download</th>';	

		while ($row = mysqli_fetch_array($result)){
		

			$title = $row['title'];
			$filename = $row['filename'];
			$description = $row['description'];
			$date = $row['date'];
			$uploader = $row['username'];

			
			echo'<tr>';
			echo'<td>'.$title.'</td><td>'.$description.'</td><td>'.$uploader.'</td><td>'.$date.'</td><td><a href="uploads/loot/'.$filename.'">Download</a></td>';
			echo '</tr>';		
	}
		echo '</table>';	
}
?>


<?php

include_once('includes/footer.php');

ob_flush();
?>



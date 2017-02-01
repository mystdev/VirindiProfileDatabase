<?php
ob_start();
$pagetitle = 'VPD Registration';
include_once('includes/header.php');
include('includes/functions.php');
session_start();
?>

<h1>Virindi Profiles Database Registration</h1>
<p>Enter your desired Username and Password.</p>
    <div id="rightlogin"></div>					
    <div id="loginform">
    
    <form method="post" action="register.php">
    <legend>Desired Username: </legend>
    <input type="text" name="username" />
    <legend>Desired Password: </legend>
    <input type="password" name="password" />
    <input type="submit" name="register" value="Register" />
    </form>
    </div>






<?php

$ip = $_SERVER['REMOTE_ADDR'];



if (isset($_POST['register']) && ($_POST['username'] == '' || $_POST['password'] == '')) {

	echo "<p>Please fill out all fields.</p>";
}else{


				
			@$user = $_POST['username'];
			@$pass = sha1($_POST['password']);
					
			$sql = "SELECT * FROM user_info WHERE username = '$user'";
			$result = run_query($sql);
			$rows = mysqli_num_rows($result);
		

			


		if(isset($_POST['register']) && $rows > 0) {
			echo "<br /><br /><p>That username already exist, please choose another one.</p>";
						
						
			}else {
				
				if (isset($_POST['register']) && $rows == 0) {
						$user = $_POST['username'];
						$pass = sha1($_POST['password']);
					
						$sql = "INSERT into user_info (user_id, username, user_ip, reg_date, approved) VALUES (Null, '$user', '$ip', Null, DEFAULT)";
						$result = run_query($sql);
						
						$sql = "INSERT into shadow (user_id, pass) VALUES (Null, '$pass')";
						$result = run_query($sql);
						
						echo "<br /><br /><p>You've succesfully registered with the site. You're account will need to activated by an adminstrator.</p>";
						echo "<p>You can PM your username to <b>gonzalis</b> on Postcount to help speed this process up.";
						echo "<p>Return to <a href='http://vpd.mystdev.com'>[Index]</a></p>";
					
					
					
				}
				
				
				
			}
	}

?>

<?php

include_once('includes/footer.php');
ob_flush();


?>

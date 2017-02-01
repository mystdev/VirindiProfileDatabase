<?php ob_start();
?>
<?php
include('includes/functions.php');
session_start();
@$user_id = $_SESSION['userid'];
$ip = $_SERVER['REMOTE_ADDR'];
if (isset($_POST['upload_route']) && ($_POST['title'] == '' || $_POST['desc'] == '' || empty($_FILES['route']['name']))) {
		
	header('Location:profile.php?action=upload_route_error&err=0');
	
	}else{
		$route_name = @$_FILES['route']['name'];
		$ext = getExtension($route_name);
		
		if(isset($_POST['upload_route']) && $ext != 'nav') {

			 header('Location:profile.php?action=upload_route_error&err=1');
		
		}else{
			
			if(isset($_POST['upload_route']) && $_FILES['route']['size'] > 502400){
				
				header('Location:profile.php?action=upload_route_error&err=2');
	
	
			}else{
				
				if (isset($_POST['upload_route']) && (file_exists("uploads/routes/" . $_FILES['route']['name']))) {
								 
					
					header('Location:profile.php?action=upload_route_error&err=3');
				}else{
					$title = htmlentities($_POST['title']);
					$desc = htmlentities($_POST['desc']);
						 move_uploaded_file($_FILES["route"]["tmp_name"], "uploads/routes/" . $_FILES["route"]["name"]);
						 $sql = "INSERT into route_profiles (user_id, upload_id, filename, title, description, date, uploaders_ip) VALUES ('$user_id', NULL, '$route_name', '$title', '$desc', NULL, '$ip')";
						 $result = run_query($sql);
							header('Location:profile.php?action=success');
					
					
				
					
					
					}

				}
			}
		}
			echo "Permissions";

		
?>

<?php
ob_flush();
?>
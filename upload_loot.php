<?php ob_start();
?>
<?php
include('includes/functions.php');
session_start();
@$user_id = $_SESSION['userid'];
$ip = $_SERVER['REMOTE_ADDR'];
if (isset($_POST['upload_loot']) && ($_POST['title'] == '' || $_POST['desc'] == '' || empty($_FILES['loot']['name']))) {
		
	header('Location:profile.php?action=upload_loot_error&err=0');
	
	}else{
		$loot_name = @$_FILES['loot']['name'];
		$ext = getExtension($loot_name);
		
		if(isset($_POST['upload_loot']) && $ext != 'utl') {

			 header('Location:profile.php?action=upload_loot_error&err=1');
		
		}else{
			
			if(isset($_POST['upload_loot']) && $_FILES['loot']['size'] > 502400){
				
				header('Location:profile.php?action=upload_loot_error&err=2');
	
	
			}else{
				
				if (isset($_POST['upload_loot']) && (file_exists("uploads/loot/" . $_FILES['loot']['name']))) {
								 
					
					header('Location:profile.php?action=upload_loot_error&err=3');
				}else{
					$title = htmlentities($_POST['title']);
					$desc = htmlentities($_POST['desc']);
						 move_uploaded_file($_FILES["loot"]["tmp_name"], "uploads/loot/" . $_FILES["loot"]["name"]);
						 $sql = "INSERT into loot_profiles (user_id, upload_id, filename, title, description, date, uploaders_ip) VALUES ('$user_id', NULL, '$loot_name', '$title', '$desc', NULL, '$ip')";
						 $result = run_query($sql);
							header('Location:profile.php?action=loot_success');
					
					
				
					
					
					}

				}
			}
		}
			echo "Permissions";

		
?>

<?php
ob_flush();
?>
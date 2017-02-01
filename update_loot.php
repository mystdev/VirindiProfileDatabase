<?php ob_start();
?>
<?php
include('includes/functions.php');
session_start();
@$user_id = $_SESSION['userid'];
$ip = $_SERVER['REMOTE_ADDR'];

$filename = $_POST['filename'];

unlink("uploads/loot/".$filename);	

if (isset($_POST['update_loot']) && ($_POST['title'] == '' || $_POST['desc'] == '' || empty($_FILES['loot']['name']))) {
		
	header('Location:profile.php?action=update_loot_error&err=0');
	
	}else{
		$loot_name = @$_FILES['loot']['name'];
		$ext = getExtension($loot_name);
		
		if(isset($_POST['update_loot']) && $ext != 'utl') {

			 header('Location:profile.php?action=update_loot_error&err=1');
		
		}else{
			
			if(isset($_POST['update_loot']) && $_FILES['loot']['size'] > 502400){
				
				header('Location:profile.php?action=update_loot_error&err=2');
	
	
			}else{
				
				if (isset($_POST['update_loot']) && (file_exists("uploads/loot/" . $_FILES['loot']['name']))) {
								 
					
					header('Location:profile.php?action=update_loot_error&err=3');
				}else{
					$title = htmlentities($_POST['title']);
					$desc = htmlentities($_POST['desc']);
					$upload_id = $_POST['upload_id'];
						 move_uploaded_file($_FILES["loot"]["tmp_name"], "uploads/loot/" . $_FILES["loot"]["name"]);
						 $sql = "UPDATE loot_profiles SET title='$title', filename='$loot_name', description='$desc', date=NULL, uploaders_ip ='$ip' WHERE upload_id='$upload_id'";
						 $result = run_query($sql);
							header('Location:profile.php?action=update_loot_success');
					
					
				
					
					
					}

				}
			}
		}
			echo "Permissions";

			
?>

<?php
ob_flush();
?>
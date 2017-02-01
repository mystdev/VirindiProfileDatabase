<?php ob_start();
?>
<?php
include('includes/functions.php');
session_start();
@$user_id = $_SESSION['userid'];
$ip = $_SERVER['REMOTE_ADDR'];

$filename = $_POST['filename'];

unlink("uploads/routes/".$filename);	

if (isset($_POST['update_route']) && ($_POST['title'] == '' || $_POST['desc'] == '' || empty($_FILES['route']['name']))) {
		
	header('Location:profile.php?action=update_route_error&err=0');
	
	}else{
		$route_name = @$_FILES['route']['name'];
		$ext = getExtension($route_name);
		
		if(isset($_POST['update_route']) && $ext != 'nav') {

			 header('Location:profile.php?action=update_route_error&err=1');
		
		}else{
			
			if(isset($_POST['update_route']) && $_FILES['route']['size'] > 502400){
				
				header('Location:profile.php?action=update_route_error&err=2');
	
	
			}else{
				
				if (isset($_POST['update_route']) && (file_exists("uploads/routes/" . $_FILES['route']['name']))) {
								 
					
					header('Location:profile.php?action=update_route_error&err=3');
				}else{
					$title = htmlentities($_POST['title']);
					$desc = htmlentities($_POST['desc']);
					$upload_id = $_POST['upload_id'];
						 move_uploaded_file($_FILES["route"]["tmp_name"], "uploads/routes/" . $_FILES["route"]["name"]);
						 $sql = "UPDATE route_profiles SET title='$title', filename='$route_name', description='$desc', date=NULL, uploaders_ip ='$ip' WHERE upload_id='$upload_id'";
						 $result = run_query($sql);
							header('Location:profile.php?action=update_success');
					
					
				
					
					
					}

				}
			}
		}
			echo "Permissions";

	
?>

<?php
ob_flush();
?>
<?php ob_start();
?>
<?php
include('includes/functions.php');
session_start();

if(isset($_SESSION['user']) && isset($_SESSION['userid'])) {
$filename = $_POST['filename'];
$sql = "DELETE FROM loot_profiles WHERE filename = '$filename'";
$result = run_query($sql);
unlink("uploads/loot/".$filename);	 
header('Location:profile.php?action=delete_loot');
}else{
	echo "Permissions";
}

?>

<?php
ob_flush();
?>
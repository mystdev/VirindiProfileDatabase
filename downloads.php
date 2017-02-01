<?php
ob_start();
$pagetitle = 'Downloads';
include_once('includes/header.php');
include('includes/functions.php');
session_start();
?>

<h1>Downloads</h1>
<div id="container">
<?php
if(isset($_SESSION['user']) && isset($_SESSION['userid'])) {
	echo '<p><a href="downloads/AC.xlsx">Gear Spreadsheet</a></p><br />';
	echo '<p><a href="downloads/Encrust_Bloodstone_Notes.rar">Routes for 8 Notes in Encrusted Bloodstone Jewel</a></p><br />';
	echo '<p><a href="downloads/--CharName_ServerName_Colo.usd">Colo Vtank Profile</a></p><br />';
}else{
	echo '<p>Please login.</p>';
}
?>




</div>



<?php

include_once('includes/footer.php');

ob_flush();
?>



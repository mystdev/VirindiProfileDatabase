<?php 
include('includes/functions.php');
session_start();
session_destroy();
header('Location:index.php');

?>
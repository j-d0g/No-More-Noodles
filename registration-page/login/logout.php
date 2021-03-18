<?php 
session_start();

if(isset($_SESSION['user_id']))
{
	unset($_SESSION['user_id']);
}

header("Location: /GitRepos/first_group_project/index.php");
die;
 ?>
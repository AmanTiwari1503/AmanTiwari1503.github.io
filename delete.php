<?php
$title=$_POST['var'];
$user=$_POST['nameuser'];
$mysqli=new mysqli("localhost","root","","user_registration") or die(mysqli_error);
$sqlimp = "DELETE FROM TodoOf$user WHERE title='".$title."'";
if($mysqli->query($sqlimp)){
	session_start();
	$_SESSION['sess_user']=$user;
	header('location:mem.php');
}
?>

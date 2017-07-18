<?php
/*
      Author  : Suresh Pokharel
      Email   : suresh.wrc@gmail.com
      GitHub  : github.com/suresh021
      URL     : psuresh.com.np
*/ 
?>

<?php 
include 'include/dbConfig.php';
session_start();
if (isset($_GET['id'])){
	$id=$_GET['id'];

	$sql= "DELETE FROM info Where id=$id";
	$row= mysqli_query($con,$sql);
	echo "Successfully deleted";
	header("Location: list-account.php");
	$_SESSION['deleted']="true";
}
else{
	//header('redirect:index.php');
}
?>

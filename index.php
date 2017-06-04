<?php
include 'include/dbConfig.php';//referencing the dbConfig file

session_start();
$id=1;

if (!isset($_SESSION['login_email'])) {
  header("location:login.php");
}

if (isset($_SESSION['id'])) {
  $id=$_SESSION['id'];
}

if (isset($_GET['id'])) {
  $id=$_GET['id'];
  $_SESSION['id']=$id;
}

$sql= "SELECT * FROM info Where id=$id";
$row= mysqli_query($con,$sql);
$result=mysqli_fetch_assoc($row);

?> 

<!DOCTYPE html>
<html>
<head>
<?php include 'include/header.php';?>
	</div>
	<div class="row">
		<div class="jumbotron">
  			 <h1><?=$result['first_name'].' '.$result['last_name']?>
        </h1>
  				<p><?=$result['bio']?></p>
          <p><?=$result['remarks']?></p>
  				<!-- <p><a class="btn btn-success btn-lg" href="#" role="button">Get More Knowledge</a></p> -->
		</div>
	</div>
  
<?php include 'include/footer.php';?>
</div>
</body>
</html>


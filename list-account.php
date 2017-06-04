<?php

include 'include/dbConfig.php';//referencing the dbConfig file
$sql= "SELECT * FROM info Where id='1'";
$row= mysqli_query($con,$sql);
$result=mysqli_fetch_assoc($row);


$sql_query="SELECT * FROM info";
$row_all_accounts= mysqli_query($con,$sql_query);
?> 

<!DOCTYPE html>
<html>
<head>
<?php 
session_start();
include 'include/header.php';?>
<?php 
// session_start();
if (!isset($_SESSION['login_email'])) {
  header("location:login.php");
}
 ?>
	</div>
	<div class="row">
	<?php 
		if (isset($_SESSION['deleted'])) {
			
			echo "<div class='alert alert-success'>
  <strong>Successfully Deleted!</strong></div>";

			unset($_SESSION['deleted']);
		}

	 ?>
		<div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading">List of All Accounts</div>
		  <div class="panel-body">
		  		<table class="table">
				    <thead>
				      <tr>
				      	<th>ID</th>
				        <th>Name</th>
				        <th>Email</th>
				        <th>Action</th>
				      </tr>
				    </thead>
				    <tbody>

				
				<?php while($res = mysqli_fetch_assoc( $row_all_accounts)){?>
				      <tr>
				      	<td><?=$res['id']?></td>
				        <td><a href='index.php?id=<?=$res['id']?>'><?=$res['first_name']." ".$res['last_name']?></a></td>
				        <td><?=$res['email']?></td>
				        <td><a href="delete.php?id=<?=$res['id']?>" onclick="return confirm('Are you sure to delete this item?');">Delete</a></td>
					<!-- if (isset($_GET['id'])) {
					  $id=$_GET['id'];
					  $_SESSION['id']=$id;
					}

					$sql= "DELETE FROM info Where id=$id";
					$row= mysqli_query($con,$sql);
					$result=mysqli_fetch_assoc($row);

 -->
				      </tr>
				      <?php }?>
				    </tbody>
 				 </table>
		  </div>

		</div>
	</div>
<?php include 'include/footer.php';?>
</div>
</body>
</html>


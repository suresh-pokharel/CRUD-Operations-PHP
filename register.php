 <?php 
	include 'include/dbConfig.php';//referencing the dbConfig file
	 if(isset($_POST['submit'])) {
	 	$firstname= $_POST['txtFirstname'];
	 	$lastname =$_POST['txtLastname'];
	 	$email= $_POST['txtEmail'];
	 	$password =$_POST['txtPassword'];
	 	$password= md5($password);
	 	$sql= "INSERT INTO `info`(`first_name`, `last_name`, `email`, `password`) VALUES ('$firstname','$lastname','$email','$password')";
	 	//echo $sql;exit;
	 	if(mysqli_query($con,$sql)){
	 		$success=1;
	 	};

    }

 ?> 

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<title>Register Page</title>
</head>
<body>
<div class="container">
	<div class="col-md-4"></div>
				<div class="col-md-4" style="background-color: #D1D1D1;">
					<?php 
						if (isset($success)) {
							echo "<div class='alert alert-success'>
							<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'>  Registered Successfully ! Enjoy.</span>
						</div>";
						}
					 ?>
					<form name="myForm"   onsubmit="return validateForm();" action="register.php" method="POST">
					<div style="margin-left: 20px">
						<div class="form-group">
							<label>Email*</label>
							<input class= "form-control" style="width: 95%" type="text" name="txtEmail">
						</div>	
						<div class="form-group">
							<label>First Name*</label>
							<input class= "form-control" style="width: 95%" type="text" name="txtFirstname">
						</div>	
						<div class="form-group">
							<label>Last Name*</label>
							<input class= "form-control" style="width: 95%" type="text" name="txtLastname">
						</div>	
						<div class="form-group">
							<label>Password</label>
							<input class= "form-control" style="width: 95%" type="Password" name="txtPassword">
						</div>						
						<div class="form-group">
							<label>Phone</label>
							<input class= "form-control" style="width: 95%" type="text" name="txtPhone">
						</div>	
						<div class="form-group">
							<label>Address</label>
							<input class= "form-control" style="width: 95%" type="text" name="txtAddress">
						</div>	
						<div class="form-group">
							<label>Bio</label>
							<textarea class= "form-control" style="width: 95%" type="text" name="txtBio"></textarea>
							
						</div>	
						<div class="form-group">
							<label>Remarks</label>
							<textarea class= "form-control" style="width: 95%" type="text" name="txtRemarks"></textarea>
						</div>
						<div class="form-group">
							<button class= "btn btn-success pull-right" style="margin-right: 35px" type="submit" name="submit">Register</button>
						</div><br>
						<!-- for error -->
						<div class="alert alert-danger" id="error">
							<span class='glyphicon glyphicon-exclamation-sign' id="error" aria-hidden='true'></span>
						</div>
						<br><br>
					</div>
					</form>
				</div>
	<div class="col-md-4"></div>

</div>

 </html>

</body>
</html>
<script>
function validateForm() {
    var email = document.forms["myForm"]["txtEmail"].value;
	var fName =  document.forms["myForm"]["txtFirstname"].value;
	var lName =  document.forms["myForm"]["txtLastname"].value;
	var password =  document.forms["myForm"]["txtPassword"].value;
	var address = document.forms["myForm"]["txtAddress"].value;
	var phone =  document.forms["myForm"]["txtPhone"].value;
	var bio =  document.forms["myForm"]["txtBio"].value;
	var Remarks =  document.forms["myForm"]["txtRemarks"].value;
	
    if (email == ""||fName == ""||lName ==""||password ==""||address ==""||phone =="") {
		document.getElementById("error").innerHTML="Field Required";
        return false;
    }
	else if(fName.length<6){
		document.getElementById("error").innerHTML="First name should have atleast 6 character ";
        return false;
	}
// 	}
// 	else if(phone!=0||phone!==phone!==1||phone!==2||phone!==3||phone!==4||phone!==5||phone!==6||phone!==phone!==7||phone!==8||phone!==9){
// 		document.getElementById("error").innerHTML="Phone should have numberic character";
//         return false;
//  	}		
	else{
 		return true;
 	}
 }
</script>


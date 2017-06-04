
 <?php 
include 'include/dbConfig.php';//referencing the dbConfig file

 session_start();
 if(isset($_POST['txtName'])||isset($_POST['txtPassword'])) {
    $username= $_POST['txtName'];
    $password= md5($_POST['txtPassword']);
    if ($username==""||$password=="") {
        $message="Field Required";
    }elseif (strlen($username)<6) {
        $message="Username must contain at least 6 chars";
    }else{
        $sql="SELECT * FROM info WHERE email='$username' and password='$password'";
        // echo $sql;exit;
        $result=mysqli_query($con,$sql); //run the query $sql
        $count= mysqli_num_rows($result); //count rows that matches email and password
    }
         if ($count>0) {//login success
          $_SESSION['login_email']=$username; //create new user session as user loggedin
          header("location:index.php");
    }
        else{
        $message="Invalid Information";
        }
    
}
?>

<!DOCTYPE html>
 <html>   
<div class="login" style="width: 440px; height: 230px; background-color: rgba(41, 188, 151, 1); margin:auto;">
    <?php 
        if (isset($message)) {
       echo "<div class='error' style='width:100%; background-color: red; height: 25px; margin-top: 10px;  text-align: center; color:#fff;'>".$message."</div>";
        }
     ?>
    

    <form action="login.php" method="POST" style="margin-left: 20px; margin-top: 10px"><br>

     <label>Email:</label>
     <br>
     <input style="width: 400px; height: 20px" type="text" name="txtName" placeholder="Enter Username" value="<?= isset($username)?$username:""?>"><br><br>
     <label>Password:</label>
     <br>
     <input style="width: 400px; height: 20px" type="Password" placeholder="Enter Password" name="txtPassword"><br><br>
     <a href="register.php">Create Account</a>
     <input style="width: 70px; height: 25px; float: right; margin-right: 20px;" type="submit" value="Login" name="btnSubmit">

   </form>

 </div>
 </html>
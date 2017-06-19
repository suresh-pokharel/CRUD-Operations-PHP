
 <?php 
include 'include/dbConfig.php';//referencing the dbConfig file

 session_start();
 if(isset($_POST['txtEmail'])||isset($_POST['txtPassword'])) {
    $username= $_POST['txtEmail'];
    $password= md5($_POST['txtPassword']);
    if ($username==""||$password=="") {
        $message="Field Required";
    }elseif (strlen($username)<6) {
        $message="Username must contain at least 6 chars";
    }else{
        $sql="SELECT * FROM info WHERE email='$username' and password='$password'";
        $result=mysqli_query($con,$sql); //run the query $sql
        $count= mysqli_num_rows($result); //count rows that matches email and password
        if ($count>0) {//login success
            $_SESSION['login_email']=$username; //create new user session as user loggedin
            $response_array['login_status']="true";
            //header("location:index.php");
        }
        else{
            $response_array['login_status']="false";
        }
        
        header('Content-type: application/json');//preparing correct format for json_encode
        echo json_encode($response_array);//sending response to ajax
    }    
 }
?>

<!DOCTYPE html>
 <html>   
<head></head>
<body>
    <div class="container">
        <div class="header">
            Login
        </div>
        <div class="loginForm">
           <?php 
            if (isset($message)) {
           echo "<div class='error' style='width:100%; background-color: red; height: 25px; margin-top: 10px;  text-align: center; color:#fff;'>".$message."</div>";
            }
            ?>
            <form method="post" id="login_form" onsubmit="return validate();" >
                <input id="email" type="text" placeholder="Enter Email" name="txtEmail" value="<?= isset($username)?$username:""?>">
                <input id="password" type="password" placeholder="Enter Password" name="txtPassword" value="<?= isset($password)?$password:""?>">
                <br>
                <input type="submit" name="Login" name="btnSubmit" value="Login">
                <input type="button" name="Register" name="btnSubmit" onclick="window.location='register.php';" value="Register">
            </form>
            <span id="error-msg">
                Something went wrong...
            </span>
        </div>
    </div>
</body>
<style>
    .container{
        width: 400px;
        background-color: #ccc;
        margin: auto;
        border: 3px solid;
        margin-top: 100px;
    }

    .header{
        background-color: #999;
        height: 30px;
        margin: 0px;
        text-align: center;
        color: #fff;
        font-size: 20px;
    }

    input[type=text], input[type=password] {
        width: 350px;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        margin-left: 25px;
        font-size: 15px;
    }

    input[type=submit]{
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 350px;
        margin-left: 25px;
    }

    input[type=button]{
        background-color: #4CAFff;
        color: white;
        padding: 10px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 350px;
        margin-left: 25px;
    }

    #error-msg{
        margin: 8px 0;
        margin-left: 25px;
        background-color: #f1093f;
        padding: 5px;
        width: 342px;
        display: inline-block;
        color: #fff;
    }
</style>

<script>
    document.getElementById('error-msg').style.display= 'none';
    function validate(){
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var message='';

        if (!validateEmail(email)) {
            message = "Please enter a valid email";
        }

        if (password=="" || email=="") {
            message = "Both fields are required";
        }

        if (password.length<6) {
            message = "Password must be at least 6 characters";
        }

        // other tests
        if (message!='') {
            document.getElementById('error-msg').style.display= 'inline-block';
            document.getElementById('error-msg').innerHTML=message;
            return false;
        }else{
            doLogin();
        }
    }

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
    }
</script>

<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous">
</script>

<script>
function doLogin(){
   $.ajax({ url: 'login.php',
             type: 'post',
             success: function(response) {
                if (localStorage['fav']) {
                    var status = JSON.parse(response.responseText);
                }
                console.log(status.login_status);
        }
    });
}
</script>

 </html>
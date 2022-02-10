<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
  {
    $fname=$_POST['name'];
    $mobno=$_POST['mobilenumber'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);
	
	$sql="select Email from tbluser where Email='$email'";
    $ret=mysqli_query($con,$sql);
	echo $ret;
    $result=mysqli_fetch_array($ret);
    if($result>0){
$msg="This email  associated with another account";
    }
    else{
    $query=mysqli_query($con, "insert into tbluser(FullName, MobileNumber, Email,  Password) value('$fname', '$mobno', '$email', '$password' )");
    if ($query) {
    $msg="You have successfully registered";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }
}
header('location:dashboard.php');
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Sleep Tracker - Signup</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<script type="text/javascript">
function checkpass()
{
if(document.signup.password.value!=document.signup.repeatpassword.value)
{
alert('Password and Repeat Password field does not match');
document.signup.repeatpassword.focus();
return false;
}
return true;
} 

</script>

<style type="text/css">
        
		@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');
		
		* {
			box-sizing: border-box;
		}
		
		body {
			background: #f6f5f7;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			font-family: 'Montserrat', sans-serif;
			height: 100vh;
			margin: -20px 0 50px;
		}
		
		h1 {
			font-weight: bold;
			margin: 0;
		}
		
		h2 {
			text-align: center;
		}
		
		p {
			font-size: 14px;
			font-weight: 100;
			line-height: 20px;
			letter-spacing: 0.5px;
			margin: 20px 0 30px;
		}
		
		span {
			font-size: 12px;
		}
		
		a {
			color: #333;
			font-size: 14px;
			text-decoration: none;
			margin: 15px 0;
		}
		
		button {
			border-radius: 20px;
			border: 1px solid #FF4B2B;
			background-color: #FF4B2B;
			color: #FFFFFF;
			font-size: 12px;
			font-weight: bold;
			padding: 12px 45px;
			letter-spacing: 1px;
			text-transform: uppercase;
			transition: transform 80ms ease-in;
		}
		
		button:active {
			transform: scale(0.95);
		}
		
		button:focus {
			outline: none;
		}
		
		button.ghost {
			background-color: transparent;
			border-color: #FFFFFF;
		}
		
		form {
			background-color: #FFFFFF;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			padding: 0 50px;
			height: 100%;
			text-align: center;
		}
		
		input {
			background-color: #eee;
			border: none;
			padding: 12px 15px;
			margin: 8px 0;
			width: 100%;
		}
		
		.container {
			background-color: #fff;
			border-radius: 10px;
			box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
					0 10px 10px rgba(0,0,0,0.22);
			position: relative;
			overflow: hidden;
			width: 768px;
			max-width: 100%;
			min-height: 480px;
		}
		
		.form-container {
			position: absolute;
			top: 0;
			height: 100%;
			transition: all 0.6s ease-in-out;
		}
		
		.sign-in-container {
			left: 0;
			width: 50%;
			z-index: 2;
		}
		
		.container.right-panel-active .sign-in-container {
			transform: translateX(100%);
		}
		
		.sign-up-container {
			left: 0;
			width: 50%;
			opacity: 0;
			z-index: 1;
		}
		
		.container.right-panel-active .sign-up-container {
			transform: translateX(100%);
			opacity: 1;
			z-index: 5;
			animation: show 0.6s;
		}
		
		@keyframes show {
			0%, 49.99% {
				opacity: 0;
				z-index: 1;
			}
			
			50%, 100% {
				opacity: 1;
				z-index: 5;
			}
		}
		
		.overlay-container {
			position: absolute;
			top: 0;
			left: 50%;
			width: 50%;
			height: 100%;
			overflow: hidden;
			transition: transform 0.6s ease-in-out;
			z-index: 100;
		}
		
		.container.right-panel-active .overlay-container{
			transform: translateX(-100%);
		}
		
		.overlay {
			background: #FF416C;
			background: -webkit-linear-gradient(to right, #FF4B2B, #333);
			background: linear-gradient(to right, #FF4B2B, #FF416C);
			background-repeat: no-repeat;
			background-size: cover;
			background-position: 0 0;
			color: #FFFFFF;
			position: relative;
			left: -100%;
			height: 100%;
			width: 200%;
			transform: translateX(0);
			transition: transform 0.6s ease-in-out;
		}
		
		.container.right-panel-active .overlay {
			transform: translateX(50%);
		}
		
		.overlay-panel {
			position: absolute;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			padding: 0 40px;
			text-align: center;
			top: 0;
			height: 100%;
			width: 50%;
			transform: translateX(0);
			transition: transform 0.6s ease-in-out;
		}
		
		.overlay-left {
			transform: translateX(-20%);
		}
		
		.container.right-panel-active .overlay-left {
			transform: translateX(0);
		}
		
		.overlay-right {
			right: 0;
			transform: translateX(0);
		}
		
		.container.right-panel-active .overlay-right {
			transform: translateX(20%);
		}
		
		.social-container {
			margin: 20px 0;
		}
		
		.social-container a {
			border: 1px solid #DDDDDD;
			border-radius: 50%;
			display: inline-flex;
			justify-content: center;
			align-items: center;
			margin: 0 5px;
			height: 40px;
			width: 40px;
		}
		
		
		
			</style>

<body>
<h2>Sleep Tracker</h2>
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form action="#">
            <h1>Create Account</h1>
            <div class="social-container">
                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>or use your email for registration</span>
            <input type="text" placeholder="Name" />
            <input type="email" placeholder="Email" />
            <input type="password" placeholder="Password" />
            
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form role="form" action="" method="post" id="" name="signup" onsubmit="return checkpass();" style="padding-top: -50px;margin-top: -10px;">
            <h1 style="margin-top: 20px;margin-bottom: -30px;">Register Here..!</h1>
            <br><br>
            <input  placeholder="Full Name" name="name" type="text" required="true" />
            <input  placeholder="E-mail" name="email" type="email" required="true" />
            <input type="text" id="mobilenumber" name="mobilenumber" placeholder="Mobile Number" maxlength="10" pattern="[0-9]{10}" required="true">
            <input placeholder="Password" name="password" type="password" value="" required="true" />
            <input type="password" id="repeatpassword" name="repeatpassword" placeholder="Repeat Password" required="true" />
            <br><br>
            <button type="submit" value="submit" name="submit" style="margin-top: -25px;">Register</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Login</h1>
                <p>Already have an account <br>Click here to login with us</p>
                <a href="login.php"><button class="ghost" id="signUp">Login</button></a>
            </div>
        </div>
    </div>
</div>


<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>

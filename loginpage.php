
<?php

/**
 * Provides interface and back end routines that handle user logins
 * @author Avin E.M
 */

require_once ('db_connect.php');
require_once ('functions.php');
$errmessage = "";
if($_POST)
{
  if(!empty($_POST['uName']) && !empty($_POST['pswd']))

  {		
	  $userid = $_POST['uName'];
	  $pwd = $_POST['pswd'];
	  $tablename = "user_admin";
	$query = "SELECT * FROM $tablename WHERE id='$userid' ";
	$result = mysqli_query($conn,$query);
	$rowcount=mysqli_num_rows($result);
	 if($rowcount == 1)
	 {
		while($r = mysqli_fetch_assoc($result)) {
		
		if($userid==$r['id']){
			if( $pwd==$r['pwd']){
				$_SESSION['logged_in'] = true;
				$_SESSION['uName'] = $userid;
			}
			else{
				$errmessage="Invalid Credentials";
			}
		}
		else{

		$errmessage="User doesn't exits";
		}
    
	}
}
else{
	$errmessage="Username or password invalid";
}
}
    else
      $errmessage =  "Invalid credentials";
  }


  if(sessioncheck('logged_in'))
	  header('location: ./index.php')
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V15</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="assets/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(assets/images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Sign In
					</span>
				</div>

				<form class="login100-form validate-form" action="loginpage.php" method="post">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="uName" placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pswd" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
					
				<div class="text-danger"><p style="color : red;"><?php echo "$errmessage" ?></p></div>
				</form>
				
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="aseets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="aseets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="aseets/vendor/bootstrap/js/popper.js"></script>
	<script src="aseets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="aseets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="aseets/vendor/daterangepicker/moment.min.js"></script>
	<script src="aseets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="aseets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="aseets/js/main.js"></script>

</body>
</html>
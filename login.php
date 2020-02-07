<?php
	session_start();

	$_SESSION['test']='testing';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Open Notes</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
	<form class="form" method="post">
		<div class="logo">
			<div class="logo2">
				
			</div>
			
		</div>
		<div class="form1">
			<p>Username</p>
			<input type="text" name="username" id = "name" placeholder= "Enter username" required>
			<p> Password</p>
			<input type="password" name="password" id = "pass" placeholder= "Enter password" required>
			<input type="submit" name="Login" value="Login">
			<input type="button" id="signup_but" name="Sign" value="Sign Up">
		</div>
	</form>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript">
		document.forms[0].onsubmit = function(e){
			e.preventDefault();

			var flag=true;

			var username = this.username.value;
			var password = this.password.value;

			if(!(/^[A-Za-z0-9]+$/.test(this.username.value))){
					document.getElementById('name').style.border = ".1em solid red";
					flag=false;
			}
			if(!(/^[A-Za-z0-9]{8,16}$/.test(this.password.value))){
					document.getElementById('pass').style.border = ".1em solid red";
					flag=false;
			}

			if(flag){

				var json={
					"cid":username,
					"pass":password,
					"action":"signin"
				}

				var request=$.ajax({
					url:"server/UserManagement.php",
					method:"POST",
					dataType:"text",
					data:json,
				});

				request.done(function(data){
					
					console.log(data);
					Android.showToast(data);
					data=JSON.parse(data);
					
					if(data.success){
						Android.showToast("Logged in");
					}
					
				});
				request.fail(function(jqXhr,data,error){
					console.log(error);
					Android.showToast(error);
				});
			}
		}
	</script>
	<script type="text/javascript" src="js/app.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		    $('body>div:last-of-type').hide(); 
		});
	</script>
</body>
</html>
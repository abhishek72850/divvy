<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1">
	<link rel="stylesheet" type="text/css" href="css/change_password.css">
	<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
	<form>
		<div class="topnav">
			<a href="#" class="previous">&#8249;</a>
		  	<a class="active" href="#home">Signup</a>  
		</div>
		<br />
		<div>
			<input type="text" name="username" id = "name" placeholder="Username">
		</div>
		<br />
		<div>
			<input type="text" name="regno" id = "reg" placeholder="Registration Number">
		</div>
		<br />
		<div>
			<input type="text" name="coursename" id = "course" placeholder="Course Name">
		</div>
		<br />
		<div>
			<input type="text" name="emailid" id = "email" placeholder="Email Id">
		</div>
		<br />
		<div>
			<input type="text" name="mobile" id = "mob" placeholder="Mobile Number">
		</div>
		<br />
		<div>
			<input type="password" name="password" id = "pass" placeholder="Password" title="Must contain one uppercase and lowercase letter, one number and must be 8 characters long">
		</div>
		<br />
		<div>
			<input type="password" name="cpassword" id = "cpass" placeholder=" Confirm Password" title="Must contain one uppercase and lowercase letter, one number and must be 8 characters long">
		</div>
		<br />
		<div>
			<button type = "submit">Submit</button>
			<button type= "reset" onclick = "setx()">Reset</button>
		</div>
	</form>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript">

		function setx(){
			document.getElementById('name').style.border = "1px solid #ccc";
			document.getElementById('reg').style.border = "1px solid #ccc";
			document.getElementById('course').style.border = "1px solid #ccc";
			document.getElementById('email').style.border = "1px solid #ccc";
			document.getElementById('mob').style.border = "1px solid #ccc";
			document.getElementById('pass').style.border = "1px solid #ccc";
			document.getElementById('cpass').style.border = "1px solid #ccc";
		}
		
			document.forms[0].onsubmit = function(e){
				e.preventDefault();

				var flag=true;

				var username = this.username.value;
				var reg = this.regno.value;
				var course = this.coursename.value;
				var email = this.emailid.value;
				var mob = this.mobile.value;
				var pass = this.password.value;
				var cpass = this.cpassword.value;

				if(!(/^[A-Za-z\s]+$/.test(username))){
					document.getElementById('name').style.border = ".1em solid red";
					flag=false;
				}
				if(!(/^[A-Za-z0-9]+$/.test(reg))){
					document.getElementById('reg').style.border = ".1em solid red";
					flag=false;
				}
				if(!(/^[A-Za-z]+$/.test(course))){
					document.getElementById('course').style.border = ".1em solid red";
					flag=false;
				}
				if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))){
					document.getElementById('email').style.border = ".1em solid red";
					flag=false;
				}
				if(!(/^(\+91-|\+91|0)?\d{10}$/.test(mob))){
					document.getElementById('mob').style.border = ".1em solid red";
					flag=false;
				}
				if(!(/^[A-Za-z0-9]{8,16}$/.test(pass)) || !(/^[A-Za-z0-9]{8,16}$/.test(cpass)) || (pass != cpass)){
					document.getElementById('pass').style.border = ".1em solid red";
					document.getElementById('cpass').style.border = ".1em solid red";
					flag=false;
				}

				if(flag){

					var json={
						"name":username,
						"cid":reg,
						"course":course,
						"email":email,
						"mobile":mob,
						"pass":pass,
						"cpass":cpass,
						"action":"signup"
					}

					var request=$.ajax({
						url:"server/UserManagement.php",
						method:"POST",
						dataType:"text",
						data:json,
					});

					request.done(function(data){
						
						console.log(data);

						data=JSON.parse(data);

						if(data.success){
							Android.signUpSuccess();
						}
						else{
							Android.signUpError(data.error);	
						}
						
					});
					request.fail(function(jqXhr,data,error){
						console.log(error);
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
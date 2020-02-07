<html>
<head>
	<title>Setting</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1">
	<link rel="stylesheet" type="text/css" href="css/setting.css">
	<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
	<form>
		<div class="topnav">
			<a href="#" class="previous">&#8249;</a>
		  	<a class="active" href="#home">Setting</a>
		</div>
		<br />
		<div>
			<input type="text" name="name" id = "n" placeholder="Name">
		</div>
		<br />
		<div>
			<select name="course">
				<option>---Select Course---</option>
				<option>B.Tech</option>
				<option>BCA</option>
				<option>BBA</option>
				<option>B.Sc</option>
				<option>MCA</option>
				<option>M.Tech</option>
				<option>MIS</option>
				<option>Others</option>
			</select>
		</div>
		<br />
		<div>
			<input type="text" name="mobile" id = "mob" placeholder="Mobile Number">
		</div>
		<br />
		<div>
			<input type="text" name="emailid" id = "email" placeholder="Email">
		</div>
		<br />
		<div>
			<input type="text" name="regno" id = "reg" placeholder="Registration Number">
		</div>
		<br />
		<div>
			<input type="password" name="password" id = "pass" placeholder="Password">
		</div>
		<br />
		<div>
			<button type="submit">Change</button>
		</div>
	</form>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript">
		
			document.forms[0].onsubmit = function(e){
				e.preventDefault();

				var name = this.name.value;
				var mob = this.mobile.value;
				var email = this.emailid.value;
				var regno = this.regno.value;
				var password = this.password.value;
				var course=this.course.value;

				var flag=true;

				if(!(/^[A-Za-z\s]+$/.test(this.name.value))){
					document.getElementById('n').style.border = ".1em solid red";
					flag=false;
				}
				if(!(/^(\+91-|\+91|0)?\d{10}$/.test(this.mobile.value))){
					document.getElementById('mob').style.border = ".1em solid red";
					flag=false;
				}
				if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.emailid.value))){
					document.getElementById('email').style.border = ".1em solid red";
					flag=false;
				}
				if(!(/^[A-Za-z0-9]+$/.test(this.regno.value))){
					document.getElementById('reg').style.border = ".1em solid red";
					flag=false;
				}
				if(!(/^[A-Za-z0-9]{8,16}$/.test(this.password.value))){
					document.getElementById('pass').style.border = ".1em solid red";
					flag=false;
				}

				if(flag){

					var json={
						"name":name,
						"cid":regno,
						"course":course,
						"email":email,
						"mobile":mob,
						"pass":password,
						"action":"change_setting"
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
						
					});
					request.fail(function(jqXhr,data,error){
						console.log(error);
					});
				}
			}
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
		    $('body>div:last-of-type').hide(); 
		});
	</script>
</body>
</html>
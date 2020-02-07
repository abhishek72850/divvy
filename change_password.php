<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1">
	<link rel="stylesheet" type="text/css" href="css/change_password.css">
	<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
	<script type="text/javascript">
		
		var divvy={
			reg:"<?php echo $_SESSION['cid'] ?>"
		}

	</script>
	<form>
		<div class="topnav">
			<a href="#" class="previous">&#8249;</a>
		  	<a class="active" href="#home">Change Password</a>  
		</div>
		<br />
		<div>
			<input type="text" name="cp" placeholder="Current Password" required>
		</div>
		<br />
		<div>
			<input type="text" name="np" id = "newp" placeholder="New Password" title="Must contain one uppercase and lowercase letter, a number and must be 8 characters long" required>
		</div>
		<br />
		<div>
			<input type="text" name="confirmpass" id = "conp" placeholder="Confirm Password" title="Must contain one uppercase and lowercase letter, one number and must be 8 characters long" required>
		</div>
		<br />
		<div>
			<button type = "submit">Change</button>
		</div>
	</form>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript">
		
			document.forms[0].onsubmit = function(e){
				e.preventDefault();

				var cp = this.cp.value;
				var np = this.np.value;
				var confirmpass = this.confirmpass.value;

				var flag=true;

				if((/^[A-Za-z0-9]{8,16}$/.test(np)) && (/^[A-Za-z0-9]{8,16}$/.test(confirmpass)) && (np == confirmpass)){
					document.getElementById('newp').style.border = ".1em solid red";
					document.getElementById('conp').style.border = ".1em solid red";					
					flag=false;
				}

				if(flag){

					var json={
						"cid":divvy.reg,
						"new_pass":np,
						"cnf_pass":confirmpass,
						"cur_pass":cp,
						"action":"change_pass"
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
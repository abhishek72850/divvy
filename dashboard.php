<?php
	session_start();

	require_once('server/dbconfig.php');
	
	$user=null;

	$database=new Database();
	$db=$database->getDbConnection();
	//if user is logged in before
	if(isset($_SESSION["cid"])){

		
	}
	else{
		//header('location:login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1">
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
	<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
	<div class="header">
		<div class="logo">
			
		</div>
	</div>
	<?php
		//echo $_SESSION['cid'];
	?>
	<form class="form1" action="#" method="post">
		<div class="main">
			<select type="text" name="course" id = "c" placeholder="Select Course" required="required">
	          	<option value="MCA" >MCA</option>
	          	<option value="M.Tech-CS" >M.Tech CS</option>
	          	<option value="B.Tech-CS">B.Tech-CS</option>
			</select>
			<input type="text" name="subject" id = "sub" placeholder="Enter Topic" required="required">
			<button type="submit">Search</button>
		</div>
	</form>
	<!-- <p id="test">test</p> -->
	<div class="item">
		<!-- <div class="box">
			<div>
				<h3>Topic Name</h3>
				<p>Username</p>
				<p>Rating</p>
				<p>Downloads</p>
				<p>Status</p>
			</div>
			<div>
				<button><img src="images/phone_small.png"></button>
				<button><img src="images/download_small.png"></button>
			</div>
		</div> -->
	</div>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript">

		document.forms[0].onsubmit = function(e){
				e.preventDefault();

			var course = this.course.value;
			var subject = this.subject.value;

			var flag=true;

			if(!(/^[A-Za-z\s]+$/.test(this.course.value))){
				document.getElementById('c').style.border = ".1em solid red";
				flag=false;
			}
			if(!(/^[A-Za-z\s]+$/.test(this.subject.value))){
				document.getElementById('sub').style.border = ".1em solid red";
				falg=false;
			}

			//document.getElementById('test').innerText = "cha";
			//Android.siugnUpError("jjkj");

			if(flag){

				var json={
					"subject":subject,
					"course":course,
					"action":"search"
				}

				var request=$.ajax({
					url:"server/DivvyManager.php",
					method:"POST",
					dataType:"text",
					data:json,
				});

				request.done(function(data){
					
					$('.item>*').detach();
					//document.getElementById('test').innerText=data;
					console.log(data);
					//Android.siugnUpError(data);
					data=JSON.parse(data);

					for(var item in data['data']){
						console.log(data['data'][item]);

						var topic=$("<h3></h3>",{
							"text":data['data'][item]['topic_name']
						});

						var username=$("<p></p>",{
							"text":data['data'][item]['name']
						});

						var rating=$("<p></p>",{
							"text":"Rating: "+data['data'][item]['rating']
						});

						var download=$("<p></p>",{
							"text":"Downloads: "+data['data'][item]['downloads']
						});

						var status=$("<p></p>",{
							"text":''
						});

						
						var call=$("<button></button>",{
							"data-nid":data['data'][item]['notes_id'],
							"data-phone":data['data'][item]['phone']
						});

						var call_img=$("<img/>",{
							"src":"images/phone_small.png"
						});

						var down=$("<button></button>",{
							"data-nid":data['data'][item]['notes_id']
						});

						call.append(call_img);

						var down_img=$("<img/>",{
							"src":"images/download_small.png"
						});

						down.append(down_img);

						var card_a=$("<div></div>",{
							
						});

						var card_b=$("<div></div>",{
							
						});

						card_a.append(topic);
						card_a.append(username);
						card_a.append(rating);
						card_a.append(download);
						card_a.append(status);

						card_b.append(call);
						card_b.append(down);

						var card_parent=$("<div></div>",{
							"class":"box"
						});

						card_parent.append(card_a);
						card_parent.append(card_b);
						
						$('.item').append(card_parent);
					}
					
				});
				request.fail(function(jqXhr,data,error){
					console.log(error);
					document.getElementById('test').innerText=error
				});
			}
		}
		
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
		   //$('body>div:last-of-type').hide(); 
		});
	</script>
</body>
</html>
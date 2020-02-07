<?php
	session_start();

	require_once('server/DivvyManager.php');

	if(isset($_POST['title'])){
		//var_dump($_FILES);
		$ext=explode('.', $_FILES['myFile']['name'])[1];
		$filename="images/".'18MCA0156'.".".$ext;
		//echo $filename;

		$divvy=new DivvyManager();

		$divvy->uploadNotes($_SESSION['cid'],$_POST['title'],$_POST['course'],$_POST['subject'],$_FILES['myFile'],$_POST['comments']);

		header('location:upload_list.php');
	}
?>

<html>
<head>
	<title>upload materials</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1">
	<link rel="stylesheet" type="text/css" href="css/upload_form.css">
	<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
	<script type="text/javascript">
		var divvy={
			reg:null
		}
	</script>
	<div class="topnav">
		<a href="#" class="previous">&#8249;</a>
		<a class="active" href="#home">Upload Materials</a>  
	</div>
	<form action="upload_form.php" method='post' enctype="multipart/form-data">
	  	<div class="control">
		    <input type="Text" name = "title" id="tit" class="floatLabel" placeholder ="Title">
		</div>
		<div>
			<select class="floatLabel" placeholder="courses" name="course">
	          	<option value="Courses" selected>courses</option>
	          	<option value="MCA" >MCA</option>
	          	<option value="M.Tech-CS" >M.Tech CS</option>
	          	<option value="B.Tech-CS">B.Tech-CS</option>
	       	</select>
		</div>
		<div>
			<input type="Text" name="subject" id = "sub" class="floatLabel" placeholder ="Subject">
		</div>
		<div>
			<label>Upload Sample Material-</label>
			<input type="file" name="myFile">
		</div>
		<div>
			<textarea name="comments" class="floatLabel" id="comments" placeholder="comments(optional)"></textarea>
		</div>
		<div>
			<button value="Upload">UPLOAD</button>
		</div>
	</form>

	<script type="text/javascript">
		
		document.forms[0].onsubmit = function(e){
			//e.preventDefault();

			var title = this.title.value;
			var course=this.course.value;
			var sub = this.subject.value;
			var myfile=this.myfile;
			var comment=this.comments.value;

			var flag=true;

			if(!(/^[A-Za-z0-9\s]+$/.test(this.title.value))){
					document.getElementById('tit').style.border = ".1em solid red";
					flag=false;
			}
			if(!(/^[A-Za-z\s]+$/.test(this.subject.value))){
					document.getElementById('sub').style.border = ".1em solid red";
					falg=false;
			}

			if(flag){
				return true;

				/*var fd = new FormData(); 
                var files = this.myFile.files[0]; 
                fd.append('file', files); 

				var json={
					"cid":divvy.reg,
					"course":course,
					"subject":sub,
					"comment":comment,
					"action":"upload_notes"
				}

				fd.append('data',JSON.stringify(json));

				var request=$.ajax({
					url:"server/DivvyManagement.php",
					method:"POST",
					data:fd
				});

				request.done(function(data){
					
					console.log(data);

					data=JSON.parse(data);
					
				});
				request.fail(function(jqXhr,data,error){
					console.log(error);
				});*/
			}
			else{
				return false;
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
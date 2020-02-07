<?php
	session_start();

	require_once('server/DivvyManager.php');

	$divvy=new DivvyManager();

	$data=$divvy->fetchAllNotes($_SESSION['cid']);
?>
<html>
<head>
	<title>uploaded materials</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1">
	<link rel="stylesheet" type="text/css" href="css/upload_list.css">
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
		<a class="active" href="#home">Uploaded list</a>  
	</div>
	<div class="list_cont">
		<div class="boxed">
			<button onclick="window.location='upload_form.php'">+</button>
		</div>
		<?php
			$list=$data["data"];

			foreach ($list as $key => $value) {
				
		?>
		<div class="box">
			<div>
				<h3><?php echo $value['topic_name'] ?></h3>
				<span>Date:<?php echo $value['date'] ?></span>
				<span>Downloads:<?php echo $value['downloads'] ?></span>
			</div>
			<div>
				<button value="Status" data-cid="<?php echo $value['college_id'] ?>">Status</button>
				<button value="Remove" id="remove_note" data-cid="<?php echo $value['college_id'] ?>">Remove</button>
			</div>
		</div>
		<?php
			}
		?>
	</div>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		    
		    $('#remove_note').on('click',function(e){

		    });
		});

	</script>
	<script type="text/javascript">
		$(document).ready(function(){
		    //$('body>div:last-of-type').hide(); 
		});
	</script>
</body>
</html>
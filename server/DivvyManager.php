<?php

	require_once('dbconfig.php');

	class DivvyManager{

		private $db;

		function __construct(){
			$database=new Database();
			$this->db=$database->getDbConnection();
		}

		public function uploadNotes($cid,$title,$course,$subject,$file,$comments){

			$nid=uniqid();
			$filename="images/".$cid.".".$nid.$file['name'];

			$result=move_uploaded_file($file['tmp_name'],$filename);

			if($result){
				$sql="INSERT INTO notes_table(notes_id,college_id,topic_name,file_path,downloads,comments,date,time) VALUES('$nid','$cid','$title','$filename',0,'$comments',NOW(),NOW())";
				echo $sql;
				$result=mysqli_query($this->db,$sql);

				if($result){
					return array("success"=>true);
				}
				else{
					return array("success"=>false);
				}
			}
			else{
				return array("success"=>false);
			}
		}

		public function fetchAllNotes($cid){

			$sql="SELECT * FROM notes_table WHERE college_id='$cid'";
			
			$data=mysqli_query($this->db,$sql);

			if(mysqli_num_rows($data)>0){
				$list=array();
				while($row=mysqli_fetch_assoc($data)){
					array_push($list, $row);
				}

				//$this->createCookie($row["u_id"],$uemail);
				return array("data"=>$list,"success"=>true);
			}
			else{
				return array("success"=>false);
			}
		}

		public function fetchOneNotes($cid,$nid){

			$sql="SELECT * FROM notes_table WHERE college_id='$cid' and notes_id='$nid'";
			
			$data=mysqli_query($this->db,$sql);

			if(mysqli_num_rows($data)>0){
				$row=mysqli_fetch_assoc($data);

				//$this->createCookie($row["u_id"],$uemail);
				return array("data"=>$row,"success"=>true);
			}
			else{
				return array("success"=>false);
			}
		}

		public function deleteNotes($cid,$nid){


			$sql="DELETE FROM notes_table WHERE college_id='$cid' AND notes_id='$nid'";
		
			$result=mysqli_query($this->db,$sql);

			if($result){
				return array("success"=>true);
			}
			else{
				return array("success"=>false);
			}
		}

		public function doNotesSearch($course,$subject){

			$search=strtolower(trim($subject));
			$search2="+".strtr($subject, " ,-_=","+++++");

			$sql="SELECT * FROM notes_table n,user_table u WHERE MATCH(n.topic_name) AGAINST('$search2' IN NATURAL LANGUAGE MODE) AND n.college_id=u.college_id";

			$data=mysqli_query($this->db,$sql);

			if(mysqli_num_rows($data)>0){

				$list=array();

				while($row=mysqli_fetch_assoc($data)){

					$nid=$row['notes_id'];
					$sql="SELECT COUNT(*) as rate_num,SUM(rate) as rate_total FROM rating_table WHERE notes_id='$nid'";

					$data2=mysqli_query($this->db,$sql);

					$row2=mysqli_fetch_assoc($data2);

					if($row2['rate_num']>0){
						$row['rating']=$row2['rate_total']/$row2['rate_num'];
					}
					else{
						$row['rating']=0;	
					}
					array_push($list, $row);
				}
				return array("data"=>$list,"success"=>true);
			}
			else{
				return array("error"=>"No Notes Found","success"=>false);
			}
		}
	}

	if(isset($_POST["action"])){

		$user = new DivvyManager();

		if($_POST["action"]=="search"){
			echo json_encode($user->doNotesSearch($_POST['course'],$_POST['subject']));
		}
		elseif($_POST["action"]=="fetch_notes"){
			echo json_encode();	
		}
		elseif($_POST["action"]=="upload_notes"){
			echo json_encode($user->uploadNotes($_POST['cid'],$_POST['title'],$_POST['course'],$_POST['subject'],$_P['file'],$_POST['comment']));
		}
		elseif($_POST["action"]=="delete_notes"){
			echo json_encode();
		}
	}
?>
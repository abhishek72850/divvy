<?php
	session_start();
	
	require_once('dbconfig.php');

	class UserManager{

		private $db;

		function __construct(){
			$database=new Database();
			$this->db=$database->getDbConnection();
		}

		public function doLogin($cid,$pass){

			$sql="SELECT * FROM user_table WHERE college_id='$cid' AND password='$pass'";
			
			$data=mysqli_query($this->db,$sql);

			if(mysqli_num_rows($data)>0){
				$row=mysqli_fetch_assoc($data);

				$_SESSION['cid']=$cid;
				$_SESSION['pass']=$pass;

				//$this->createCookie($row["u_id"],$uemail);
				return array("data"=>$row,"success"=>true);
			}
			else{
				return array("error"=>"User Doesn't Exist","success"=>false);
			}
		}

		public function doSignup($uname,$cid,$course,$email,$mobile,$pass,$cnfpass){

			if($pass==$cnfpass){
				if($this->doLogin($cid,$pass)["success"]){
					return array("error"=>"User Exists","success"=>false);
				}
				else{

					$course_id=$this->getCourseID($course);

					$sql="INSERT INTO user_table(name,college_id,phone,email,password,course_id,date,time) VALUES('$uname','$cid','$mobile','$email','$pass','$course_id',NOW(),NOW())";

					$result=mysqli_query($this->db,$sql);

					if($result){
						//$this->createCookie($this->doLogin($uemail,$pass)["data"]["u_id"],$uemail);
						return array("success"=>true);
					}
					else{
						return array("error"=>"Unable to Create New User","success"=>false);
					}
				}
			}
			else{
				return array("error"=>"Validation Error","success"=>false);
			}
		}

		public function getCourseID($course){

			$sql="SELECT course_id FROM course_table WHERE name='$course'";
			
			$data=mysqli_query($this->db,$sql);

			if(mysqli_num_rows($data)>0){
				$row=mysqli_fetch_assoc($data);

				//$this->createCookie($row["u_id"],$uemail);
				return $row['course_id'];
			}
			else{
				return '';
			}	
		}

		public function doPasswordChange($cid,$cur_pass,$new_pass,$cnfpass){

			$sql="UPDATE user_table SET password='$new_pass' WHERE college_id='$cid' AND password='$cur_pass'";

			$result=mysqli_query($this->db,$sql);

			if($result){
				return array("success"=>true);
			}
			else{
				return array("success"=>false);
			}	
		}

		public function doPersonalChange($name,$course,$mobile,$email,$cid,$pass){

			$course_id=$this->getCourseID($course);

			$sql="UPDATE user_table SET name='$name', course_id='$course_id', phone='$mobile', email='$email' WHERE college_id='$cid' AND password='$pass'";

			$result=mysqli_query($this->db,$sql);

			if($result){
				return array("success"=>true);
			}
			else{
				return array("success"=>false);
			}	
		}
	}

	if(isset($_POST["action"])){

		$user = new UserManager();

		if($_POST["action"]=="signup"){
			echo json_encode($user->doSignup($_POST["name"],$_POST["cid"],$_POST["course"],$_POST["email"],
				$_POST["mobile"],$_POST["pass"],$_POST["cpass"]));
		}
		elseif($_POST["action"]=="signin"){
			echo json_encode($user->doLogin($_POST['cid'],$_POST['pass']));	
		}
		elseif($_POST["action"]=="change_pass"){
			echo json_encode($user->doPasswordChange($_POST['cid'],$_POST['cur_pass'],$_POST['new_pass'],$_POST['cnf_pass']));
		}
		elseif($_POST["action"]=="change_setting"){
			echo json_encode($user->doPersonalChange($_POST['name'],$_POST['course'],$_POST['mobile'],$_POST['email'],$_POST['cid'],$_POST['pass']));
		}
	}

?>
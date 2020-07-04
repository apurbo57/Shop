<?php 
	$file_path = realpath(dirname(__FILE__));
	include_once ($file_path.'/../lib/database.php');
	include_once ($file_path.'/../helpers/format.php');
	include_once ($file_path.'/../lib/session.php');
	session::checkLogin(); 
?>
<?php 
	/**
	 * adminlogin
	 */
	class adminlogin {
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new database();
			$this->fm = new format();
		}

		public function adminlogin($adminUser, $adminPass){
			$adminUser = $this->fm->validation($adminUser);
			$adminPass = $this->fm->validation($adminPass);

			$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
			$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

			if (empty($adminUser) || empty($adminPass)) {
				$loginmsg = "Feild Must Not be empty!";
				return $loginmsg;
			}else{
				$query = ("SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' ");
				$result = $this->db->select($query);
				if ($result != false) {
					$value = $result->fetch_assoc();
					session::set("login", true);
					session::set("adminId", $value['adminId']);
					session::set("adminName", $value['adminName']);
					session::set("adminUser", $value['adminUser']);
					header("location: index.php");
				}else{
					$loginmsg = "User Name or Password Not Match";
					return $loginmsg;
				}
			}

		}
	}
 ?>
<?php 
	$file_path = realpath(dirname(__FILE__));
	include_once ($file_path.'/../lib/database.php');
	include_once ($file_path.'/../helpers/format.php');
?>
<?php 
	/**
	 * category class
	 */
	class category{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new database();
			$this->fm = new format();
		}

		public function catInsert($catName){
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);

			if (empty($catName)) {
				$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Feild Must Not be empty!</span>";
				return $msg;
			}else{
				$query = "INSERT INTO tbl_category(catName) VALUES('$catName') ";
				$insertcat = $this->db->insert($query);
				if ($insertcat) {
					$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Category Inserted Successfully.</span>";
					return $msg;
				}else{
					$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Catgory Not Inserted!</span>";
					return $msg;
				}
			}
		}

		public function getallcat(){
			$query  = "SELECT * FROM tbl_category ORDER BY catId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getcatById($id){
			$query = "SELECT * FROM tbl_category WHERE catId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function updatecat($catName, $id){
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if (empty($catName)) {
				$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Feild Must Not be empty!</span>";
				return $msg;
			}else{
				$query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id' ";
				$catupdated_row = $this->db->update($query);
				if ($catupdated_row) {
					$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Category Updated Successfully.</span>";
					return $msg;
				}else{
					$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Category Not Updated!</span>";
					return $msg;
				}
			}
		}

		public function delcatBy($id){
			$query = "DELETE FROM tbl_category WHERE catId = '$id' ";
			$deldata = $this->db->delete($query);
			if ($deldata) {
				$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Category Deleted Successfully.</span>";
				return $msg;
			}else{
				$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Category Not Deleted!</span>";
				return $msg;
			}
		}
	}
 ?>
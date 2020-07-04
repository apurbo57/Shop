<?php 
	$file_path = realpath(dirname(__FILE__));
	include_once ($file_path.'/../lib/database.php');
	include_once ($file_path.'/../helpers/format.php');
?>
<?php 
	/**
	 * brand class
	 */
	class Brand{
		
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new database();
			$this->fm = new format();
		}
		public function brandInsert($brandName){
			$brandName = $this->fm->validation($brandName);
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);

			if (empty($brandName)) {
				$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Feild Must Not be empty!</span>";
				return $msg;
			}else{
				$query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName') ";
				$insertbrand = $this->db->insert($query);
				if ($insertbrand) {
					$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Brand Inserted Successfully.</span>";
					return $msg;
				}else{
					$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Brand Not Inserted!</span>";
					return $msg;
				}
			}
		}

		public function getallBrand(){
			$query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getbrandById($id){
			$query = "SELECT * FROM tbl_brand WHERE brandId = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function updatebrand($brandName, $id){
			$brandName = $this->fm->validation($brandName);
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if (empty($catName)) {
				$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Feild Must Not be empty!</span>";
				return $msg;
			}else{
				$query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id' ";
				$brandUpdated_row = $this->db->update($query);
				if ($brandUpdated_row) {
					$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Brand Updated Successfully.</span>";
					return $msg;
				}else{
					$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Brand Not Updated!</span>";
					return $msg;
				}
			}
		}

		public function delbrandBy($id){
			$query = "DELETE * FROM tbl_brand WHERE brandId = '$id' ";
			$deldata = $this->db->delete($query);
			if ($deldata) {
				$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Brand Deleted Successfully.</span>";
				return $msg;
			}else{
				$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Brand Not Deleted!</span>";
				return $msg;
			}
		}

	}
 ?>
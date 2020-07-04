<?php 
	$file_path = realpath(dirname(__FILE__));
	include_once ($file_path.'/../lib/database.php');
	include_once ($file_path.'/../helpers/format.php');
?>
<?php 
	/**
	 * cart class
	 */
	class cart{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new database();
			$this->fm = new format();
		}

		public function addToCart($quantity, $id){
			$quantity = $this->fm->validation($quantity);
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$productId 	  = mysqli_real_escape_string($this->db->link, $id);
			$sId      = session_id();

			$query    = "SELECT * FROM tbl_product WHERE productId = '$productId' ";
			$result   = $this->db->select($query)->fetch_assoc();

			$productName = $result['productName'];
			$price 	 	 = $result['price'];
			$img 	 	 = $result['img'];

			$query    = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId' ";
			$getpro   = $this->db->select($query);
			if ($getpro) {
				$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Product Already Exist!</span>";
				return $msg;
			}else{
				$query = "INSERT INTO tbl_cart(sId, productId, productName,
				price, quantity, img) VALUES('$sId', '$productId', '$productName', '$price', '$quantity', '$img')  ";
				$inserted_row = $this->db->insert($query);
				if ($inserted_row) {
					header("location: cart.php");
				}else{
					header("location: 404.php");
				}
			}
			
		}

		public function getcartProduct(){
			$id = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function UpdateCartQuantity($quantity, $cartId){
			$cartId = mysqli_real_escape_string($this->db->link, $cartId);
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);

			$query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId' ";
			$result = $this->db->update($query);
			if ($result) {
				header("location: cart.php");
			}else{
				$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Quantity Not Updated!</span>";
				return $msg;
			}
		}

		public function deletecartById($id){
			$cartId = mysqli_real_escape_string($this->db->link, $id);

			$query = "DELETE FROM tbl_cart WHERE cartId= '$cartId' ";
			$result = $this->db->delete($query);
			if ($result) {
				$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Delete Successfully</span>";
				return $msg;
			}else{
				$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Delete Not Successfully!</span>";
				return $msg;
			}
		}

		public function cheakcartpro(){
			$id = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function deletecustomersdatacart(){
			$sid = session_id();
			$query = "DELETE FROM tbl_cart WHERE sid = '$sid' ";
			$result = $this->db->delete($query);
		}

		public function orderProduct($cmrId){
			$id = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId = '$id' ";
			$result = $this->db->select($query);
			if ($result) {
				while ($getpro   = $result->fetch_assoc()) {
					$productId   = $getpro['productId'];
					$productName = $getpro['productName'];
					$quantity    = $getpro['quantity'];
					$price       = $getpro['price'] * $quantity;
					$img         = $getpro['img'];

					$query = "INSERT INTO tbl_order(cmrId, productId, productName,
					price, quantity, img) VALUES('$cmrId', '$productId', '$productName', '$price', '$quantity', '$img')  ";
					$inserted_row = $this->db->insert($query);
				}
			}
		}

		public function getvattotalprice($cmrId){
			$query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId' AND date = now() ";
			$result = $this->db->select($query);
			return $result;
		}

		public function getdetailsProduct($cmrId){
			$query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function deleteorderById($id){
			$cartId = mysqli_real_escape_string($this->db->link, $id);

			$query = "DELETE FROM tbl_order WHERE id= '$id' ";
			$result = $this->db->delete($query);
			if ($result) {
				$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Delete Successfully</span>";
				return $msg;
			}else{
				$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Delete Not Successfully!</span>";
				return $msg;
			}
		}
		
}
?>
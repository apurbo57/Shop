<?php 
	$file_path = realpath(dirname(__FILE__));
	include_once ($file_path.'/../lib/database.php');
	include_once ($file_path.'/../helpers/format.php');
?>
<?php 
	/**
	 * product class
	 */
	class product{
			private $db;
			private $fm;
			public function __construct(){
				$this->db = new database();
				$this->fm = new format();
			}

		public function productInsert($data, $files){
			$productName = $this->fm->validation($data['productName']);
			$catId 		 = $this->fm->validation($data['catId']);
			$brandId 	 = $this->fm->validation($data['brandId']);
			$body 		 = $this->fm->validation($data['body']);
			$price 		 = $this->fm->validation($data['price']);
			$type 		 = $this->fm->validation($data['type']);

			$productName = mysqli_real_escape_string($this->db->link, $productName);
			$catId 		 = mysqli_real_escape_string($this->db->link, $catId);
			$brandId	 = mysqli_real_escape_string($this->db->link, $brandId);
			$body		 = mysqli_real_escape_string($this->db->link, $body);
			$price 		 = mysqli_real_escape_string($this->db->link, $price);
			$type		 = mysqli_real_escape_string($this->db->link, $type);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
	        $file_name = $files['img']['name'];
	        $file_temp = $files['img']['tmp_name'];

	        $div = explode('.', $file_name);
	        $file_ext = strtolower(end($div));
	        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	        $uploaded_image = "upload/".$unique_image;

	        if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "" || $file_name == "" ) {

            	$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Feild Must Not be empty!</span>";
            	return $msg;

        	}elseif (in_array($file_ext, $permited) === false) {

             	$msg = "<span style='color:red;text-align:center;font-size: 18px;'>You can upload only:-"
             	.implode(', ', $permited)."</span>";
             	return $msg;

            } else{
            	move_uploaded_file($file_temp, $uploaded_image);

            	$query = "INSERT INTO tbl_product(productName, catId, brandId, body, price, img, type ) VALUES ( '$productName', '$catId', '$brandId', '$body', '$price', '$uploaded_image', '$type' )";
            	$productInsert = $this->db->insert($query);
            	if ($productInsert) {
            		$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Product Inserted Successfully.</span>";
            		return $msg;
            	}else{
            		$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Product Not Inserted !</span>";
            		return $msg;
            	}
            }
		} //end Product Insert

		public function getAllProduct(){
			$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
					FROM tbl_product
					INNER JOIN tbl_category
					ON tbl_product.catID = tbl_category.catId
					INNER JOIN tbl_brand
					ON tbl_product.brandId = tbl_brand.brandId
			
			ORDER BY tbl_product.productId DESC";
			$result = $this->db->select($query);
			return $result;
		} //end getAllProduct

		public function getproductById($id){
			$query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
			$result = $this->db->select($query);
			return $result;
		} //end getproductById
		
		public function productUpdate($data, $files, $id){
			$productName = $this->fm->validation($data['productName']);
			$catId 		 = $this->fm->validation($data['catId']);
			$brandId 	 = $this->fm->validation($data['brandId']);
			$body 		 = $this->fm->validation($data['body']);
			$price 		 = $this->fm->validation($data['price']);
			$type 		 = $this->fm->validation($data['type']);

			$productName = mysqli_real_escape_string($this->db->link, $productName);
			$catId 		 = mysqli_real_escape_string($this->db->link, $catId);
			$brandId	 = mysqli_real_escape_string($this->db->link, $brandId);
			$body		 = mysqli_real_escape_string($this->db->link, $body);
			$price 		 = mysqli_real_escape_string($this->db->link, $price);
			$type		 = mysqli_real_escape_string($this->db->link, $type);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
	        $file_name = $files['img']['name'];
	        $file_temp = $files['img']['tmp_name'];

	        $div = explode('.', $file_name);
	        $file_ext = strtolower(end($div));
	        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	        $uploaded_image = "upload/".$unique_image;

	        if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "") {

            	$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Feild Must Not be empty!</span>";
            	return $msg;

        	}else{
        		if (!empty($file_name)) {
        			if (in_array($file_ext, $permited) === false) {

		             	$msg = "<span style='color:red;text-align:center;font-size: 18px;'>You can upload only:-"
		             	.implode(', ', $permited)."</span>";
		             	return $msg;

		            } else{
		            	move_uploaded_file($file_temp, $uploaded_image);
		            	$query = "UPDATE tbl_product SET
									productName = '$productName',
									catId 		= '$catId',
									brandId 	= '$brandId',
									body 		= '$body',
									price 		= '$price',
									img 		= '$uploaded_image',
									type 		= '$type'
		            			WHERE productId = '$id'	";

		            	$productUpdated = $this->db->update($query);
		            	if ($productUpdated) {
		            		$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Product Updated Successfully.</span>";
		            		return $msg;
		            	}else{
		            		$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Product Not Updated !</span>";
		            		return $msg;
		            	}
		            }
        		}else{
        			$query = "UPDATE tbl_product SET
									productName = '$productName',
									catId 		= '$catId',
									brandId 	= '$brandId',
									body 		= '$body',
									price 		= '$price',
									type 		= '$type'
		            			WHERE productId = '$id'	";

		            	$productUpdated = $this->db->update($query);
		            	if ($productUpdated) {
		            		$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Product Updated Successfully.</span>";
		            		return $msg;
		            	}else{
		            		$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Product Not Updated !</span>";
		            		return $msg;
		            	}
        		}
        	} //end main else
		} //end productUpdate

		public function delproductById($id){
			$query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
			$result = $this->db->select($query);
			if ($result) {
				while ($data = $result->fetch_assoc()) {
					$img = $data['img'];
					unlink($img);
				}
			}

			$query  = "DELETE FROM tbl_product WHERE productId = '$id' ";
			$result = $this->db->delete($query);
			if ($result) {
				$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Product Deleted Successfully.</span>";
		         return $msg;
			}else{
				$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Product Not Deleted !</span>";
		         return $msg;
			}
		} //end delete product

		public function getAllFetureProd(){
			$query = "SELECT * FROM tbl_product WHERE type= '0' ORDER BY productId DESC LIMIT 4 ";
			$result = $this->db->select($query);
			return $result;
		}

		public function getNewProduct(){
			$query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4 ";
			$result = $this->db->select($query);
			return $result;
		}

		public function getSingleProduct($id){
			$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
				FROM tbl_product
				INNER JOIN tbl_category
				ON tbl_product.catId = tbl_category.catId
				INNER JOIN tbl_brand
				ON tbl_product.brandId = tbl_brand.brandId
			WHERE productId = '$id' ";
			$getNewp = $this->db->select($query);
			return $getNewp;
		}

		public function getBrandProIphone(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '1' ORDER BY productId DESC LIMIT 1 ";
			$result = $this->db->select($query);
			return $result;
		}

		public function getBrandProSamsung(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId DESC LIMIT 1 ";
			$result = $this->db->select($query);
			return $result;
		}

		public function getBrandProAcer(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '3' ORDER BY productId DESC LIMIT 1 ";
			$result = $this->db->select($query);
			return $result;
		}

		public function getBrandProCanon(){
			$query = "SELECT * FROM tbl_product WHERE brandId = '4' ORDER BY productId DESC LIMIT 1 ";
			$result = $this->db->select($query);
			return $result;
		}

		public function getAllProductByCatId($catId){
			$query = "SELECT * FROM tbl_product WHERE catId = '$catId' ORDER BY productId DESC";
			$result = $this->db->select($query);
			return $result;
		}
  }
?>
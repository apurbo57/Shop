<?php 
	$file_path = realpath(dirname(__FILE__));
	include_once ($file_path.'/../lib/database.php');
	include_once ($file_path.'/../helpers/format.php');
?>
<?php 
	/**
	 * customer class
	 */
	class Customer{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new database();
			$this->fm = new format();
		}

		public function CustomersRegistration($data){
			$name 		 = $this->fm->validation($data['name']);
			$city 	 	 = $this->fm->validation($data['city']);
			$zip 		 = $this->fm->validation($data['zip']);
			$email 		 = $this->fm->validation($data['email']);
			$address 	 = $this->fm->validation($data['address']);
			$country 	 = $this->fm->validation($data['country']);
			$phone 		 = $this->fm->validation($data['phone']);
			$password 	 = $this->fm->validation($data['password']);

			$name	 = mysqli_real_escape_string($this->db->link, $name);
			$city	 = mysqli_real_escape_string($this->db->link, $city);
			$zip	 = mysqli_real_escape_string($this->db->link, $zip);
			$email   = mysqli_real_escape_string($this->db->link, $email);
			$address = mysqli_real_escape_string($this->db->link, $address);
			$country = mysqli_real_escape_string($this->db->link, $country);
			$phone	 = mysqli_real_escape_string($this->db->link, $phone);
			$password= mysqli_real_escape_string($this->db->link, md5(sha1($password)));

			if ($name == "" ||$city == "" ||$zip == "" ||$email == "" ||$address == "" ||$country == "" ||$phone == "" ||$password == "" ) {
					$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Feild Must Not be empty!</span>";
            		return $msg;
			}
			$mail_query = "SELECT * FROM customer WHERE email = '$email' LIMIT 1 ";
			$mailchk = $this->db->select($mail_query);
			if ($mailchk != false) {
				$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Email Already Exist !</span>";
            		return $msg;
			}else{
				$query = "INSERT INTO customer(name, address, city, country, zipCode, phone, email, password ) VALUES ( '$name', '$address', '$city', '$country', '$zip', '$phone', '$email', '$password' )";
            	$customerInsert = $this->db->insert($query);
            	if ($customerInsert) {
            		$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Customer Registration Successfully.</span>";
            		return $msg;
            	}else{
            		$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Customer Not Registred !</span>";
            		return $msg;
            	}
			}
		}

		public function Customerslogin($data){
			$email   = mysqli_real_escape_string($this->db->link, $data['email']);
			$pass    = mysqli_real_escape_string($this->db->link, md5(sha1($data['password'])));
			if ($email == "" || $pass == "") {
				 $msg = "<span style='color:red;text-align:center;font-size: 18px;'>Feild Must Not be empty!</span>";
            	 return $msg;
			}

			$query = "SELECT * FROM customer WHERE email = '$email' AND password = '$pass' ";
			$result = $this->db->select($query);
			if ($result != false) {
				$value = $result->fetch_assoc();
				session::set("cuslogin", true);
				session::set("cmrId", $value['id']);
				session::set("cmrName", $value['name']);
				header("location: order.php");
			}else{
				$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Email Or Password Not Match!</span>";
            	 return $msg;
			}
		}

		public function getCustomerData($id){
			$query = "SELECT * FROM customer WHERE id = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function updateCustomerData($data, $cmrId){
			$name 	 = $this->fm->validation($data['name']);
			$phone 	 = $this->fm->validation($data['phone']);
			$email 	 = $this->fm->validation($data['email']);
			$address = $this->fm->validation($data['address']);
			$zipCode = $this->fm->validation($data['zipCode']);
			$city 	 = $this->fm->validation($data['city']);
			$country = $this->fm->validation($data['country']);

			$name    = mysqli_real_escape_string($this->db->link, $name);
			$phone 	 = mysqli_real_escape_string($this->db->link, $phone);
			$email	 = mysqli_real_escape_string($this->db->link, $email);
			$address = mysqli_real_escape_string($this->db->link, $address);
			$zipCode = mysqli_real_escape_string($this->db->link, $zipCode);
			$city    = mysqli_real_escape_string($this->db->link, $city);
			$country = mysqli_real_escape_string($this->db->link, $country);

	        if ($name == "" || $phone == "" || $email == "" || $address == "" || $zipCode == "" || $city == "" || $country == "") {

            	$msg = "<span style='color:red;text-align:center;font-size: 18px;'>Feild Must Not be empty!</span>";
            	return $msg;

        	}else{
        			$query = "UPDATE customer SET
									name     = '$name',
									address  = '$address',
									city 	 = '$city',
									country  = '$country',
									zipCode  = '$zipCode',
									phone 	 = '$phone',
									email 	 = '$email'
		            			WHERE id = '$cmrId'	";

		            	$productUpdated = $this->db->update($query);
		            	if ($productUpdated) {
		            		$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Information Updated Successfully.</span>";
		            		return $msg;
		            	}else{
		            		$msg = "<span style='color:green;text-align:center;font-size: 18px;'>Information Not Updated !</span>";
		            		return $msg;
		            	}
        		}
		}

		


	}
 ?>
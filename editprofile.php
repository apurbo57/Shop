<?php include 'inc/header.php'; ?>
<?php 
	  $login = session::get("cuslogin");
	  if ($login !== true) {
	  	 header("location: login.php");
	  }
 ?>
 <?php 
 	$cmrId = Session::get("cmrId");
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $updatecustomer = $cmr->updateCustomerData($_POST, $cmrId);
    }
 ?>
 <style>
 	.tblone{width: 550px; margin: 0 auto; border: 2px solid #ccc;}
 	.tblone tr td{text-align: justify;}
 	.tblone tr td input[type="text"]{width: 400px; padding: 10px;}
 </style>
 <div class="main">
    <div class="content">
	     <div class="section group">
			<div class="order">
		<form action="" method="POST">
			<?php 
				$id = session::get("cmrId");
				$getData = $cmr->getCustomerData($id);
				if ($getData) {
					while ($result = $getData->fetch_assoc()) { ?>
						
				<table class="tblone">
					<?php 
							if (isset($updatecustomer)) {
								echo $updatecustomer;
							}
						 ?>
					<tr>
						<td colspan="3"><h2>Udate Profile Information</h2></td>
					</tr>
					<tr>
						<td width="20%">Name</td>
						<td width="5%">:</td>
						<td><input type="text" name="name" value="<?php echo $result["name"]; ?>"></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td>:</td>
						<td><input type="text" name="phone" value="<?php echo $result["phone"]; ?>"></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><input type="text" name="email" value="<?php echo $result["email"]; ?>"></td>
					</tr>
					<tr>
						<td>Address</td>
						<td>:</td>
						<td><input type="text" name="address" value="<?php echo $result["address"]; ?>"></td>
					</tr>
					<tr>
						<td>Zip Code</td>
						<td>:</td>
						<td><input type="text" name="zipCode" value="<?php echo $result["zipCode"]; ?>"></td>
					</tr>
					<tr>
						<td>City</td>
						<td>:</td>
						<td><input type="text" name="city" value="<?php echo $result["city"]; ?>"></td>
					</tr>
					<tr>
						<td>Country</td>
						<td>:</td>
						<td><input type="text" name="country" value="<?php echo $result["country"]; ?>"></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td><input type="submit" name="submit" value="Save"></td>
					</tr>
				</table>
			<?php } } ?>
			</form>
			</div>
		</div>
    </div>
 </div>
</div>

<?php include 'inc/footer.php'; ?>
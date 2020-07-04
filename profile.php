<?php include 'inc/header.php'; ?>
<?php 
	  $login = session::get("cuslogin");
	  if ($login !== true) {
	  	 header("location: login.php");
	  }
 ?>
 <style>
 	.tblone{width: 500px; margin: 0 auto; border: 2px solid #ccc;}
 	.tblone tr td{text-align: justify;}
 </style>
 <div class="main">
    <div class="content">
	     <div class="section group">
			<div class="order">
			<?php 
				$id = session::get("cmrId");
				$getData = $cmr->getCustomerData($id);
				if ($getData) {
					while ($result = $getData->fetch_assoc()) { ?>
						
				<table class="tblone">
					<tr>
						<td colspan="3"><h2>Your Profile Information</h2></td>
					</tr>
					<tr>
						<td width="20%">Name</td>
						<td width="5%">:</td>
						<td><?php echo $result["name"]; ?></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td>:</td>
						<td><?php echo $result["phone"]; ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><?php echo $result["email"]; ?></td>
					</tr>
					<tr>
						<td>Address</td>
						<td>:</td>
						<td><?php echo $result["address"]; ?></td>
					</tr>
					<tr>
						<td>Zip Code</td>
						<td>:</td>
						<td><?php echo $result["zipCode"]; ?></td>
					</tr>
					<tr>
						<td>City</td>
						<td>:</td>
						<td><?php echo $result["city"]; ?></td>
					</tr>
					<tr>
						<td>Country</td>
						<td>:</td>
						<td><?php echo $result["country"]; ?></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td><a href="editprofile.php">Edit Profile</a></td>
					</tr>
				</table>
			<?php } } ?>
			</div>
		</div>
    </div>
 </div>
</div>

<?php include 'inc/footer.php'; ?>
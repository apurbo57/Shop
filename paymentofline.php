<?php include 'inc/header.php'; ?>
<?php 
	  $login = session::get("cuslogin");
	  if ($login !== true) {
	  	 header("location: login.php");
	  }
 ?>
 <?php 
 	if (isset($_GET['delpro'])) {
		$id = $_GET['delpro'];

		$delcart = $ct->deletecartById($id);
	}

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$quantity = $_POST['quantity'];
		$cartId = $_POST['cartId'];

		$UpdateCart = $ct->UpdateCartQuantity($quantity, $cartId);

		if ($quantity <=0) {
			$delcart = $ct->deletecartById($cartId);
		}

	}
  ?>
  <?php 
  	if (isset($_GET['orderId']) && $_GET['orderId']=='order') {
  		$cmrId = session::get("cmrId");
  		$insertOrder = $ct->orderProduct($cmrId);
  		$deldata = $ct->deletecustomersdatacart();
  		header("location: paymentsuccess.php");
  	}
   ?>

 <style>
 	.division{width: 50%; float: left;}
 	.tblone{width: 550px; margin: 0 auto; border: 2px solid #ccc;}
 	.tblone tr td{text-align: justify;}
 	.tbltow{width: 60%;border: 2px solid #ccc;float: right;text-align: left;margin-top: 10px;margin-right: 20px;}
 	.tbltow tr td{text-align: justify; padding: 5px 10px;}
 	.order{margin: 0 auto;display: block;width: 100px;background-color: #f00;color: #fff;font-size: 25px;text-align: center;padding: 10px;border-radius: 5px;margin-top: 50px;}
 </style>

 <div class="main">
    <div class="content">
	     <div class="section group">
			<div class="division">
					<table class="tblone">
							<tr>
								<th>No</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total Price</th>
								<th>Action</th>
							</tr>
						<?php 
							$getProduct = $ct->getcartProduct();
							if ($getProduct) {
								$i=0;
								$sum=0;
								$qty=0;
								while ($result = $getProduct->fetch_assoc()) { $i++ ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td>$ <?php echo $result['price']; ?></td>
								<td>
			<form action="" method="post">
				<input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>

				<input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>

				<input type="submit" name="submit" value="Update"/>
			</form>
								</td>
								<td><?php 
									$total= $result['price'] * $result['quantity'];
									echo "$".$total;
								 ?></td>
								<td><a onclick="return confirm('Are You Sure To Delete!')"; href="?delpro=<?php echo $result['cartId']; ?>">X</a></td>
							</tr>
							<?php 
								$sum = $sum + $total;
								$qty = $qty + $result['quantity'];
								Session::set("qty", $qty);
							 ?>
						<?php } } ?>
							
							
						</table>
						<?php 
							$getResult = $ct->cheakcartpro();
							if ($getResult) { ?>
								<table class="tbltow">
									<tr>
										<td>Sub Total</td>
										<td>:</td>
										<td>$ <?php echo $sum; ?></td>
									</tr>
									<tr>
										<td>VAT</td>
										<td>:</td>
										<td>10% ($<?php echo $sum * 0.1; ?>)</td>
									</tr>
									<tr>
										<td>Quantity</td>
										<td>:</td>
										<td><?php echo $qty; ?></td>
									</tr>
									<tr>
										<td>Grand Total</td>
										<td>:</td>
										<td>$ <?php 
											$vat = $sum * 0.1;
											$gtotal = $sum + $vat;
											echo $gtotal;
										 ?></td>
									</tr>
							   </table><?php }else{
							   		echo "Your Cart Is Empty ! Please Shop Now.";
							   } ?>
			</div>
			<div class="division">
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
		<a class="order" href="?orderId=order">Order</a>
    </div>
 </div>
</div>

<?php include 'inc/footer.php'; ?>
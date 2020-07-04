<?php include 'inc/header.php'; ?>
<?php 
	  $login = session::get("cuslogin");
	  if ($login !== true) {
	  	 header("location: login.php");
	  }
 ?>
 <div class="main">
    <div class="content">
	     <div class="section group">
			<div class="order">
				<?php 
					$cmrId = session::get("cmrId");
					$getprice = $ct->getvattotalprice($cmrId);
					if ($getprice) {
						$sum =0;
						while ($result = $getprice->fetch_assoc()) {
							$price = $result['price'];
							$sum = $sum + $price;
						}
					}
				 ?>
					<div class="ordersuccess">
						<h2>Success</h2>
						<hr>
						<p>Total Payable Amount(Including Vat) $
							<?php 
								$vat = $sum * 0.1;
								$total = $sum + $vat;
								echo $total;
							 ?>
						</p>
						<p>Thanks For Purchase. We Will Contact You With Order Details As Soon As Possible. Here Your Order Details...<a href="paymentdetails.php">Visit Now</a></p>
					</div>
					<a class="backbutton" href="index.php">Back</a>
			</div>
		</div>
    </div>
 </div>
</div>

<?php include 'inc/footer.php'; ?>
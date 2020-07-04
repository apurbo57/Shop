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
				
					<div class="payment">
						<h2>Payment Option</h2>
						<hr>
						<a href="#">Online Payment</a>
						<a href="paymentofline.php">Ofline Payment</a>
					</div>
					<a class="backbutton" href="cart.php">Back</a>
			</div>
		</div>
    </div>
 </div>
</div>

<?php include 'inc/footer.php'; ?>
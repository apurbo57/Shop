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
				<h2>Order page</h2>
			</div>
		</div>
    </div>
 </div>
</div>

<?php include 'inc/footer.php'; ?>
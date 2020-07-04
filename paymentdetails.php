<?php include 'inc/header.php'; ?>
<?php 

	if (isset($_GET['delpro'])) {
		$id = $_GET['delpro'];

		$delcart = $ct->deleteorderById($id);
	}

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$quantity = $_POST['quantity'];
		$cartId = $_POST['cartId'];

		$UpdateCart = $ct->UpdateCartQuantity($quantity, $cartId);

		if ($quantity <=0) {
			$delcart = $ct->deletecartById($cartId);
		}

	}

	if (!isset($_GET['id'])) {
		echo("<meta http-equiv='refresh' content='0;URL=?id=live'>");
	}
 ?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<?php 
			    		if (isset($UpdateCart)) {
			    			echo $UpdateCart;
			    		}
			    		if (isset($delcart)) {
			    			echo $delcart;
			    		}
			    	 ?>
						<table class="tblone">
							<tr>
								<th width="5%">SL</th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="25%">Quantity</th>
								<th width="15%">Price</th>
								<th width="15%">Date</th>
								<th width="15%">Status</th>
								<th width="10%">Action</th>
							</tr>
						<?php 
							$cmrId = Session::get("cmrId");
							$getProduct = $ct->getdetailsProduct($cmrId);
							if ($getProduct) {
								$i=0;
								while ($result = $getProduct->fetch_assoc()) { $i++ ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/<?php echo $result['img']; ?>" alt=""/></td>
								<td><?php echo $result['quantity']; ?></td>
								<td><?php 
									$total= $result['price'] * $result['quantity'];
									echo "$".$total;
								 ?></td>
								 <td><?php echo $fm->FormatDate($result['date']); ?></td>
								 <td>
								 	<?php 
								 		if ($result['status'] == 0) {
								 			echo "Panding";
								 		}else{
								 			echo "Shifted";
								 		}
								 	 ?>
								 </td>
								 <td>
								<?php 
									if ($result['status'] == 1) { ?>
										<td><a onclick="return confirm('Are You Sure To Delete!')"; href="?delpro=<?php echo $result['id']; ?>">X</a></td>
								<?php	}else{
									echo "N/A";
								} ?>
								</td>
							</tr>
						<?php } } ?>
							
							
						</table>
						
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>

 <?php include 'inc/footer.php'; ?>
<?php include 'inc/header.php'; ?>
<?php 
	if (!isset($_GET['catId']) || $_GET['catId']== NULL) {
		header("location: 404.php");
	}else{
		
		$catId = $_GET['catId'];
	}
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from Iphone</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			<?php 
				$getProBycatId = $pd->getAllProductByCatId($catId);
				if ($getProBycatId) {
					while ($result = $getProBycatId->fetch_assoc()) { ?>
						
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['img']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($result['body'],60); ?></p>
					 <p><span class="price">$ <?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="preview.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
			<?php } }else{
				echo "<span style='color:red;text-align:center;font-size: 18px;'>This Category Product Are Not Available !</span>";
			} ?>	

			</div>

	
	
    </div>
 </div>
</div>

<?php include 'inc/footer.php'; ?>
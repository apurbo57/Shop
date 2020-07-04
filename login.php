<?php include 'inc/header.php'; ?>
<?php 
	  $login = session::get("cuslogin");
	  if ($login !== false) {
	  	 header("location: order.php");
	  }
 ?>
<?php 
	if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])) {
		$customerlogin = $cmr->Customerslogin($_POST);
	}
 ?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<?php 
    			if (isset($customerlogin)) {
    				echo $customerlogin;
    			}
    		 ?>
        	<p>Sign in with the form below.</p>
        	<form action="" method="POST" id="member">
                	<input type="text" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Password">
                    <div class="buttons"><div><button name="login" class="grey">Sign In</button></div></div>
            </form>
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    
          </div>
<?php 
	if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register'])) {
		$customerReg = $cmr->CustomersRegistration($_POST);
	}
 ?>
    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<?php 
    			if (isset($customerReg)) {
    				echo $customerReg;
    			}
    		 ?>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name">
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="City">
							</div>
							
							<div>
								<input type="text" name="zip" placeholder="Zip Code">
							</div>
							<div>
								<input type="text" name="email" placeholder="E-mail">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Address">
						</div>
		    		<div>
						<input type="text" name="country" placeholder="Country">
					</div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Phone">
		          </div>
				  
				  <div>
					<input type="Password" name="password" placeholder="Password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button name="register" class="grey">Create Account</button></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>

 <?php include 'inc/footer.php'; ?>
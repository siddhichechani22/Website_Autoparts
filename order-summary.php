<?php

include 'check-logged-in.php';
// connect to database
	include 'database-connect.php';




	// Check if the user is logged in
	

	// attributes to get for order summary
	$transaction_ID = "";
	$date = "";
	$total_price = "";
	$user_ID = "";

	// get the transaction_ID from the url if any, else go back to my-account page

	
	$user_ID = $_SESSION['user_ID'];
$transaction_ID = $_SESSION['txn'];
	// Query to get transaction info
	$query = "SELECT *	FROM Transaction WHERE transaction_ID = $transaction_ID";
	$result = $con->query($query);
	$result->fetch_assoc();
	foreach($result as $r){
		$date = $r['date'];
		$total_price = $r['total_price'];
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Order Summary | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="images/home/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<?php
									if(isset($_SESSION['user_ID']) && isset($_SESSION['username'])){
										// show the account and logout button if logged in
										echo '<li><a href="my-account.html" class="" id="account_button"><i class="fa fa-user"></i> Account</a></li>';
										echo '<li><a href="logout.php" class="" id="logout_button"><i class="fa fa-sign-out"></i> Logout</a></li>';
									}else{
										// show the login button if not logged in
										echo '<li><a href="login.html" class="" id="login_button"><i class="fa fa-lock"></i> Login</a></li>';
									}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.html">Home</a></li>
								<li><a href="shop.html?keywords=%&category=&pageNumber=1" class="">Shop</a></li>
								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<section id="cart_items">
		<div class="container">
			<div class="shopper-info">
				<h2>Order Details</h2>
				<p>Ordered on <?php echo $date; ?> | Order ID# <?php echo $transaction_ID; ?></p>
			</div>

			<div class="shopper-informations">
				<div class="row">
					<div class="col-md-4">
						<div class="order-details">
							<h2>Shipping Address</h2>
							<p><?php echo $username; ?></p>
							<p><?php echo $first_name.' '.$last_name; ?></p>
							<p><?php echo $street_address; ?></p>
							<p><?php echo $city.', '.$state.' '.$zip; ?></p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="order-details">
							<h2>Payment Method</h2>
							<p>Credit ****</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="order-details">
							<h2>Order Summary</h2>
							<div class="col-md-6">
								<div class="row">
									<p>Item(s) Subtotal:</p>
								</div>
								<div class="row">
									<p>Shipping & Handling:</p>
								</div>
								<div class="row">
									<p>Total before tax:</p>
								</div>
								<div class="row">
									<p>Estimated tax:</p>
								</div>
								<div class="row order-sum-grand-total">
									<p>Grand Total:</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="order-summary-right">
										<p>$<?php echo $total_price; ?></p>
									</div>
								</div>
								<div class="row">
									<div class="order-summary-right">
										<p>$0.00</p>
									</div>
								</div>
								<div class="row">
									<div class="order-summary-right">
										<p>$<?php echo $total_price; ?></p>
									</div>
								</div>
								<div class="row">
									<div class="order-summary-right">
										<p>$0.00</p>
									</div>
								</div>
								<div class="row">
									<div class="order-summary-right order-sum-grand-total">
										<p>$<?php echo $total_price; ?></p>
									</div>
								</div>
							</div>
						</div>	
					</div>	
				</div>
			</div>
			
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Item Total Cost</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
							// Get items in the transaction
							$sql = "SELECT i.item_name, i.item_ID, i.price, ti.quantity
									FROM Item i
									JOIN Transaction_items ti ON i.item_ID = ti.item_ID
									WHERE ti.transaction_ID = $transaction_ID";
							$result = $con->query($sql);
							
							while($row = $result->fetch_object()){
								$item_total_price = $row->quantity * $row->price;
							
								echo '<tr>';
								echo '<td class="cart_product">';
								echo '<a href="product-details.html?item_ID='.$row->item_ID.'"><img src="images/product-details/'.$row->item_ID.'.jpg" alt="" /></a>';
								echo '</td>';
								
								echo '<td class="cart_description">';
								echo '<h4><a href="product-details.html?item_ID='.$row->item_ID.'">'.$row->item_name.'</a></h4>';
								echo '<p>Item ID: '.$row->item_ID.'</p>';
								echo '</td>';
								
								echo '<td class="cart_price">';
								echo '<p>$'.$row->price.'</p>';
								echo '</td>';
								
								echo '<td class="cart_quantity">';
								echo '<p>'.$row->quantity.'</p>';
								echo '</td>';
								
								echo '<td class="cart_total">';
								echo '<p class="cart_total_price">$'.$item_total_price.'</p>';
								echo '</td>';
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
			</div>
			
			
		</div>
	</section> <!--/#cart_items-->

	<?php
		include 'footer.html';
	?>

    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
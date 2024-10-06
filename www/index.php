<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css" />
  <title>Bernice's Electronics</title>

</head>

<?php
session_start();
$customer = isset($_SESSION['customer']) ? $_SESSION['customer'] : null;
?>

<body>
  <main>
   <?php include 'navigation.php'; ?> 
<h1>Bernice Electronics</h1>

<div class="image-container">
			<img src="images/basket.jpg" alt="Basket">
			<img src="images/shoppingcart.jpg" alt="Cart">
			
			</div>
<p class="shop"> Your One-Stop shop for Electronic Devices </p>
</main>
</body>
</html>

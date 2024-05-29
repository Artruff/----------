<?php
include 'php/config.php';
include 'php/functions.php';
?>
<!DOCTYPE html><html lang="ru">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />
  <script src="js/jquery-1.9.0.min.js"></script>
  <script src="js/cart.js"></script>
  <title>ChinaTown</title>
  <link rel="stylesheet" href="style.css">
</head>
<body onload="showCart()">
	<div class="fadein">
      <img src="images/TeaFarm.jpeg">
      <img src="images/CoffeBeans.jpeg">
      <img src="images/TeaField.jpeg">
    </div>
  <header>
    <?php 
    $page = "cart";
    include ('php/header.php');
    ?>
  </header>
    <div class="bigcanvas">  
      <div class="content">
      <p class="title_p">Ваша Корзина</p>
        <div class="cartPanel" id="cartPanel">
          
        </div>
      </div>
    </div>
  <footer>
    <?php include ('php/footer.php');?>
  </footer>
</body>
</html>
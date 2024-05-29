<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>ChinaTown</title>
  <link rel="shortcut icon" type="image/png" href="image/logo.png">
  <link rel="stylesheet" href="style.css">
  <script src="js/jquery-1.9.0.min.js"></script>
  <script src="js/jquery.accordion.js"></script>
  <script src="js/jquery.cookie.js"></script>
  <script src="js/cart.js"></script>
</head>
<body>
  <div class="fadein">
      <img src="images/TeaFarm.jpeg">
      <img src="images/CoffeBeans.jpeg">
      <img src="images/TeaField.jpeg">
    </div>
  <header>
    <?php 
    $page = "contact";
    include ('php/header.php');
    ?>
  </header>
    
  <div class="bigcanvas">  
    <div class="content">
      <p class="title_p">Наши контакты</p>
        <?php include ('php/contact_content.php');?>
    </div>
  </div>

  <footer>
    <?php include ('php/footer.php');?>
  </footer>
</body>
</html>
<ul class="menu-main">
    <li><img src="images/logo.png" class="logo"></li>
    <li><a href="index.php" <?php if($page == "shop"):?> class="current" <?php endif ?>>Каталог</a></li>
    <li><a href="shopmap.php" <?php if($page == "map"):?> class="current" <?php endif ?>>Магазины</a></li>
    <li><a href="cart_page.php" <?php if($page == "cart"):?> class="current" <?php endif ?>>Корзина</a></li>
    <li><a href="contact.php" <?php if($page == "contact"):?> class="current" <?php endif ?>>Контакты</a></li>
</ul>
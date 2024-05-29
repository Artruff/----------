<?php
  include 'php/catalog.php';

  $categories = get_cat();
  $categories_tree = create_tree($categories);
  $categories_menu = categories_to_string($categories_tree);
?>
<div class="menu-goods">
  <ul class="category">
    <?php echo $categories_menu ?>
  </ul>
  <div class="goodspanel">
    <p class="breadcrumbs"><?=$breadcrumbs;?></p>
    <div class="goodscells"> <?php if($products):?>
      <?php foreach($products as $product): ?>
        <div class="product-item">
          <div class="productimage"><img src="images/<?=$product['image']?>"></div>
          <div class="product-list">
            <h3><a href="?product=<?=$product['id']?>"><?=$product['title']?></a></h3>
            <h4><?=$product['short_content']?></h4>
            <span class="price"><?=$product['price']." р."?></span>
          </div>
          <a href="#" class="func_button" onclick="addToCart(<?=$product['id']?>)">В корзину</a>
        </div>
      <?php endforeach; ?>
      <?php else: ?>
        <p>Здесь товаров нет!</p>
        <?php endif; ?>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $(".category").dcAccordion();
  });
</script>
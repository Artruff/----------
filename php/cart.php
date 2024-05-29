<?php

//Запускаем сессию
session_start();

include 'config.php';
include 'functions.php';
echo"<script src='js/cart.js'></script>";

//Проверяем, создана ли сессия
$action = $_POST['action'];
if($action == 'show'){
	if (!(isset($_SESSION['cart']))){
		echo '
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<p class="title_p">У-у-упс...</p>
		<br>
		<p class="title_p">У вас нет заказов</p>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>';
		exit;
	}
	$cart = $_SESSION['cart'];
	if(count($cart) == 0){
		echo '
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<p class="title_p">У-у-упс...</p>
		<br>
		<p class="title_p">У вас нет заказов</p>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>';
		exit;
	}

	//Формируем строку id товаров для запроса
	foreach($cart as $product){
		$ids .= $product['id'].",";
	}

	//Получаем список товаров по id из корзины
	$ids = !$ids ? $ids : rtrim($ids, ",");
	$products = get_products_id($ids);

	//Выводим форму заказа
	echo '<form method="POST" action="php/order.php" >
			<ul class="form_order">
	    		<li>
	    			<p>Ф.И.О.</p>
	    			<input name="name" type="text"/>
	    		</li>
	    		<li>
	    			<p>Телефон</p>
	    			<input name="number" type="tel"/>
	    		</li>
	    		<li>
	    			<p>Эл. почта</p>
	    			<input name="email" type="email"/>
	    		</li>
	    		<li>
	    			<p>Адрес</p>
	    			<input name="address" type="text"/>
	    		</li>
	    		<li>
	    			<br>
  					<input type="submit" name="order" value="Заказать" class="func_button"/>
	    		</li>
	  		</ul>
	  	</form>
		  <div class="ordercells">';

	//Выводим товары из корзины
	foreach($products as $product){
		foreach($cart as $pr){
			if($pr['id'] == $product['id'])
				echo '
						<div class="product-item">
					        <div class="productimage"><img src="images/'.$product["image"].'">
					        </div>
					        <div class="product-list-long">
					           <h3><a href="?product='.$product["id"].'">'.$product["title"].'</a></h3>
					           <h4>'.$product["short_content"].'</h4>
					           <span id="itemPrice_'.$product["id"].'" class="price" value="'.$product["price"].'">'.$product["price"].' р.</span>
					           
					        </div>
					        <input class="input_field" name="itemCnt_'.$product["id"].'" id="itemCnt_'.$product["id"].'" type="text" value="'.$pr["count"].'" onchange="conversionPrice('.$product["id"].');"/>
					           <span id="total_price_'.$product["id"].'" class="total_price" value="'.$product["price"].'">Итого:<br>'.$product["price"].' р.</span>
					        <a href="#" class="func_button" onclick="delFromCart('.$product["id"].')">Убрать</a>
					    </div>
		        ';}
	}
	echo '</div>';
}

//Добавляем товар в сессионную корзину
if($action == 'add'){
	$cart = $_SESSION['cart'];
	$id = $_POST['id'];

	//Проверяем на наличие товара в корзине
	foreach($cart as $product){
		if($product['id'] == $id){
			$product['count'] +=1;
			$_SESSION['cart'] = $cart;
			exit;
		}
	}

	//Добавляем товар
	$newProduct["id"] = $id;
	$newProduct["count"] = 1;
	$cart[count($cart)] = $newProduct;

	$_SESSION['cart'] = $cart;
}

//Удаляем товар из корзины
if($action == 'del'){
	$cart = $_SESSION['cart'];
	$id = $_POST['id'];
	$newCart = array();

	//Формируем новую корзину
	foreach($cart as $product){
		if($product['id'] != $id){
			$newCart[count($newCart)] = $product;
		}
	}
	$_SESSION['cart'] = $newCart;
}
?>
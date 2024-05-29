<?php

/**
*распечатка массива
**/
function print_arr($array){
	echo "<pre>".print_r($array, true)."</pre>";
}

/**
*Получение массива категорий
**/
function get_cat(){
	global $connection;
	$query = "SELECT * FROM categories";
	$res = mysqli_query($connection, $query);

	$arr_cat = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$arr_cat[$row['id']] = $row;
	}
	return $arr_cat;
}

/**
*Получение массива магазинов
**/
function get_shops(){
	global $connection;
	$query = "SELECT * FROM shops";
	$res = mysqli_query($connection, $query);

	$arr_shops = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$arr_shops[] = $row;
	}
	return $arr_shops;
}

/**
*Построение дерева из массива
**/
function create_tree($array){
	$tree = array();

	foreach ($array as $id => &$node) {
		if(!$node['parent']){
			$tree[$id] = &$node;
		}else{
			$array[$node['parent']]['childs'][$id]= &$node;
		}
	}
	return $tree;
}

/**
* Узел дерева в строку HTML
**/
function categories_to_string($data){
	foreach($data as $item){
		$string .= categories_to_template($item);
	}
	return $string;
}

/**
* Шаблон вывода категорий
**/
function categories_to_template($category){
	ob_start();
	include 'category_template.php';
	return ob_get_clean();
}

/**
* Хлебные крошки
**/
function breadcrumbs($array, $id){
	if(!$id) return false;

	$count = count($array);
	$breadcrumbs_array = array();
	for($i = 0; $i < $count; $i++){
		if($array[$id]){
			$breadcrumbs_array[$array[$id]['id']] = $array[$id]['name'];
			$id = $array[$id]['parent'];
		}else break;
	}
	return array_reverse($breadcrumbs_array, true);
}

/**
*Функция получения ID дочерних категорий
**/
function cats_id($array, $id){
	if(!$id) return false;

	foreach ($array as $item) {
		if($item['parent'] == $id){
			$data .= $item['id'].",";
			$data .= cats_id($array, $item['id']);
		}
	}
	return $data;
}

/**
* получение товаров по категории
**/
function get_products($ids = false){
	global $connection;
	if($ids){
		$query = "SELECT * FROM products WHERE parent IN($ids) ORDER BY title";
	}else{
		$query = "SELECT * FROM products ORDER BY title";
	}
	$res = mysqli_query($connection, $query);
	$products = array();
	while($row = mysqli_fetch_assoc($res)){
		$products[] = $row;
	}
	return $products;
}

/**
* получение товаров по id
**/
function get_products_id($ids = false){
	global $connection;
	if($ids){
		$query = "SELECT * FROM products WHERE id IN($ids) ORDER BY title";
	}else{
		return false;
	}
	$res = mysqli_query($connection, $query);
	$products = array();
	while($row = mysqli_fetch_assoc($res)){
		$products[] = $row;
	}
	return $products;
}

/**
* получение id последнего заказа
**/
function get_id_order(){
	global $connection;
	$query = "SELECT MAX(id) FROM orders";
	$res = mysqli_query($connection, $query);
	$id = array();
	while($row = mysqli_fetch_assoc($res)){
		$id[] = $row;
	}
	return $id[0];
}

/**
* Создание заказа
**/
function create_order($name, $number, $email, $address, $cart){
	global $connection;
try {
	$query = 'INSERT INTO orders (name, number, email, address) values ("'.$name.'", "'.$number.'", "'.$email.'", "'.$address.'")';
	mysqli_query($connection, $query);
	$id = get_id_order();
	foreach($cart as $product){
		$query = 'INSERT INTO orders_products (id_order, id_products, count) values ("'.$id.'", "'.$product['id'].'", "1")';
		mysqli_query($connection, $query);
	}
} catch (Exception $e) {
	echo $e;
}
	
	return $true;
}
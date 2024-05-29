<?php
include 'php/config.php';
include 'php/functions.php';
$categories = get_cat();
$categories_tree = create_tree($categories);
$categories_menu = categories_to_string($categories_tree);

if(isset($_GET['category'])){
	$id = (int)$_GET['category'];
	// хлебные крошки
	// если параметры каталога пустые или неверные - вывести все товары
	$breadcrumbs_array = breadcrumbs($categories, $id);
	
	if($breadcrumbs_array){
		$breadcrumbs = "";
		foreach($breadcrumbs_array as $id => $title){
			$breadcrumbs .= "<a href='?category={$id}'>{$title}</a> ~ ";
		}
		$breadcrumbs = rtrim($breadcrumbs, " ~ ");
		$breadcrumbs = preg_replace("#(.+)?<a.+>(.+)</a>$#", "$1$2", $breadcrumbs);
	}else{
		$breadcrumbs = "Все товары";
	}

	//Получение ID дочерних категорий
	$ids = cats_id($categories, $id);
	$ids = !$ids ? $id : rtrim($ids, ",");

	if($ids) $products = get_products($ids);
		else $products = null;
	}else{
		$products = get_products();
	}
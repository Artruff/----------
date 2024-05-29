<?php
session_start();
include 'config.php';
include 'functions.php';

$cart = $_SESSION['cart'];
$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];
$address = $_POST['address'];

create_order($name, $number, $email, $address, $cart);
  header("Location: ../cart_page.php"); exit;
?>
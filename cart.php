<?php
session_start();

if (isset($_POST['add_to_cart'])) {
  $item = [
    'id' => $_POST['product_id'],
    'name' => $_POST['product_name'],
    'price' => $_POST['product_price'],
    'quantity' => $_POST['quantity']
  ];

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }

  $found = false;
  foreach ($_SESSION['cart'] as &$cartItem) {
    if ($cartItem['id'] == $item['id']) {
      $cartItem['quantity'] += $item['quantity'];
      $found = true;
      break;
    }
  }

  if (!$found) {
    $_SESSION['cart'][] = $item;
  }

  header('Location: cartmain.php');
  exit;
}

if (isset($_GET['remove'])) {
  foreach ($_SESSION['cart'] as $key => $item) {
    if ($item['id'] == $_GET['remove']) {
      unset($_SESSION['cart'][$key]);
    }
  }
  header('Location: cartmain.php');
  exit;
}
?>

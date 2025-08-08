<?php
require 'includes/db.php';
include 'nav.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo htmlspecialchars($product['name']); ?> | Frosto</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="product-detail-wrapper">
    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
    <img src="images/<?php echo htmlspecialchars($product['image_path']); ?>" alt="">
    <p>Category: <?php echo htmlspecialchars($product['category']); ?></p>
    <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
    <p>Price: <strong>Rs. <?php echo $product['price']; ?></strong></p>

    <form action="cart.php" method="POST">
      <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
      <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
      <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">

      <label for="quantity">Quantity:</label>
      <input type="number" name="quantity" id="quantity" value="1" min="1" required>

      <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
    </form>
  </div>
</body>
</html>

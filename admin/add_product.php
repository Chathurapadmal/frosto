<?php
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $cat = $_POST['category'];
  $desc = $_POST['description'];
  $price = $_POST['price'];
  $stock = $_POST['stock'];
  $img = $_FILES['image']['name'];
  
  move_uploaded_file($_FILES['image']['tmp_name'], "../images/$img");

  mysqli_query($conn, "INSERT INTO products (name, category, description, price, image_path, stock) 
   VALUES ('$name','$cat','$desc','$price','$img','$stock')");
  
  header("Location: dashboard.php");
  exit;
}

$categories = mysqli_query($conn, "SELECT DISTINCT category FROM products");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Product</title>
  <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
<a href="dashboard.php" class="btn">Main Page</a>


  <div class="form-container">
    <h2>Add New Product</h2>
    <form method="POST" enctype="multipart/form-data">
      <input name="name" placeholder="Name" required><br>

      <select name="category" required>
        <option value="">Select Category</option>
        <?php while ($row = mysqli_fetch_assoc($categories)) { ?>
          <option value="<?php echo htmlspecialchars($row['category']); ?>">
            <?php echo htmlspecialchars($row['category']); ?>
          </option>
        <?php } ?>
      </select><br>

      <textarea name="description" placeholder="Description" required></textarea><br>
      <input name="price" placeholder="Price" type="number" min="0" required><br>
      <input name="stock" placeholder="Stock" type="number" min="0" required><br>
      <input name="image" type="file" accept="image/*" required><br>
      <button type="submit" class="btn">Add Product</button>
    </form>
  </div>
</body>
</html>

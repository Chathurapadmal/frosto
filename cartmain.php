<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Your Cart</title>
  <link rel="stylesheet" href="css/cart.css">
  <style>
    table {
      width: 80%;
      margin: 20px auto;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center;
    }
    .btn {
      padding: 10px 15px;
      margin: 10px 5px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .btn:hover {
      background-color: #0056b3;
    }
    input[type="number"] {
      width: 60px;
      padding: 5px;
    }
  </style>
</head>
<body>
  <h2 style="text-align:center;">Your Shopping Cart</h2>

  <?php
  if (isset($_GET['remove'])) {
    $removeId = $_GET['remove'];
    unset($_SESSION['cart'][$removeId]);
    header("Location: cart.php");
    exit;
  }

  if (isset($_POST['update_qty'])) {
    foreach ($_POST['quantities'] as $id => $qty) {
      $_SESSION['cart'][$id]['quantity'] = max(1, (int)$qty);
    }
  }

  if (isset($_POST['purchase_selected'])) {
    $selected = $_POST['selected'] ?? [];
    if (empty($selected)) {
      echo "<p style='color:red;text-align:center;'>No items selected for purchase.</p>";
    } else {
      echo "<p style='color:green;text-align:center;'>✅ Purchase successful for items: " . implode(', ', $selected) . "</p>";
      foreach ($selected as $id) {
        unset($_SESSION['cart'][$id]);
      }
    }
  }
  ?>

  <?php if (!empty($_SESSION['cart'])): ?>
    <form method="POST">
      <table>
        <tr>
          <th>Select</th>
          <th>Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
          <th>Action</th>
        </tr>

        <?php foreach ($_SESSION['cart'] as $item): ?>
          <tr data-id="<?= $item['id'] ?>">
            <td><input type="checkbox" name="selected[]" value="<?= $item['id'] ?>"></td>
            <td><?= htmlspecialchars($item['name']) ?></td>
            <td class="unit-price"><?= $item['price'] ?></td>
            <td>
              <input type="number" name="quantities[<?= $item['id'] ?>]" value="<?= $item['quantity'] ?>" min="1" class="qty">
            </td>
            <td class="item-total"><?= $item['price'] * $item['quantity'] ?></td>
            <td><a href="cart.php?remove=<?= $item['id'] ?>">Remove</a></td>
          </tr>
        <?php endforeach; ?>

        <tr>
          <td colspan="4" style="text-align:right;"><strong>Grand Total:</strong></td>
          <td colspan="2" id="grandTotal"></td>
        </tr>
      </table>

      <div style="text-align:center; margin-top: 20px;">
        <button type="submit" name="update_qty" class="btn">Update Quantities</button>
        <button type="submit" name="purchase_selected" class="btn">Proceed to Payment</button>
      </div>
    </form>
  <?php else: ?>
    <p style="text-align:center;">Your cart is empty.</p>
  <?php endif; ?>

  <script>
    function updateTotals() {
      let grandTotal = 0;
      document.querySelectorAll('tr[data-id]').forEach(row => {
        const price = parseFloat(row.querySelector('.unit-price').textContent);
        const qtyInput = row.querySelector('.qty');
        const qty = parseInt(qtyInput.value) || 1;
        const total = price * qty;
        row.querySelector('.item-total').textContent = total;
        grandTotal += total;
      });
      document.getElementById('grandTotal').textContent = "Rs. " + grandTotal;
    }

    document.querySelectorAll('.qty').forEach(input => {
      input.addEventListener('input', updateTotals);
    });

    window.onload = updateTotals;
  </script>
</body>
</html>

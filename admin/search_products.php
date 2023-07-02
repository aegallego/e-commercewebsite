<?php
include '../components/connect.php';

$search = $_POST['search'];
$search = filter_var($search, FILTER_SANITIZE_STRING);

$select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%$search%' OR Productline_ID LIKE '%$search%' OR id LIKE '%$search%'");
$select_products->execute();
?>
      <tr>
         <th>Product ID</th>
         <th>Productline ID</th>
         <th>Product Name</th>
         <th>Stocks</th>
         <th></th>
</tr>
<?php
if ($select_products->rowCount() > 0) {
   while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <tr>
         <td><?= $fetch_products['id']; ?></td>
         <td><?= $fetch_products['Productline_ID']; ?></td>
         <td><?= $fetch_products['name']; ?></td>
         <td><?= $fetch_products['product_stock']; ?></td>
         <td>
            <div class="flex-btn">
               <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">update</a>
               <a href="product_table.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
            </div>
         </td>
      </tr>
      <?php
   }
} else {
   echo '<tr><td colspan="5" class="empty">No products found!</td></tr>';
}
?>

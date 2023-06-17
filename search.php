<?php

include 'components/connect.php';

if(isset($_POST['search_query'])) {
   $searchQuery = $_POST['search_query'];

   // Prepare the SQL statement with a LIKE condition to match the search query
   $searchProd = $conn->prepare("SELECT * FROM `products` WHERE id LIKE :searchQuery OR name LIKE :searchQuery");
   $searchProd->execute(['searchQuery' => "%$searchQuery%"]);

   if($searchProd->rowCount() > 0) {
      while($fetchProds = $searchProd->fetch(PDO::FETCH_ASSOC)) {
         // Display the search results
?>
    <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetchProds['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetchProds['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetchProds['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetchProds['image_01']; ?>">
      <div class="boxes">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetchProds['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetchProds['image_01']; ?>" alt=""></div>
      <div class="overflow">
      <div class="name"><?= $fetchProds['name']; ?></div>
      <div class="flex">
         <div class="price"><span>₱</span><?= $fetchProds['price']; ?><span> </span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      </div>
      <input type="submit" value="add to cart" class="btn <?= ($fetchProds['product_stock'] > 0)?'':'disabled'; ?>"  name="add_to_cart">
   </form>
            <?php
      }
}
   else{
      echo '<p class="empty">no products found!</p>';
   }}
?>

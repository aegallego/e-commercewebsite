<?php
include '../components/connect.php';

if (isset($_POST['search_query'])) {
    $searchQuery = $_POST['search_query'];

    // Prepare the SQL statement with a LIKE condition to match the search query
    $searchM = $conn->prepare("SELECT * FROM `messages` WHERE id LIKE :searchQuery OR name LIKE :searchQuery");
    $searchM->execute(['searchQuery' => "%$searchQuery%"]);

    if ($searchM->rowCount() > 0) {
        while ($fetchM = $searchM->fetch(PDO::FETCH_ASSOC)) {
            // Display the search results
            ?>
            <div class="overflow">
               <div class="box">
                  <p> user id : <span><?= $fetchM['user_id']; ?></span></p>
                  <p> name : <span><?= $fetchM['name']; ?></span></p>
                  <p> email : <span><?= $fetchM['email']; ?></span></p>
                  <p> number : <span><?= $fetchM['number']; ?></span></p>
                  <p> message : <span><?= $fetchM['message']; ?></span></p>
                  <p> date/time: <span><?= $fetchM['dates']; ?></span></p>
                  <form action="" method="post">
                     <input type="hidden" name="update_id" value="<?= $fetchM['id']; ?>">
                     <p> Message Status:
                        <input type="text" id="status" placeholder="Send a response.." name="message_status" value="<?= $fetchM['message_status']; ?>" class="box" required maxlength="50" style="width: 100%; height: 40%; padding: 12px; font-size: 1.8rem;" />
                     </p>
                     <div class="flex-btn">
                        <input type="submit" value="update" class="option-btn" name="update_status">
                        <a href="messages.php?delete=<?= $fetchM['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete</a>
                     </div>
                  </form>
               </div>
            </div>
            <?php
        }
    } else {
        echo '<p class="empty">no messages found!</p>';
    }
}
?>

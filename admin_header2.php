<?php

@include 'config2.php';

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>

<header class="header">

   <div class="flex">

      <a href="admin_page2.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="admin_page2.php">home</a>
         <a href="admin_products2.php">products</a>
         <a href="admin_orders2.php">orders</a>
         <a href="admin_users2.php">users</a>
         <a href="admin_contacts2.php">messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
			if(isset($_SESSION['admin_id'])){
				$admin_id = $_SESSION['admin_id'];
				$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
				$select_profile->execute([$admin_id]);
				$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
				if(is_array($fetch_profile)){
         ?>
         <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
         <p><?= $fetch_profile['name']; ?></p>
         <a href="admin_update_profile2.php" class="btn">update profile</a>
         <a href="logout2.php" class="delete-btn">logout</a>
		 <?php
                    } else {
                        // Handle the case where no user profile is found for the given ID
                        echo '<p>No profile found</p>';
                        echo '<div class="flex-btn">';
                            echo '<a href="login2.php" class="option-btn">login</a>';
                            echo '<a href="register2.php" class="option-btn">register</a>';
                        echo '</div>';
                    }
                } else {
                    // Handle the case where $admin_id is not set (user not logged in as admin)
                    echo '<p>Please login</p>';
                    echo '<div class="flex-btn">';
                        echo '<a href="login2.php" class="option-btn">login</a>';
                        echo '<a href="register2.php" class="option-btn">register</a>';
                    echo '</div>';
                }
            ?>
            <?php
            // This part should only be displayed if the user is NOT logged in as admin
            if(!isset($_SESSION['admin_id'])){
            ?>
         <div class="flex-btn">
            <a href="login2.php" class="option-btn">login</a>
            <a href="register2.php" class="option-btn">register</a>
         </div>
		 <?php
			}
			?>
			
      </div>

   </div>

</header>
<?php

// Start session if not already started
if(session_id() == '' || !isset($_SESSION)){session_start();}

include 'config.php';

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products || VelocityFit Sports Shop</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>

    <!-- Top Bar Navigation -->
    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="index.php">VelocityFit Sports Shop</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>

      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
          <li><a href="about.php">About</a></li>
          <li class='active'><a href="products.php">Products</a></li>
          <li><a href="cart.php">View Cart</a></li>
          <li><a href="orders.php">My Orders</a></li>
          <li><a href="contact.php">Contact</a></li>
          <?php
            if(isset($_SESSION['username'])){
              echo '<li><a href="account.php">My Account</a></li>';
              echo '<li><a href="logout.php">Log Out</a></li>';
            }
            else{
              echo '<li><a href="login.php">Log In</a></li>';
              echo '<li><a href="register.php">Register</a></li>';
            }
          ?>
        </ul>
      </section>
    </nav>

    <!-- Filter and Sort Controls -->
    <div class="row" style="margin-top:10px;">
      <div class="small-12">
        <form method="GET" action="products.php">
          <label>Sort by:
            <select name="sort">
              <option value="name_asc">Name (A-Z)</option>
              <option value="name_desc">Name (Z-A)</option>
              <option value="price_asc">Price (Low to High)</option>
              <option value="price_desc">Price (High to Low)</option>
            </select>
          </label>
          
          <label>Category:
            <select name="category">
              <option value="">All</option>
              <option value="sportswear">Sportswear</option>
              <option value="accessories">Accessories</option>
              <option value="equipment">Equipment</option>
            </select>
          </label>

          <label>
            <input type="checkbox" name="in_stock" value="1"> Only show in-stock items
          </label>
          
          <input type="submit" value="Apply Filters" />
        </form>
      </div>
    </div>

    <!-- Product Listing -->
    <div class="row" style="margin-top:10px;">
      <div class="small-12">
        <?php
          // Sorting logic
          $sort = isset($_GET['sort']) ? $_GET['sort'] : 'name_asc';
          switch($sort) {
              case 'price_asc':
                  $order = 'price ASC';
                  break;
              case 'price_desc':
                  $order = 'price DESC';
                  break;
              case 'name_desc':
                  $order = 'product_name DESC';
                  break;
              default:
                  $order = 'product_name ASC';
                  break;
          }

          // Filtering logic
          $filter_category = isset($_GET['category']) ? $_GET['category'] : '';
          $filter_stock = isset($_GET['in_stock']) ? "AND qty > 0" : '';

          // SQL query for products
          $query = "SELECT * FROM products WHERE 1 $filter_stock";
          if ($filter_category != '') {
              $query .= " AND category = '$filter_category'";
          }
          $query .= " ORDER BY $order";

          // Execute query
          $result = $mysqli->query($query);
          if($result === FALSE){
              die(mysql_error());
          }

          // Display products
          if($result){
              while($obj = $result->fetch_object()) {
                  echo '<div class="large-4 columns">';
                  echo '<p><h3>'.$obj->product_name.'</h3></p>';
                  echo '<img src="images/products/'.$obj->product_img_name.'" alt="'.$obj->product_name.'" />';
                  echo '<p><strong>Product Code:</strong> '.$obj->product_code.'</p>';
                  echo '<p><strong>Description:</strong> '.$obj->product_desc.'</p>';
                  echo '<p><strong>Units Available:</strong> '.$obj->qty.'</p>';
                  echo '<p><strong>Price (Per Unit):</strong> '.$currency.$obj->price.'</p>';
                  
                  // Add to cart button
                  if($obj->qty > 0){
                      echo '<p><button class="add-to-cart" data-id="'.$obj->id.'" style="background: #0078A0; border: none; color: #fff; font-size: 1em; padding: 10px;">Add To Cart</button></p>';
                  } else {
                      echo 'Out Of Stock!';
                  }
                  echo '</div>';
              }
          }

        ?>
      </div>
    </div>

    <!-- Footer -->
    <footer style="margin-top:10px;">
       <p style="text-align:center; font-size:0.8em;clear:both;">&copy; VelocityFit Sports Shop. All Rights Reserved.</p>
    </footer>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
      
      // AJAX for adding products to cart without reload
      $(document).on('click', '.add-to-cart', function(e) {
        e.preventDefault();
        var productId = $(this).data('id');
        $.ajax({
          url: 'update-cart.php',
          type: 'POST',
          data: { id: productId, action: 'add' },
          success: function(response) {
            alert('Product added to cart successfully!');
            // Optionally update cart count or cart details dynamically
          },
          error: function() {
            alert('Failed to add product to cart.');
          }
        });
      });
    </script>

  </body>
</html>

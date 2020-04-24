<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Smart Shopping">
        <title>Smart Shopping</title>
        <link rel="stylesheet" type= text/css href="main.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito|Pontano+Sans|Poppins:500" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js%22%3E%3C/script"></script>
    </head>
    
    <body>
        <header>
            <div>
                <h1 id="main-title">Smart Shopping</h1>
                <form class="pull-right" action="" onsubmit="return brandSearch()" method="post">
                <input type="text" id="search" placeholder="Search for brands..." style="position:relative; right:200px; bottom:67px;" autocomplete="off" value="">
                </form>
            </div>
            <nav class="favorites">
                <ul>
                    <li><a href="favorites.php">Favorites<img src="shopping-cart.png" style="width:30px; height:30px; position:relative; top:9px;"></a></li>
                </ul>
            </nav>
            <nav  class="nav-bar">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="american_eagle.php">American Eagle</a></li>
                    <li><a href="asos.php">ASOS</a></li>
                    <li><a href="gap.php">GAP</a></li>
                    <li><a href="h_m.php">H&M</a></li>
                    <li id="current-page"><a href="forever_21.php">Forever 21</a></li>
                    <li><a href="reviews.php">Reviews</a></li>
                </ul>
            </nav>
        </header>
        <section id="products_header">
            <div class="product_title">
                <h2>FOREVER 21</h2>
                <h3>Select Your Favorite Bottoms</h3>
            </div>
            <nav class="products_nav">
                <ul>
                    <li><a href="forever_21_tops.php">TOPS</a></li>
                    <li id="products_current"><a href="forever_21_bottoms.php">BOTTOMS</a></li>
                    <li><a href="forever_21_outerwear.php">OUTERWEAR</a></li>
                    <li><a href="forever_21_shoes.php">SHOES</a></li>
                </ul>
            </nav>
        </section>
        
        <?php
            session_start();

            // Create connection
            $dbconnect = mysqli_connect("127.0.0.1", "root", "csci318project", "productsdb");

            //Check if connection successful
            /*if($dbconnect){
            echo 'Connected';   
            }
            else {
            echo 'Failed\n';  
            }*/

            //Set Database Query
            $query = "SELECT * FROM productslist LIMIT 15 OFFSET 15";
            $result = mysqli_query($dbconnect, $query);

            $_SESSION['products'] = array();

            //Adding entire productslist table to array
            if(!($result)) 
            {
                die('Error : Query Not Executed. Please Fix the Issue! ' . mysqli_error($dbconnect)); 
            }
        ?>
    
        <div class = "all-products">
            <ul class = "products-container">
                <?php 
                    while($row = mysqli_fetch_assoc($result)) { 
                        $_SESSION['products'][] = $row; ?>
                <li>
                    <form class = "product-card">
                        <div class = "product-card_image"><?php echo '<a href = "' . $row['url'] . '"><img id = "brandName" alt = "American Eagle" src = "'. $row['image'] . '"></a>'; ?> 
                        </div>
                        <a href = "<?php echo $row['url'] ?>">
                            <div class = "product-card_details">
                                <div class = "product-card_name"><?php echo $row['name'];?></div>
                                <div class = "product-card_summary"><?php echo $row['summary']?></div>
                                <div class = "product-card_price"><?php echo "$"; echo $row['price']?></div>
                            </div>
                        </a>
                        <input type = "button" class = "btn" id = "<?php echo $row['id'];?>">
                    </form>
                </li>
                <?php } ?>
            </ul>     
        </div>
        
   		<script>
            $(document).ready(function() {
                jQuery(".btn").click(function() {
                    var productID = jQuery(this).attr("id");
                    $.ajax({
                        type: "POST",
                        url: 'manage_cart.php',
                        data: {productID: productID},
                        success: function(data)
                        {
                            alert("Item Favorited");
                        }
                    });
                    
                    $(this).toggleClass('btn-active');
                });
            });
            
            $(document).ready(function() { 
                $("form").submit(function() { 
                    var fn = $("#search").val(); 
                	window.location = "query.jsp?input=" + fn;
                	return false;
                }); 
            }); 
        </script>
    </body>
</html>
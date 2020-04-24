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
                <form class="pull-right">
                <input type="text" id="search" placeholder="Search" style="position:relative; right:200px; bottom:67px;" autocomplete="off" value="">
                </form>
            </div>
            <nav class="favorites">
                <ul>
                    <li id = "current-page"><a href="favorites.php">Favorites<img src="shopping-cart.png" style="width:30px; height:30px; position:relative; top:9px;"></a></li>
                </ul>
            </nav>
            <nav  class="nav-bar">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="american_eagle.php">American Eagle</a></li>
                    <li><a href="asos.php">ASOS</a></li>
                    <li><a href="gap.php">GAP</a></li>
                    <li><a href="h_m.php">H&M</a></li>
                    <li><a href="forever_21.php">Forever 21</a></li>
                    <li><a href="reviews.php">Reviews</a></li>
                </ul>
            </nav>
        </header>
        
        <?php 
            session_start();

            function multi_in_array($value, $array) 
            { 
                foreach ($array as $item) 
                { 
                    if (!is_array($item)) 
                    { 
                        if ($item == $value) 
                        { 
                            return true; 
                        } 
                        continue; 
                    } 

                    if (in_array($value, $item)) 
                    { 
                        return true; 
                    } 
                    else if (multi_in_array($value, $item)) 
                    { 
                        return true; 
                    } 
                } 
                return false; 
            }

            $americanTotal = 0;
            $asosTotal = 0;
            $foreverTotal = 0;
            $gapTotal = 0;
            $hmTotal = 0;

            if(isset($_SESSION['cart'])){
                $americanInArray = multi_in_array("American Eagle", $_SESSION['cart']);
                $asosInArray = multi_in_array("Asos", $_SESSION['cart']);
                $foreverInArray = multi_in_array("Forever 21", $_SESSION['cart']);
                $gapInArray = multi_in_array("Gap", $_SESSION['cart']);
                $hmInArray = multi_in_array("HM", $_SESSION['cart']);
        ?>
        
        <!--American Eagle Products-->
        <?php if($americanInArray == true){?>
        <section>
            <h1 id = "favorite_brand">American Eagle</h1>
        </section>
        <div class = "all-fav-products">
            <ul class = "products-container">
                <?php foreach($_SESSION['cart'] as $value) { ?>
                <?php if($value['brand'] == "American Eagle") { ?>
                <li>
                    <form class = "product-card">
                        <div class = "product-card_image"><?php echo '<a href = "' . $value['url'] . '"><img id = "brandName" alt = "American Eagle" src = "'. $value['image'] . '"></a>'; ?> 
                        </div>
                        <a href = "<?php echo $value['url'] ?>">
                            <div class = "product-card_details">
                                <div class = "product-card_name"><?php echo $value['name'];?></div>
                                <div class = "product-card_summary"><?php echo $value['summary'];?></div>
                                <div class = "product-card_price"><?php echo "$"; echo $value['price'];?></div>
                                <?php $americanTotal += $value['price'];?>
                            </div>
                        </a>
                        <input type = "button" class = "btn-active" id = "<?php echo $value['id'];?>">

                    </form>
                </li>
                <?php } } }?>
            </ul>     
        </div>
        <?php if($americanTotal > 0){ ?>
        <div>
            <h1 id = "total">Your Estimated Total:<?php echo "\n" ."$" . number_format($americanTotal, 2, '.', '');?></h1>
        </div>
        <?php } ?>
        
        <!--ASOS Products-->
        <?php if($asosInArray == true){?>
        <section>
            <h1 id = "favorite_brand">ASOS</h1>
        </section>
        <div class = "all-fav-products">
            <ul class = "products-container">
                <?php foreach($_SESSION['cart'] as $value) { ?>
                <?php if($value['brand'] == "Asos") { ?>
                <li>
                    <form class = "product-card">
                        <div class = "product-card_image"><?php echo '<a href = "' . $value['url'] . '"><img id = "brandName" alt = "Asos" src = "'. $value['image'] . '"></a>'; ?> 
                        </div>
                        <a href = "<?php echo $value['url'] ?>">
                            <div class = "product-card_details">
                                <div class = "product-card_name"><?php echo $value['name'];?></div>
                                <div class = "product-card_summary"><?php echo $value['summary'];?></div>
                                <div class = "product-card_price"><?php echo "$"; echo $value['price'];?></div>
                                <?php $asosTotal += $value['price'];?>
                            </div>
                        </a>
                        <input type = "button" class = "btn-active" id = "<?php echo $value['id'];?>">

                    </form>
                </li>
                <?php } } }?>
            </ul>     
        </div>
        <?php if($asosTotal > 0){ ?>
        <div>
            <h1 id = "total">Your Estimated Total:<?php echo "\n" ."$" . number_format($asosTotal, 2, '.', '');?></h1>
        </div>
        <?php } ?>
        
        <!--Forever 21 Products-->
        <?php if($foreverInArray == true){?>
        <section>
            <h1 id = "favorite_brand">Forever 21</h1>
        </section>
        <div class = "all-fav-products">
            <ul class = "products-container">
                <?php foreach($_SESSION['cart'] as $value) { ?>
                <?php if($value['brand'] == "Forever 21") { ?>
                <li>
                    <form class = "product-card">
                        <div class = "product-card_image"><?php echo '<a href = "' . $value['url'] . '"><img id = "brandName" alt = "Forever 21" src = "'. $value['image'] . '"></a>'; ?> 
                        </div>
                        <a href = "<?php echo $value['url'] ?>">
                            <div class = "product-card_details">
                                <div class = "product-card_name"><?php echo $value['name'];?></div>
                                <div class = "product-card_summary"><?php echo $value['summary'];?></div>
                                <div class = "product-card_price"><?php echo "$"; echo $value['price'];?></div>
                                <?php $foreverTotal += $value['price'];?>
                            </div>
                        </a>
                        <input type = "button" class = "btn-active" id = "<?php echo $value['id'];?>">

                    </form>
                </li>
                <?php } } }?>
            </ul>     
        </div>
        <?php if($foreverTotal > 0){ ?>
        <div>
            <h1 id = "total">Your Estimated Total:<?php echo "\n" ."$" . number_format($foreverTotal, 2, '.', '');?></h1>
        </div>
        <?php } ?>
        
        <!--Gap Products-->
        <?php if($gapInArray == true){?>
        <section>
            <h1 id = "favorite_brand">GAP</h1>
        </section>
        <div class = "all-fav-products">
            <ul class = "products-container">
                <?php foreach($_SESSION['cart'] as $value) { ?>
                <?php if($value['brand'] == "Gap") { ?>
                <li>
                    <form class = "product-card">
                        <div class = "product-card_image"><?php echo '<a href = "' . $value['url'] . '"><img id = "brandName" alt = "Gap" src = "'. $value['image'] . '"></a>'; ?> 
                        </div>
                        <a href = "<?php echo $value['url'] ?>">
                            <div class = "product-card_details">
                                <div class = "product-card_name"><?php echo $value['name'];?></div>
                                <div class = "product-card_summary"><?php echo $value['summary'];?></div>
                                <div class = "product-card_price"><?php echo "$"; echo $value['price'];?></div>
                                <?php $gapTotal += $value['price'];?>
                            </div>
                        </a>
                        <input type = "button" class = "btn-active" id = "<?php echo $value['id'];?>">

                    </form>
                </li>
                <?php } } }?>
            </ul>     
        </div>
        <?php if($gapTotal > 0){ ?>
        <div>
            <h1 id = "total">Your Estimated Total:<?php echo "\n" ."$" . number_format($gapTotal, 2, '.', '');?></h1>
        </div>
        <?php } ?>
        
        <!--H&M Products-->
        <?php if($hmInArray == true){?>
        <section>
            <h1 id = "favorite_brand">H&M</h1>
        </section>
        <div class = "all-fav-products">
            <ul class = "products-container">
                <?php foreach($_SESSION['cart'] as $value) { ?>
                <?php if($value['brand'] == "HM") { ?>
                <li>
                    <form class = "product-card">
                        <div class = "product-card_image"><?php echo '<a href = "' . $value['url'] . '"><img id = "brandName" alt = "HM" src = "'. $value['image'] . '"></a>'; ?> 
                        </div>
                        <a href = "<?php echo $value['url'] ?>">
                            <div class = "product-card_details">
                                <div class = "product-card_name"><?php echo $value['name'];?></div>
                                <div class = "product-card_summary"><?php echo $value['summary'];?></div>
                                <div class = "product-card_price"><?php echo "$"; echo $value['price'];?></div>
                                <?php $hmTotal += $value['price'];?>
                            </div>
                        </a>
                        <input type = "button" class = "btn-active" id = "<?php echo $value['id'];?>">

                    </form>
                </li>
                <?php } } }?>
            </ul>     
        </div>
        <?php if($hmTotal > 0){ ?>
        <div>
            <h1 id = "total">Your Estimated Total:<?php echo "\n" ."$" . number_format($hmTotal, 2, '.', '');?></h1>
        </div>
        <?php } ?>
        
        <!--Clear Entire Favorites Cart Function-->
        <section>
            <a id = "delete_cart" href = "delete_cart.php">Clear Favorites</a>
        </section>
        
        <?php }else {?>
            <section>
                <h1 id = "page_title">YOU DON'T HAVE ANY FAVORITES YET</h1>
            </section>
        <?php }?>
        
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
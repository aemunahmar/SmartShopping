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
                    <li><a href="favorites.php">Favorites<img src="shopping-cart.png" style="width:30px; height:30px; position:relative; top:9px;"></a></li>
                </ul>
            </nav>
            <nav  class="nav-bar">
                <ul>
                    <li id="current-page"><a href="index.php">Home</a></li>
                    <li><a href="american_eagle.php">American Eagle</a></li>
                    <li><a href="asos.php">ASOS</a></li>
                    <li><a href="gap.php">GAP</a></li>
                    <li><a href="h_m.php">H&M</a></li>
                    <li><a href="forever_21.php">Forever 21</a></li>
                    <li><a href="reviews.php">Reviews</a></li>
                </ul>
            </nav>
        </header>
        <section>
            <div>
                <img class="center-top" src="Screen%20Shot%202018-10-21%20at%207.55.29%20PM.png" style="width: 100%; height: 500px;">
            </div>
        </section>

        <section class="center-bottom">
            <div>
                <img id="img1" src="ProjectMockup2.png" style="width: 250px; height: 290px; position: relative; left: 70px; bottom: 50px;">
                <img id="img2" src="ProjectMockup.png" style="width:400px; height:277px; position: relative; right: 10px; bottom:35px;">
                <h2 id="bottom-title">Get Started</h2>
                <p id="about">Browse our exciting collection of America's <br>most popular brands all in one convenient place.</p>
            </div>
            <a href="brands.php" id="button">Brands</a>
        </section>
        <footer>
            <div>
                <h4>&copy; All Rights Reserved</h4>
            </div>
        </footer>
        
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
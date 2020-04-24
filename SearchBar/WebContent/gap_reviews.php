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
                    <li><a href="index.php">Home</a></li>
                    <li><a href="american_eagle.php">American Eagle</a></li>
                    <li><a href="asos.php">ASOS</a></li>
                    <li><a href="gap.php">GAP</a></li>
                    <li><a href="h_m.php">H&M</a></li>
                    <li><a href="forever_21.php">Forever 21</a></li>
                    <li id="current-page"><a href="reviews.php">Reviews</a></li>
                </ul>
            </nav>
        </header> 
    
        <section>
            <h1 id = "page_title">Check out user reviews of featured brands</h1>
        </section>
        
        <nav class = "brands_title">
            <ul>
                <li><a href = "gap_reviews.php">GAP</a></li>
            </ul>
        </nav>
        
        <?php
            // Create connection
            $dbconnect = mysqli_connect("127.0.0.1", "root", "csci318project", "reviewsdb");

            //Check if connection successful
            /*if($dbconnect){
            echo 'Connected';   
            }
            else {
            echo 'Failed\n';  
            }*/

            //Set Database Query
            $query = "SELECT * FROM brandreviews LIMIT 10 OFFSET 30";
            $result = mysqli_query($dbconnect, $query);

            //Set Array
            $array = array();
            $gapReviews = array();

            //Adding entire brandreviews table to array
            if(!($result)) 
            {
                die('Error : Query Not Executed. Please Fix the Issue! ' . mysqli_error($dbconnect)); 
            } else
            { 
                while ($row = mysqli_fetch_array($result)) 
                { 
                    $array[] = $row;
                    for($i = 0; $i < sizeof($array); $i++)
                    {
                        if($array[$i]['brand'] == "Gap")
                        {
                            $gapReviews[$i] = $array[$i];
                        }
                    }
                } 
            }
        ?>
        
        <?php $j = 0; ?>
        <section id = "all-reviews">
            <div class = "reviews-card">
                <div class = "reviews-card_details">
                    <div class = "reviews-card_name"><?php echo $gapReviews[$j]['name'];?></div>
                    <div class = "reviews-card_review"><?php echo $gapReviews[$j]['review']; $j++;?></div>    
                </div>
            </div>
            <div class = "reviews-card">
                <div class = "reviews-card_details">
                    <div class = "reviews-card_name"><?php echo $gapReviews[$j]['name'];?></div>
                    <div class = "reviews-card_review"><?php echo $gapReviews[$j]['review']; $j++;?></div>    
                </div>
            </div>
            <div class = "reviews-card">
                <div class = "reviews-card_details">
                    <div class = "reviews-card_name"><?php echo $gapReviews[$j]['name'];?></div>
                    <div class = "reviews-card_review"><?php echo $gapReviews[$j]['review']; $j++;?></div>    
                </div>
            </div>
            <div class = "reviews-card">
                <div class = "reviews-card_details">
                    <div class = "reviews-card_name"><?php echo $gapReviews[$j]['name'];?></div>
                    <div class = "reviews-card_review"><?php echo $gapReviews[$j]['review']; $j++;?></div>    
                </div>
            </div>
            <div class = "reviews-card">
                <div class = "reviews-card_details">
                    <div class = "reviews-card_name"><?php echo $gapReviews[$j]['name'];?></div>
                    <div class = "reviews-card_review"><?php echo $gapReviews[$j]['review']; $j++;?></div>    
                </div>
            </div>
            <div class = "reviews-card">
                <div class = "reviews-card_details">
                    <div class = "reviews-card_name"><?php echo $gapReviews[$j]['name'];?></div>
                    <div class = "reviews-card_review"><?php echo $gapReviews[$j]['review']; $j++;?></div>    
                </div>
            </div>
            <div class = "reviews-card">
                <div class = "reviews-card_details">
                    <div class = "reviews-card_name"><?php echo $gapReviews[$j]['name'];?></div>
                    <div class = "reviews-card_review"><?php echo $gapReviews[$j]['review']; $j++;?></div>    
                </div>
            </div>
            <div class = "reviews-card">
                <div class = "reviews-card_details">
                    <div class = "reviews-card_name"><?php echo $gapReviews[$j]['name'];?></div>
                    <div class = "reviews-card_review"><?php echo $gapReviews[$j]['review']; $j++;?></div>    
                </div>
            </div>
            <div class = "reviews-card">
                <div class = "reviews-card_details">
                    <div class = "reviews-card_name"><?php echo $gapReviews[$j]['name'];?></div>
                    <div class = "reviews-card_review"><?php echo $gapReviews[$j]['review']; $j++;?></div>    
                </div>
            </div>
            <div class = "reviews-card">
                <div class = "reviews-card_details">
                    <div class = "reviews-card_name"><?php echo $gapReviews[$j]['name'];?></div>
                    <div class = "reviews-card_review"><?php echo $gapReviews[$j]['review']; $j++;?></div>    
                </div>
            </div>
        </section>
        
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
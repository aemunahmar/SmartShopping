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

    //Attempt 5
    if(!isset($_SESSION['cart']))
    {
        $_SESSION['cart'] = array();
    }

    if(!isset($_SESSION['count']))
    {
        $_SESSION['count'] = 0;
    }

    $count = $_SESSION['count'];
    if (isset($_POST["productID"])) 
    { 
        $productID = $_POST["productID"];
        
        if(isset($_SESSION['cart']))
        {
            $inArray = multi_in_array($productID, $_SESSION['cart']);
        }

        foreach($_SESSION['products'] as $value) 
        {
            if($value['id'] == $productID)
            {  
                $brand = $value['brand'];
                $image = $value['image'];
                $name = $value['name'];
                $summary = $value['summary'];
                $price = $value['price'];
                $url = $value['url'];
                
                if($inArray == false)
                {
                    $_SESSION['cart'][$count]['id'] = $productID;
                    $_SESSION['cart'][$count]['brand'] = $brand; 
                    $_SESSION['cart'][$count]['image'] = $image; 
                    $_SESSION['cart'][$count]['name'] = $name; 
                    $_SESSION['cart'][$count]['summary'] = $summary; 
                    $_SESSION['cart'][$count]['price'] = $price; 
                    $_SESSION['cart'][$count]['url'] = $url; 
                }
                
                $_SESSION['count'] += 1;
            }
        }
    } else 
    {
        echo 'no variable received';
    }
?>
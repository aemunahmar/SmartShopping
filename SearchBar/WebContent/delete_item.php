<?php

    session_start();

    if(isset($_POST["productID"]))
    {
        $productID = $_POST["productID"];
        
        if(isset($_SESSION['cart']))
        {
             foreach ($_SESSION['cart'] as $select => $val) 
             {
                if($val['id'] == $productID)
                {
                    unset($_SESSION['cart'][$select]);
                }
            }
        }
    }
?>
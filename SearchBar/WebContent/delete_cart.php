<?php
    session_start();

    if(isset($_SESSION['cart']))
    {
        session_unset();
        header('Location: favorites.php');
    } else
    {
        session_destroy();
        header('Location: favorites.php');
    }
?>
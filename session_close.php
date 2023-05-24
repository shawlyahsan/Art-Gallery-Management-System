<?php
    session_start();  
    if(isset($_SESSION['source_url']))
    {
        $url = $_SESSION['source_url'];
    }  
    else
    {
        $url = 'index.php';
    }
    session_destroy();
    header('Location: '.$url);
?>
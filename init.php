<?php

if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar'){
    include('text/ar.php');
}else{
    include('text/en.php');
}
?>
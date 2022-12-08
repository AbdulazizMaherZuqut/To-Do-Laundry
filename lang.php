<?php
    $lang = (isset($_GET['lang'])) ? $_GET['lang'] : '';
    $redirect = (isset($_GET['redirect'])) ? $_GET['redirect'] : '';

    session_start();

    if($lang != '') {
        $ls = $_SESSION['lang'] = $lang;
        if($ls){
            if($redirect != '') {
                header("Location: {$redirect}");
            }else{
                header("Location: index.php");
            }
        }else{
            if($redirect != '') {
                header("Location: {$redirect}");
            }else{
                header("Location: index.php");
            }
        }
    }else{
        header("Location: index.php");
    }

?>

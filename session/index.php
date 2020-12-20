<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: ../sign/');
        exit;
    }
    if (isset($_SESSION['user']) && isset($_SESSION['profile-type'])) {
        if ($_SESSION['profile-type'] == "complete") {        
            header("Location: user");
        } else if ($_SESSION['profile-type'] == "incomplete") {
            header("Location: pbzcyrgrCebsvyr.php?pb_unid=xnbcJHAxcbkHJSAGDbcsgdjWHSAG");
        }
        exit;
    } else if (isset($_SESSION['admin'])) {
        header("Location: ../");
        exit;
    } else {
        header('Location: ../404.html');
    }
<?php
    require_once("../encopecitify.ini.php");
    require_once("../../modules/html.php");
    include "../../inc/__logout.php";
    require_once('../../modules/extractify.php');
    session_start();
    if (!isset($_SESSION['user']) || $_SESSION['profile-type'] == 'incomplete') {
        header("Location: ../../sign/");
        exit;
    }
    if (!isset($_SESSION['timeout'])) {
        $_SESSION['timeout'] = time() + 40;
    }
    $inactive = 30;
    $session_life = time() - $_SESSION['timeout'];
    if (!isset($_GET['pskYwivSyx'])) {
        $m = new Token();
        $original_token_val = $m->val();
        $key = rand(0, 25);
        $_SESSION['log'] = $m->Encipher($original_token_val, $key);
    } else {
        if ($_GET['pskYwivSyx'] == $_SESSION['log'] || $session_life > $inactive) {    
            $logoutOBJ = new Logout();
            $unx = $logoutOBJ->__logout_user();
            if ($unx) {
                session_destroy($_SESSION['log']);
                if ($session_life > $inactive)
                    session_destroy($_SESSION['timeout']);
                setcookie('sessionTimeout', 'true', time() + 30, '/');
                header('Location: ../../sign/');
                exit;
            }
            $_SESSION['timeout']=time();
        }
        else
            echo '<script>console.log("The logout key has been mutated. Please reload the page.")</script>';
    }
    $extractify = new Extractify($_SESSION['user']);
    $dets = $extractify->extractify_dets();
    foreach ($dets as $singldets) {
        $full_name = $singldets['user_fullname'];
        $last_name = explode(' ', $full_name);
        $last_name = end($last_name);
        $cell = '+92'.substr($singldets['user_cell'], 1);
    }
    $lnk = $extractify->extractify_lnk();
    foreach ($lnk as $singlnk) {
        $int = $singlnk['user_interests'];
        $kbf = $singlnk['sc_link_fbk'];
        $sni = $singlnk['sc_link_ins'];
    }
    $html = new HTML();
?>
<!DOCType html>
<html>
    <head>
        <?php include "../lst/__header.php"?>
    </head>
    <body class="theme-spectral-1">
        <title>Phonebook</title>
        <div id="load"></div>
        <nav>
            <div class="nav-content">
                <ul>
                    <li><a>Find Users</a><li>
                    <li><a>Categories</a><li>
                </ul>
                <div id="avatar" class="avatar-container">
                    <div class="avatar"></div>
                    <p><?=$user?></p>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </nav>
        <div id="super-left" class="navigation">
            <ul>
                <a class="active"><i class="ti-layout-media-right"></i></a>
                <a><i class="ti ti-heart"></i></a>
                <a href="index.php?pskYwivSyx=<?=$_SESSION['log'];?>"><i class="ti ti-shift-left"></i></a>
            </ul>
        </div>
        <div id="content-cont-left" data-scroll-container>
            <div class="content-wrapper" data-scroll data-scroll-speed="1">
                <h1 class="header-1">Hello <?=$last_name?>,</h1>
                <div class="flex">
                    <span class="header-button gl"><i class="ti ti-search"></i></span>
                    <input class="header-input no-borders" type="text" placeholder="Search for people" />
                    <span class="header-button ml"><i class="ti ti-more-alt"></i></span>
                </div>
                <h4>People</h4>
                <!---CARD-->
                <?=$html->cards()?>
                <!---CARD-->
            </div>
            <span class="blob-bottom-left w-500">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#00204a" d="M27.8,-35.2C37.3,-31.4,47.2,-25,51.2,-15.9C55.2,-6.7,53.4,5,47.5,13C41.6,21,31.5,25.3,22.9,36.2C14.3,47.1,7.1,64.6,-3.9,69.9C-14.9,75.3,-29.7,68.3,-43,58.9C-56.2,49.5,-67.9,37.7,-70,24.4C-72.2,11,-64.7,-3.8,-58.9,-18.3C-53.1,-32.8,-48.8,-47.1,-39.2,-50.9C-29.7,-54.7,-14.8,-48,-2.8,-44.1C9.2,-40.2,18.3,-39,27.8,-35.2Z" transform="translate(100 100)" />
                </svg>
            </span>
        </div>
        <div id="content-cont-right" class="of-hidden c-scroll">
            <div class="blob-z-content flex-column flex-center padding-40" >
                <span class="avatar-200-text-circle">
                    H
                </span>
                <p><strong>Profile</strong> <?=$full_name?></p>
                <span class="w-p-100 margin-bottom-5 flex-column margin-top-30">
                    <strong class="fs-14">Description</strong>
                    <textarea class="c-scroll"></textarea>
                </span>
                <span class="w-p-100 margin-bottom-5 flex margin-top-30">
                    <div class="w-40 flex flex-center">
                        <i class="ti ti-facebook"></i>
                    </div>
                    <input class="icons" type="text" value="https://www.facebook.com/<?=$kbf?>">
                </span>
                <span class="w-p-100 margin-bottom-5 flex">
                    <div class="w-40 flex flex-center">
                        <i class="ti ti-instagram"></i>
                    </div>
                    <input class="icons" type="text" value="https://www.instagram.com/<?=$sni?>">
                </span>
                <span class="w-p-100 margin-bottom-5 flex">
                    <div class="w-40 flex flex-center">
                        <i class="ti ti-mobile"></i>
                    </div>
                    <input class="icons" type="text" value="<?=$cell?>">
                </span>
                <a href="" class="button pull-right margin-top-30">Update Profile</a>
            </div>

        </div>
        <script src="../assets/js/jquery-2.2.4.min.js"></script>
        <script src="https://kit.fontawesome.com/5167d4297f.js" crossorigin="anonymous"></script>
        <script src="../assets/js/locomotive-scroll.min.js"></script>
        <script src="../assets/js/script.js"></script>
    </body>
</html>
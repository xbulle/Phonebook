<?php
    include "../base_encode.php";
    include "../../inc/__logout.php";
    session_start();
    $m = new Token();
    $original_token_val = $m->val();
    $key = rand(0, 25);
    $encrypted_val = $m->Encipher($original_token_val, $key);
    if (isset($_GET['pskYwivSyx'])) {
        $logoutOBJ = new Logout();
        $unx = $logoutOBJ->__logout_user();
        if ($unx) {
            header('Location: ../../sign/');
            exit;
        }
    }
    $user = explode('\@', strval($_SESSION['user']));
    $user = $user[0];
?>
<!DOCType html>
<html>
    <head>
        <?php include "../lst/__header.php"?>
    </head>
    <body>
        <title>Phonebook | Dashboard</title>
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
        <div id="avatar-drop" class="avatar-drop">
            <ul>
                <a><i class="fas fa-id-card-alt"></i>My Profile</a>
                <a><i class="fas fa-sliders-h"></i>Settings</a>
                <a href="index.php?pskYwivSyx=<?php if (!isset($_GET['pskYwivSyx'])) echo $encrypted_val;?>"><i class="fas fa-sign-out-alt"></i>Sign out</a>
            </ul>
        </div>
        <div id="content-cont-left">
            <h1 class="header-1">Hello, <?=$user?>!</h1>
        </div>
        <script src="../assets/js/jquery-2.2.4.min.js"></script>
        <script src="https://kit.fontawesome.com/5167d4297f.js" crossorigin="anonymous"></script>
        <script src="../assets/js/script.js"></script>
    </body>
</html>
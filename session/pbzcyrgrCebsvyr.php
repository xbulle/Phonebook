<?php
    session_start();
    $elv = $_GET['pb_unid'];
    if (isset($_GET['pb_unid'])) {
        $stp_a = ''; $stp_b = '';
        switch($elv) {
            case 'xnbcJHAxcbkHJSAGDbcsgdjWHSAG':
                $cs = '';
                $stp_a = 'is-active';
                $interests = 0;
                $t_interest = 0;
                if (isset($_POST['in_hire'])) $hires  = $_POST['in_hire']; if (isset($_POST['in_social'])) $social = $_POST['in_social'];
                if (!empty($hires)) { $interests = 1; $t_interest++; } if (!empty($social)) { $interests = 2; $t_interest++; }
                if ($interests > 0) {
                    if ($t_interest > 1) $interests = 3;
                    setcookie('interests', $interests, time() + 3600 * 60);
                    header("Location: pbzcyrgrCebsvyr.php?pb_unid=nbqiyKmsaASplKJSuusnMmNSqdlQ");
                    exit;
                }
                if (isset($_COOKIE['interests'])) {
                    header("Location: pbzcyrgrCebsvyr.php?pb_unid=nbqiyKmsaASplKJSuusnMmNSqdlQ");
                    exit;
                }
            break;
            case 'nbqiyKmsaASplKJSuusnMmNSqdlQ':
                $sc_linkc = '';
                $sc_linkv = '';
                $cs = '';
                $stp_a = 'is-complete';
                $stp_b = 'is-active';
                if (isset($_POST['f_link']) || isset($_POST['i_link'])) {
                    if (isset($_POST['f_link'])) {
                        $sc_linkc = htmlspecialchars(trim($_POST['f_link']));
                        $sc_linkc = substr(strrchr(parse_url(filter_var($sc_linkc, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED), PHP_URL_PATH), '/'), 1);
                    }
                    if (isset($_POST['i_link'])) {
                        $sc_linkv = htmlspecialchars(trim($_POST['i_link']));
                        $sc_linkv = substr(strrchr(parse_url(filter_var($sc_linkv, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED), PHP_URL_PATH), '/'), 1);
                    }
                    $cookiec = (!empty($sc_linkc)) ? setcookie('lnkd_facebook', $sc_linkc, time() + 3600 * 60) : false;
                    $cookiev = (!empty($sc_linkv)) ? setcookie('lnkd_instagram', $sc_linkv, time() + 3600 * 60) : false;
                }
                if (isset($_COOKIE['lnkd_facebook']) || isset($_COOKIE['lnkd_instagram'])) {
                    header("Location: pbzcyrgrCebsvyr.php?pb_unid=ilqMabFupLtiaRwzxVltmflepfrI");
                    exit;
                } else {
                    echo 'Please fill either of the fields';
                }
            break;
            case 'ilqMabFupLtiaRwzxVltmflepfrI':
                require_once('../modules/insertion.php');
                $cs = 'begin';
                $success = false;
                $interests = (isset($_COOKIE['interests'])) ? $_COOKIE['interests'] : NULL;
                $facebook  = (isset($_COOKIE['lnkd_facebook'])) ? $_COOKIE['lnkd_facebook'] : '';
                $instagram = (isset($_COOKIE['lnkd_instagram'])) ? $_COOKIE['lnkd_instagram'] : '';
                setcookie('interests', '', time() + 0);
                setcookie('lnkd_facebook', '', time() + 0);
                setcookie('lnkd_instagram', '', time() + 0);
                if (!is_null($interests) && (!empty($facebook) || !empty($instagram))) {
                    $in = new Insertion($_SESSION['user'], $interests, $facebook, $instagram);
                    $success = $in->insert();
                }
                if (!$success) {
                    echo "Unable to create profile at the moment. Please retry later.";
                    header('Location: ../');
                    exit;
                } else {
                    $_SESSION['timeout'] = time() + 40;
                }
            break;
            default:
                header("Location: pqvHqwpf");
                exit;
            break;
        }
    } else {
        header("Location: pbzcyrgrCebsvyr.php?pb_unid=xnbcJHAxcbkHJSAGDbcsgdjWHSAG");
        exit;
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Phonebook | Complete User Profile</title>
        <link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="../css/zypher.css" />
    </head>
    <body class="<?=$cs?>">
        <div class="<?php if ($elv != 'ilqMabFupLtiaRwzxVltmflepfrI') echo 'padding-top-100'; ?>">
            <?php if ($elv != 'ilqMabFupLtiaRwzxVltmflepfrI') { ?>
            <ol class="steps">
                <li class="step is-complete" data-step="1">
                    Register
                </li>
                <li class="step <?=$stp_a?>" data-step="2">
                    Interests
                </li>
                <li class="step <?=$stp_b?>" data-step="3">
                    Links
                </li>
                <li class="step <?=$stp_c?>" data-step="4">
                    Begin
                </li>
            </ol>
            <?php } ?>
            <?php if ($elv == 'xnbcJHAxcbkHJSAGDbcsgdjWHSAG') { ?>
                <i class="ti ti-check-box"></i>
            <h1>Choose your interest on Phonebook</h1>
            <form class="grid-wrapper" method="POST">
                <div class="card-wrapper">
                    <input class="c-card" name="in_hire" type="checkbox" id="1" value="1">
                    <div class="card-content">
                        <div class="card-state-icon"><i class="ti ti-check"></i></div>
                        <label for="1">
                            <div class="card-image">
                                <img src="assets/img/38a1cf9c9c5ba65c25d3f00hm01qa76.jpg" />
                            </div>
                            <h4>Freelanceing!</h4>
                            <h5>I'm looking forward to hiring or getting jobs.</h5>
                        </label>
                    </div>
                </div>
                <div class="card-wrapper">
                    <input class="c-card" name="in_social" type="checkbox" id="2" value="2">
                    <div class="card-content">
                    <div class="card-state-icon"></div>
                    <label for="2">
                        <div class="card-image">
                            <img src="assets/img/76sg81ms92sa138a1cf9c9c5ba65c78.jpg" />
                        </div>
                        <h4>Let's be Social!</h4>
                        <h5>I'm trying to be social and make friends!</h5>
                    </label>
                    </div>
                </div>
                <button type="submit">Next</button>
            </form>
            <?php } else if ($elv == 'nbqiyKmsaASplKJSuusnMmNSqdlQ') { ?>
            <h1 class="c-head">Add Links to your profile so people can find you!</h1>
            <form class="flex-column flex-center" method="POST">
                <div class="card-wp-100-h-200 facebook">
                    <div class="logo"><i class="ti ti-facebook"></i></div>
                    <label><i class="ti ti-facebook"></i></label>
                    <input name="f_link" value="https://www.facebook.com/<?=$sc_linkc?>" />
                </div>
                <div class="card-wp-100-h-200 instagram">
                    <div class="logo"><i class="ti ti-instagram"></i></div>
                    <label><i class="ti ti-instagram"></i></label>
                    <input name="i_link" value="https://www.instagram.com/<?=$sc_linkv?>" />
                </div>
                <button class="button" type="submit">Next<i class="ti ti-arrow-right"></i></button>
            </form>
        </div>
        <?php } else if ($elv == 'ilqMabFupLtiaRwzxVltmflepfrI') { ?>
        <div class="z-999">
            <h1 class="d-head">Everything's set up! Let's start this <strong>journey</strong> together!</h1> 
            <div class="absolute margin-top-100">
                <a class="button get-started" href="../session/">Get Started<i class="ti ti-arrow-right"></i></a>
            </div>
            <?=$_SESSION['profile-type']?>
        </div>
        <img class="pentagorus-img" src="assets/img/38a1cf9c9c5ba65c25d24cad3e2f30.gif" />
        <?php }?>
    </body>
</html>
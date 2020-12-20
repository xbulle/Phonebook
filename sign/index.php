<?php

require_once('../modules/session.ini.php');
session_start();
$_POST['action'] = "";
$response = array();
$response['success']  = false;
$response['messages'] = array();

if (isset($_SESSION['user'])) {
    header('location: ../session/');
    exit;
}
if (isset($_POST['li_email'])) {
    $in_email = $_POST['li_email'];
    if (isset($_POST['li_password'])) {
        $in_password = $_POST['li_password'];
        $_POST['action'] = 'login';
    }
}
else {
    $in_email = '';
    $in_password = '';
}
if (isset($_POST['su_name'])) {
    if (isset($_POST['su_email'])) {
        if (isset($_POST['su_number'])) {
            if (isset($_POST['su_password'])) {
                $_POST['action'] = 'signup';
            }
        }
    }
} else {
    $fullname = '';
    $username = '';
    $password = '';
    $email = '';
    $number = '';
}

if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
    if (isset($_POST['action']))
        $action = $_POST['action'];

    switch($action) {
        case 'login':
            $error = '';
            $in_email = htmlspecialchars(trim($_POST['li_email']));
            $in_password = htmlspecialchars(trim($_POST['li_password']));
            $clean_email = filter_var($in_email, FILTER_VALIDATE_EMAIL);
            if (!empty($in_password) && $in_email === $clean_email) {
                $session = new Session();
                $session->__construct_login($in_email, $in_password);
                $result = $session->login();
                if($result == true) {
                    header('Location: ../session/');
                } else {
                    echo "Wrong Email or password.";
                }
            }
            break;
        case 'signup':
            $fullname = htmlspecialchars(trim($_POST['su_fullname']));
            $username = htmlspecialchars(trim($_POST['su_name']));
            $password = htmlspecialchars(trim($_POST['su_password']));
            $email = htmlspecialchars(trim($_POST['su_email']));
            $number = (int)htmlspecialchars(trim($_POST['su_number']));
            if (!is_numeric($number)) $number_value = NULL; else $number_value = $number;
            $clean_email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if ($email == $clean_email && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password) && !empty($username) && !is_null($number_value)) {
                $session = new Session();
                $session->__construct_signup($fullname, $username, $email, $password, $number);
                $result = $session->signup();
                if($result) {
                    header('Location: ../session/');
                } else {
                    echo "Something went wrong. Please retry later.";
                }
            } else {
                echo 'Wrong Information Provided.';
            }
            break;
        default:
            break;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="signin.css">
        <title>Phonebook | Sign In</title>
    </head>
    <body>
        <a href="../" class="__back">
            <p><i class="fas fa-chevron-left"></i>Home</p>
        </a>
        <div class="cont">
            <form class="form sign-in" method="POST">
                <div>
                    <?php
                        if (isset($_COOKIE['sessionTimeout'])) {
                            echo '<h4>Your session has been expired. Please login again.</h4>';
                        }
                        else {
                            echo '<h2>Welcome back!</h2>';
                        }
                    ?>
                    <label>
						<span>Email</span>
						<input type="email" name="li_email" value="<?=$in_email?>" />
                    </label>
                    <label>
                        <i class="fas fa-eye" id="view" ></i>
                        <span>Password</span>
						<input type="password" name="li_password" value="<?=$in_password?>" />
                    </label>
                    <a class="forgot-pass">Forgot password?</a>
                    <button type="submit" class="submit">Sign In</button>
                </div>
            </form>
            <div class="sub-cont">
                <div class="img">
                    <div class="img__text m--up">
                        <h2>New here?</h2>
                        <p>Sign up and discover great amount of new opportunities!</p>
                    </div>
                    <div class="img__text m--in">
                        <h2>One of us?</h2>
                        <p>If you already has an account, just sign in. We've missed you!</p>
                    </div>
                    <div class="img__btn">
                        <span class="m--up">Sign Up</span>
                        <span class="m--in">Sign In</span>
                    </div>
                </div>
                <form class="form sign-up" method="POST">
                    <div>
                        <h2>Time to feel like home,</h2>
                        <label>
							<span>Full Name</span>
							<input type="text" name="su_fullname" value="<?=$fullname?>"/>
                        </label>
                        <label>
							<span>Username</span>
							<input type="text" name="su_name" value="<?=$username?>"/>
                        </label>
                        <label>
							<span>Email</span>
							<input type="email" name="su_email" value="<?=$email?>"/>
                        </label>
                        <label>
							<span>Mobile Number</span>
							<input type="text" name="su_number" value="<?=$number?>"/>
                        </label>
                        <label>
                            <i class="fas fa-eye" id="view"></i>
							<span>Password</span>
							<input type="password" name="su_password" value="<?=$password?>"/>
                        </label>
                        <button type="submit" class="submit">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script src="signin.js"></script>
    <script src="https://kit.fontawesome.com/5167d4297f.js" crossorigin="anonymous"></script>
</html>
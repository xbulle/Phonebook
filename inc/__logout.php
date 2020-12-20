<?php
class Logout {
    /**
     * @return
     *     Boolean 
    **/
    public function __logout_user () {
        unset($_SESSION['user']);
        session_destroy($_SESSION['user']);
        return true;
    }
}
<?php
require_once('querify.php');
class Insertion extends Connection {
    use DatasetDetails;
    private $intrst;
    private $sl_fbk;
    private $sl_inm;
    private $in_nme;
    function __construct($inm, $ins, $sl_a, $sl_b) {
        $this->in_nme = $inm;
        $this->intrst = $ins;
        $this->sl_fbk = $sl_a;
        $this->sl_inm = $sl_b;
    }
    function insert () {
        $success = $this->insert_details('connectivity', $this->in_nme, $this->intrst, $this->sl_fbk, 'user_name', 'user_interests', 'sc_link_fbk', $this->sl_inm, 'sc_link_ins');
        if (!$success) {
            return false;
        }
        session_destroy($_SESSION['profile-type']);
        $_SESSION['profile-type'] = "complete";
        return true;
    }
};

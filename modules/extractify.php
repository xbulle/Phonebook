<?php
require_once('querify.php');
class Extractify extends Connection {
    use DatasetDetails;
    private $en_name;
    function __construct ($nGSjhbaA) {
        $this->en_name = $nGSjhbaA;
    }
    function extractify_dets () {
        $dets = $this->extract_details('userdetails', 'user_name', $this->en_name);
        return $dets;
    }
    function extractify_lnk () {
        $lnk = $this->extract_details('connectivity', 'user_name', $this->en_name);
        return $lnk;
    }
};
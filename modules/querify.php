<?php
require('connection.ini.php');
trait DatasetDetails {
    function extract_details($table, $argl = "", $argm = "") {
        $connection = $this->connect("phonebook");
        if (!$connection) {
            echo "Connection to the server failed.";
            exit;
        }
        $query = "SELECT * FROM `$table`";
        if (!empty($argl))
            if (!empty($argm))
                $query .= " WHERE `$argl` = '$argm'";
        $result = $connection->query($query);
        if (!$result) {
            $error = 'Error : ' . $connection->error;
            return $error;
        }
        while ($d_fetch_dets =  $result->fetch_assoc()) {
            $details[] = $d_fetch_dets;
        }
        return $details;
    }
    function insert_details ($table, $value1, $value2, $value3, $column1, $column2, $column3, $value4 = "", $column4 = "") {
        $connection = $this->connect("phonebook");
        if (!$connection) {
            echo "Connection to the server failed.";
            exit;
        }
        if (!empty($column4) && !empty($value4))
            $query = "INSERT INTO `$table` (`$column1`, `$column2`, `$column3`, `$column4`)
                                    VALUES ('$value1', '$value2', '$value3', '$value4')";
        else
            $query = "INSERT INTO `$table` (`$column1`, `$column2`, `$column3`)
                                    VALUES ('$value1', '$value2', '$value3')";
        $result = $connection->query($query);
        if (!$result) {
            return false;
        }
        return true;
    }
}

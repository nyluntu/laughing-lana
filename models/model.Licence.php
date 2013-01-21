<?php

/**
 * Description of model
 *
 * @author Turo Nylund
 */
class LicenceModel extends MysqlDAO {

    function __construct() {
        parent::__construct();

        $this->tablename = "jb_driving_licences";
        $this->rows_per_page = 10;

        $this->fieldspec["id"] = array(
            "type" => "int",
            "size" => 11,
            "pkey" => true);

        $this->fieldspec["licence"] = array(
            "type" => "string",
            "size" => 5,
            "required" => true);
        
        $this->fieldspec["description"] = array(
            "type" => "string",
            "size" => 1024);
        
        $this->fieldspec["created"] = array(
            "type" => "date");
        
        $this->fieldspec["modified"] = array(
            "type" => "date",
            "default" => "now");
    }

}

?>

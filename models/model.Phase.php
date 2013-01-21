<?php

/**
 * Description of model
 *
 * @author Turo Nylund
 */
class Phase extends MysqlDAO {

    function __construct() {
        parent::__construct();

        $this->tablename = "jb_status_group";
        $this->rows_per_page = 10;

        $this->fieldspec["id"] = array(
            "type" => "int",
            "size" => 11,
            "pkey" => true);

        $this->fieldspec["title"] = array(
            "type" => "string",
            "size" => 100,
            "required" => true);

        $this->fieldspec["practice_id"] = array(
            "type" => "int",
            "size" => 11,
            "default" => 0);

        $this->fieldspec["author"] = array(
            "type" => "int",
            "size" => 11,
            "default" => 0);

        $this->fieldspec["order"] = array(
            "type" => "int",
            "size" => 11,
            "required" => true);
    }

}

?>

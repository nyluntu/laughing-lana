<?php

/**
 * Description of model
 *
 * @author Turo Nylund
 */
class MilestoneModel extends MysqlDAO {

    function __construct() {
        parent::__construct();

        $this->tablename = "jb_status_title";
        $this->rows_per_page = 10;

        $this->fieldspec["id"] = array(
            "type" => "int",
            "size" => 11,
            "pkey" => true);

        $this->fieldspec["description"] = array(
            "type" => "string",
            "size" => 1024,
            "required" => true);

        $this->fieldspec["title"] = array(
            "type" => "string",
            "size" => 100,
            "required" => true);

        $this->fieldspec["practice_id"] = array(
            "type" => "int",
            "size" => 11,
            "required" => true,
            "default" => 0);

        $this->fieldspec["author"] = array(
            "type" => "int",
            "size" => 11,
            "required" => true,
            "default" => 0);

        $this->fieldspec["file"] = array(
            "type" => "int",
            "size" => 11,
            "required" => true,
            "default" => 0);

        $this->fieldspec["rights"] = array(
            "type" => "string",
            "size" => 4,
            "required" => true,
            "default" => "0000");

        $this->fieldspec["group_id"] = array(
            "type" => "int",
            "size" => 11,
            "required" => true);

        $this->fieldspec["order"] = array(
            "type" => "int",
            "size" => 11,
            "required" => true);
    }

}
?>

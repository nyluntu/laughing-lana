<?php

/**
 * Description of model
 *
 * @author Turo Nylund
 */
class LanguageLevelModel extends MysqlDAO {

    function __construct() {
        parent::__construct();

        $this->tablename = "jb_language_levels";
        $this->rows_per_page = 10;

        $this->fieldspec["id"] = array(
            "type" => "int",
            "size" => 11,
            "pkey" => true);

        $this->fieldspec["level"] = array(
            "type" => "string",
            "size" => 5,
            "required" => true);

        $this->fieldspec["level_code"] = array(
            "type" => "string",
            "size" => 5,
            "required" => true);

        $this->fieldspec["description"] = array(
            "type" => "string",
            "required" => true);

        $this->fieldspec["created"] = array(
            "type" => "date");

        $this->fieldspec["modified"] = array(
            "type" => "date",
            "default" => "now");
    }

}

?>

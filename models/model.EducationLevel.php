<?php

/**
 * Description of model
 *
 * @author Turo Nylund
 */
class EducationLevelModel extends MysqlDAO {

    function __construct() {
        parent::__construct();

        $this->tablename = "jb_education_classification";
        $this->rows_per_page = 10;

        $this->fieldspec["id"] = array(
            "type" => "int",
            "size" => 11,
            "pkey" => true);

        $this->fieldspec["level"] = array(
            "type" => "string",
            "size" => 10,
            "required" => true);

        $this->fieldspec["level_code"] = array(
            "type" => "string",
            "size" => 5,
            "required" => true);

        $this->fieldspec["description"] = array(
            "type" => "string",
            "size" => 1024,
            "required" => true);

        $this->fieldspec["created"] = array(
            "type" => "date");

        $this->fieldspec["modified"] = array(
            "type" => "date",
            "default" => "now");
    }

}

?>

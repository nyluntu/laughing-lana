<?php

/**
 * Description of model
 *
 * @author Turo Nylund
 */
class Traineeship extends MysqlDAO {

    public $permissions = array(
        "admin" => array("C" => true, "R" => true, "U" => true, "D" => true),
        "student" => array("C" => false, "R" => true, "U" => false, "D" => false),
        "teacher" => array("C" => true, "R" => true, "U" => false, "D" => true),
        "employer" => array("C" => false, "R" => true, "U" => false, "D" => false)
    );

    function __construct() {
        parent::__construct();

        $this->tablename = "jb_practice_event";
        $this->rows_per_page = 10;

        $this->fieldspec["id"] = array(
            "type" => "int",
            "size" => 11,
            "pkey" => true);

        $this->fieldspec["applicant_id"] = array(
            "type" => "int",
            "size" => 11,
            "required" => true);

        $this->fieldspec["company_id"] = array(
            "type" => "int",
            "size" => 11,
            "required" => true);

        $this->fieldspec["school_home_id"] = array(
            "type" => "int",
            "size" => 11,
            "required" => true);

        $this->fieldspec["school_foreign_id"] = array(
            "type" => "int",
            "size" => 11,
            "required" => true);

        $this->fieldspec["description"] = array(
            "type" => "string",
            "required" => true);

        $this->fieldspec["title"] = array(
            "type" => "string",
            "size" => 100,
            "required" => true);

        $this->fieldspec["ongoing"] = array(
            "type" => "enum",
            "values" => array(0, 1),
            "default" => 0);

        $this->fieldspec["start_date"] = array(
            "type" => "date",
            "default" => "null");

        $this->fieldspec["end_date"] = array(
            "type" => "date",
            "default" => "null");
    }

}

?>

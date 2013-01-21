<?php

/**
 * Description of model
 *
 * @author Turo Nylund
 */
class LinkModel extends MysqlDAO {

    function __construct() {
        parent::__construct();

        $this->tablename = "jb_country_links";
        $this->rows_per_page = 10;

        $this->fieldspec["id"] = array(
            "type" => "int",
            "size" => 11,
            "pkey" => true);

        $this->fieldspec["country_id"] = array(
            "type" => "string",
            "size" => 3,
            "required" => true);

        $this->fieldspec["account_id"] = array(
            "type" => "int",
            "size" => 11,
            "required" => true,
            "default" => NULL);

        $this->fieldspec["created"] = array(
            "type" => "date",
            "required" => true,
            "default" => "now");

        $this->fieldspec["modified"] = array(
            "type" => "date",
            "default" => "now");

        $this->fieldspec["url"] = array(
            "type" => "url",
            "size" => 100,
            "required" => true);

        $this->fieldspec["title"] = array(
            "type" => "string",
            "size" => 50,
            "required" => true);

        $this->fieldspec["description"] = array(
            "type" => "string",
            "size" => 255,
            "required" => true);

        $this->fieldspec["keywords"] = array(
            "type" => "string",
            "size" => 100,
            "default" => 'null');

        $this->fieldspec["school_id"] = array(
            "type" => "int",
            "size" => 11,
            "required" => true);

        $this->fieldspec["active"] = array(
            "type" => "int",
            "size" => 11,
            "required" => true,
            "default" => 0);
    }

}

?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author Turo Nylund
 */
class CVModel extends MysqlDAO {

    function __construct() {
        parent::__construct();

        $this->tablename = "jb_cv_xml";
        $this->rows_per_page = 10;

        $this->fieldspec["ID"] = array(
            "type" => "int",
            "size" => 11,
            "pkey" => true);

        $this->fieldspec["FNAME"] = array(
            "type" => "string",
            "size" => 30,
            "required" => true);

        $this->fieldspec["LNAME"] = array(
            "type" => "string",
            "size" => 30,
            "required" => true);

        $this->fieldspec["ADDRESS"] = array(
            "type" => "string",
            "size" => 50);

        $this->fieldspec["MUNIC"] = array(
            "type" => "string",
            "size" => 50);

        $this->fieldspec["POSTAL_CODE"] = array(
            "type" => "string",
            "size" => 10);

        $this->fieldspec["CODE_COUNTRY"] = array(
            "type" => "string",
            "size" => 5);

        $this->fieldspec["COUNTRY"] = array(
            "type" => "string",
            "size" => 30);

        $this->fieldspec["PHONE"] = array(
            "type" => "string",
            "size" => 30);

        $this->fieldspec["FAX"] = array(
            "type" => "string",
            "size" => 30);

        $this->fieldspec["MOBILE"] = array(
            "type" => "string",
            "size" => 30);

        $this->fieldspec["EMAIL"] = array(
            "type" => "string",
            "size" => 50);

        $this->fieldspec["GENDER"] = array(
            "type" => "string",
            "size" => 2);

        $this->fieldspec["BIRTHDATE"] = array(
            "type" => "string",
            "size" => 10);

        $this->fieldspec["PHOTO_TYPE"] = array(
            "type" => "string",
            "size" => 10);

        $this->fieldspec["PHOTO"] = array(
            "type" => "blob",
            "default" => "null");

        $this->fieldspec["CODE_APPLICATION"] = array(
            "type" => "string",
            "size" => 10);

        $this->fieldspec["APPLICATION"] = array(
            "type" => "string",
            "size" => 1024);

        $this->fieldspec["CODE_MOTHER_LANGUAGE"] = array(
            "type" => "string",
            "size" => 5);

        $this->fieldspec["MOTHER_LANGUAGE"] = array(
            "type" => "string",
            "size" => 10);

        $this->fieldspec["SOCIAL"] = array(
            "type" => "string",
            "size" => 1024);

        $this->fieldspec["ORGANISATIONAL"] = array(
            "type" => "string",
            "size" => 1024);

        $this->fieldspec["TECHNICAL"] = array(
            "type" => "string",
            "size" => 1024);

        $this->fieldspec["COMPUTER"] = array(
            "type" => "string",
            "size" => 1024);

        $this->fieldspec["ARTISTIC"] = array(
            "type" => "string",
            "size" => 1024);

        $this->fieldspec["OTHER"] = array(
            "type" => "string",
            "size" => 1024);

        $this->fieldspec["ADDITIONAL"] = array(
            "type" => "string",
            "size" => 1024);

        $this->fieldspec["ANNEXES"] = array(
            "type" => "string",
            "size" => 1024);

        $this->fieldspec["IS_ACTIVE"] = array(
            "type" => "enum",
            "values" => array(0, 1),
            "default" => 0);

        $this->fieldspec["WORKPAIR"] = array(
            "type" => "enum",
            "values" => array(0, 1),
            "default" => 0);

    }

}

?>

<?php

/**
 * Description of model
 *
 * @author Turo Nylund
 */
class SchoolDao extends MysqlDAO {

    function __construct() {
        parent::__construct();

        $this->tablename = "jb_schools";
        $this->rows_per_page = 10;

        $this->fieldspec["ID"] = array(
            "type" => "int",
            "size" => 11,
            "pkey" => true);

        $this->fieldspec["NAME"] = array(
            "type" => "string",
            "size" => 100,
            "required" => true);

        $this->fieldspec["TYPE"] = array(
            "type" => "string",
            "size" => 50,
            "required" => true);

        $this->fieldspec["ADDRESS"] = array(
            "type" => "string",
            "size" => 100,
            "required" => true);

        $this->fieldspec["MUNIC"] = array(
            "type" => "string",
            "size" => 50,
            "required" => true);

        $this->fieldspec["ZCODE"] = array(
            "type" => "string",
            "size" => 10,
            "required" => true);

        $this->fieldspec["COUNTRY"] = array(
            "type" => "string",
            "size" => 50,
            "required" => true);

        $this->fieldspec["CODE_COUNTRY"] = array(
            "type" => "int",
            "size" => 3,
            "required" => true);

        $this->fieldspec["EDU_FIELD"] = array(
            "type" => "string",
            "size" => 1024,
            "default" => "null");
        
        $this->fieldspec["CODE_EDU_FIELD"] = array(
            "type" => "int",
            "size" => 11,
            "default" => "null");
        
        $this->fieldspec["CONTACT_PERSON_FNAME"] = array(
            "type" => "string",
            "size" => 50,
            "default" => "null");
        
        $this->fieldspec["CONTACT_PERSON_LNAME"] = array(
            "type" => "string",
            "size" => 50,
            "default" => "null");
        
        $this->fieldspec["CONTACT_PERSON_EMAIL"] = array(
            "type" => "string",
            "size" => 50,
            "email" => true,
            "default" => "null");
        
        $this->fieldspec["CONTACT_PERSON_PHONE"] = array(
            "type" => "string",
            "size" => 30,
            "default" => "null");
        
        $this->fieldspec["CONTACT_PERSON_MPHONE"] = array(
            "type" => "string",
            "size" => 30,
            "default" => "null");
        
        $this->fieldspec["CONTACT_PERSON_FAX"] = array(
            "type" => "string",
            "size" => 30,
            "default" => "null");
        
        $this->fieldspec["CONTENT"] = array(
            "type" => "string",
            "default" => "null");
        
        $this->fieldspec["TITLE"] = array(
            "type" => "string",
            "size" => 255,
            "default" => "null");
        
        $this->fieldspec["DESCRIPTION"] = array(
            "type" => "string",
            "default" => "null");
        
        $this->fieldspec["AREA_INFO"] = array(
            "type" => "string",
            "default" => "null");
        
        $this->fieldspec["KEYWORDS"] = array(
            "type" => "string",
            "default" => "null");
        
        $this->fieldspec["HAS_FORM"] = array(
            "type" => "enum",
            "values" => array (0,1), 
            "default" => 0);
        
        $this->fieldspec["FORM_MESSAGE"] = array(
            "type" => "string",
            "default" => "null");
        
        $this->fieldspec["PHOTO_TYPE"] = array(
            "type" => "string",
            "size" => 10,
            "default" => "null");
        
        $this->fieldspec["PHOTO"] = array(
            "type" => "blob",
            "default" => "null");
    }

}

?>

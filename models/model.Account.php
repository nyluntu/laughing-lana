<?php

/**
 * Description of class
 *
 * @author Turo Nylund
 */
class Account extends MysqlDAO {

    function __construct() {
        parent::__construct();

        $this->tablename = "jb_accounts";
        $this->rows_per_page = 10;

        $this->fieldspec["id"] = array(
            "type" => "int",
            "size" => 11,
            "pkey" => true);

        $this->fieldspec["email"] = array(
            "type" => "string",
            "size" => 100,
            "email" => true,
            "required" => true);

        $this->fieldspec["password"] = array(
            "type" => "string",
            "required" => true,
            "password" => true,
            "hash" => "blowfish",
            "size" => 100);

        $this->fieldspec["home_school"] = array(
            "type" => "int",
            "size" => 11,
            "required" => true,
            "default" => 0);

        $this->fieldspec["active"] = array(
            "type" => "int",
            "size" => 11,
            "required" => true);

        $this->fieldspec["role"] = array(
            "type" => "int",
            "size" => 11,
            "required" => true);

        $this->fieldspec["in_practice"] = array(
            "type" => "int",
            "required" => true,
            "default" => 0);

        $this->fieldspec["created"] = array(
            "type" => "date",
            "default" => "now");

        $this->fieldspec["last_login"] = array(
            "type" => "date",
            "default" => "null");
    }

}

?>

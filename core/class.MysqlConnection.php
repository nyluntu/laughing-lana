<?php

/**
 * Description of class
 *
 * @author Turo Nylund
 */
class MysqlConnection implements DbConnection {

    private $dbhost = DB_HOST;      //Host name
    private $dbusername = DB_USER;       //Username for the database
    private $dbuserpass = DB_PASS;           //Password for the database user
    protected $dbconnect = NULL;        //Resource for database connection
    protected $query = NULL;            //Query to get data    

    /**
     * Function will make a connection to the database and save the database 
     * conection resource in class variable $dbconnect.
     * 
     * @param type $dbname
     * @return int
     */
    public function db_connect($dbname) {
        if (!$this->dbconnect)
            $this->dbconnect = mysql_connect($this->dbhost, $this->dbusername, $this->dbuserpass) or trigger_error("SQL", E_USER_ERROR);
        if (!$this->dbconnect) {
            return 0;
        } elseif (!mysql_select_db($dbname)) {
            return 0;
        } else {
            return $this->dbconnect;
        }
    }

}

?>

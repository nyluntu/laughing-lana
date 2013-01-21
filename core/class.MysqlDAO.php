<?php

/**
 * Description of class
 *
 * @author Turo Nylund
 */
class MysqlDAO extends MysqlConnection implements DAO {

    var $tablename;         //Table name
    var $dbname;            //Name of the database
    var $rows_per_page;     //Used in pagination
    var $pageno;            //Current page number
    var $lastpage;          //Highest page number
    var $fieldspec;          //Metadata of the fields
    var $data_array;        //Data from the database
    //Validation
    var $data_unformatted;
    //Components of query
    var $sql_select;
    var $sql_from;
    var $sql_where;
    var $sql_groupby;
    var $sql_having;
    var $sql_orderby;

    function __construct() {
        $this->dbname = DB_NAME;
        $this->rows_per_page = 10;
        Flash::init();
    }

    /* Public methods
     * ******************************* */

    /**
     * Function will return multi-dimensional array containing all the data.
     * 
     * @global type $dbconnect
     * @global type $query
     * @param type $where
     * @return multi-dimensional array
     */
    public function getData($where) {
        $this->data_array = array();
        $pageno = $this->pageno;
        $rows_per_page = $this->rows_per_page;
        $this->numrows = 0;
        $this->lastpage = 0;

        //Connecting to database using db_connect -function from parent class
        $this->db_connect($this->dbname) or trigger_error("SQL", E_USER_ERROR);

        $where_str = $this->buildWhere($where);
        //Count number of rows which satisfy the current selection criteria
        $this->numrows = $this->countNumberRows($where_str);

        //Check if there is data or not
        if ($this->numrows <= 0) {
            $this->pageno = 0;
            return;
        }

        //If data exist, calculate how many pages it will need
        if ($rows_per_page > 0) {
            $this->lastpage = ceil($this->numrows / $rows_per_page);
        } else {
            $this->lastpage = 1;
        }

        //Ensuring that the requesting number is within range
        if ($pageno == "" OR $pageno <= "1") {
            $pageno = 1;
        } elseif ($pageno > $this->lastpage) {
            $pageno = $this->lastpage;
        }
        $this->pageno = $pageno;

        //Set select clause for SQL-query
        $select_str = $this->buildSelect();
        //Set from clause for sql-query
        $from_str = $this->buildFrom();
        //Set group clause for sql-query
        $group_str = $this->buildGroup();
        //Set having clause for sql-query
        $having_str = $this->buildHaving();
        //Set order clause for sql-query
        $sort_str = $this->buildSort();
        //Set limit clause for SQL-query
        $limit_str = $this->buildLimit($rows_per_page, $pageno);

        //Generating the sql-query
        $query = $this->constructSelectQuery($select_str, $from_str, $where_str, $group_str, $having_str, $sort_str, $limit_str);

        // echo $query;

        $result = mysql_query($query, $this->dbconnect) or trigger_error("SQL", E_USER_ERROR);

        //Add retrieved data from database to data_array
        $this->setDataArray($result);

        //Return multi-dimensional array
        return $this->data_array;
    }

    /**
     * Function will insert new record into the database.
     * 
     * @global type $dbconnect
     * @global type $query
     * @param type $fieldarray
     * @return type
     */
    public function insertRecord($fieldarray) {

        $this->errors = array();

        //Connecting to database using db_connect -function from parent class
        $this->db_connect($this->dbname) or trigger_error("SQL", E_USER_ERROR);
        //Filter out fields that not belong to database table
        $fieldarray = $this->filterExtraFields($fieldarray);
        // var_dump($fieldarray);
        //Validate post array
        $fieldarray = $this->validateInsert($fieldarray);

        // var_dump($fieldarray);

        if (empty($this->errors)) {
            //Constructing the full query
            $query = $this->constructInsertQuery($fieldarray);
            
            //Execute the insert query and check dublicate key error.
            $result = @mysql_query($query, $this->dbconnect);
            if (mysql_errno() <> 0) {
                if (mysql_errno() == 1062) {
                    $this->errors[] = "A record already exist with this ID.";
                } else {
                    trigger_error("SQL", E_USER_ERROR);
                }
            } else {
                Flash::add("New record is succesfully stored");
            }
        } else {
            return;
        }
        return;
    }

    /**
     * Function will update record from the database table.
     * 
     * @global type $dbconnect
     * @global type $query
     * @param type $fieldarray
     * @return type
     */
    public function updateRecord($fieldarray) {
        $this->errors = array();
        //Connecting to database using db_connect -function from parent class
        $this->db_connect($this->dbname) or trigger_error("SQL", E_USER_ERROR);
        //Filter out fields that not belong to database table
        $fieldarray = $this->filterExtraFields($fieldarray);
        //Validate post array
        $fieldarray = $this->validateUpdate($fieldarray);

        // var_dump($fieldarray);
        if (empty($this->errors)) {
            //Extract the primary key and build update clause
            $query = $this->constructUpdateQuery($fieldarray);
            //Executing query
            // echo $query;
            $result = mysql_query($query, $this->dbconnect) or trigger_error("SQL", E_USER_ERROR);
            Flash::add("The record is succesfully updated");
        } else {
            return;
        }
        return;
    }

    /**
     * Function will delete one record from the database.
     * @global type $dbconnect
     * @global type $query
     * @param type $fieldarray
     * @return type
     */
    public function deleteRecord($fieldarray) {
        $this->errors = array();
        //Connecting to database using db_connect -function from parent class
        $this->db_connect($this->dbname) or trigger_error("SQL", E_USER_ERROR);
        //Identify the primary key and construct where clause
        $query = $this->constructDeleteQuery($fieldarray);
        //Execute the query
        $result = mysql_query($query, $this->dbconnect) or trigger_error("SQL", E_USER_ERROR);
        Flash::add("The record was deleted");
        return;
    }

    /**
     * Function will return one single dimension array by id.
     * @param type $id
     * @return type
     */
    public function findById($id) {
        $pk = NULL;
        foreach ($this->fieldspec as $item => $value) {
            if (isset($this->fieldspec[$item]["pkey"])) {
                $pk = $item;
            }
        }
        $where = "$pk='$id'";
        $data = $this->getData($where);
        return $data[0];
    }

    /* Private methods
     * ******************************* */

    /**
     * Function will build from-clause for the sql-query.
     * @return type
     */
    private function buildFrom() {
        if (empty($this->sql_from)) {
            return $this->tablename;
        } else {
            return $this->sql_from;
        }
    }

    /**
     * Function will construct group clause for sql-query.
     * @return null
     */
    private function buildGroup() {
        if (!empty($this->sql_groupby)) {
            return "GROUP BY $this->sql_groupby";
        } else {
            return NULL;
        }
    }

    /**
     * Function will construct having clause for sql-query.
     * @return null
     */
    private function buildHaving() {
        if (!empty($this->sql_having)) {
            return "HAVING $this->sql_having";
        } else {
            return NULL;
        }
    }

    /**
     * Function will consturct the limit clause for select query.
     * @param type $rows_per_page
     * @param type $pageno
     * @return null
     */
    private function buildLimit($rows_per_page, $pageno) {
        if ($rows_per_page > 0) {
            return "LIMIT " . ($pageno - 1) * $rows_per_page . "," . $rows_per_page;
        } else {
            return NULL;
        }
    }

    /**
     * Function will build select clause for sql-query.
     * @return string
     */
    private function buildSelect() {
        if (empty($this->sql_select)) {
            return "*";
        } else {
            return $this->sql_select;
        }
    }

    /**
     * Function will construct sort clause for sql-query.
     * @return null
     */
    private function buildSort() {
        if (!empty($this->sql_orderby)) {
            return "ORDER BY `$this->sql_orderby`";
        } else {
            return NULL;
        }
    }

    /**
     * Function check if the where condition is empty and construct the clause. 
     * Return WHERE clause.
     * 
     * @return string
     */
    private function buildWhere($where) {
        $where_str = NULL;
        if (empty($where)) {
            $where_str = NULL;
        } else {
            $where_str = "WHERE $where";
        }

        if (!empty($this->sql_where)) {
            if (!empty($where_str)) {
                $where_str .= " AND $this->sql_where";
            } else {
                $where_str = "WHERE $this->sql_where";
            }
        }
        return $where_str;
    }

    /**
     * Function will construct the delete clause from field array.
     * @param type $fieldarray
     * @return type
     */
    private function constructDeleteQuery($fieldarray) {
        $fieldlist = $this->fieldspec;
        $where = NULL;
        foreach ($fieldarray as $item => $value) {
            if (isset($fieldlist[$item]["pkey"])) {
                $where .= "$item='$value' AND ";
            }
        }
        $where = rtrim($where, " AND ");
        $query = "DELETE FROM $this->tablename WHERE $where";
        return $query;
    }

    /**
     * Function will construct the insert clause from field array.
     * @param type $fieldarray
     * @return type
     */
    private function constructInsertQuery($fieldarray) {
        $insertQuery = "INSERT INTO $this->tablename SET ";
        foreach ($fieldarray as $item => $value) {
            $insertQuery .= "`$item`='$value', ";
        }

        return rtrim($insertQuery, ", ");
    }

    /**
     * Function will consturct the select query from given parameters.
     * @param type $where_str
     * @param type $limit_str
     * @return type
     */
    private function constructSelectQuery($select_str, $from_str, $where_str, $group_str, $having_str, $sort_str, $limit_str) {
        $query = "SELECT    $select_str 
                    FROM    $from_str 
                            $where_str
                            $group_str
                            $having_str
                            $sort_str
                            $limit_str";
        return $query;
    }

    /**
     * Function will construct the update clause and return array.
     * 
     * @param type $fieldarray
     * @return type
     */
    private function constructUpdateQuery($fieldarray) {
        $fieldlist = $this->fieldspec;
        $where = NULL;
        $update = NULL;
        foreach ($fieldarray as $item => $value) {
            if (isset($fieldlist[$item]["pkey"])) {
                $where .= "`$item`='$value' AND ";
            } else {
                $update .= "`$item`='$value', ";
            }
        }
        $where = rtrim($where, " AND ");
        $update = rtrim($update, ", ");
        $query = "UPDATE $this->tablename SET $update WHERE $where";
        return $query;
    }

    /**
     * Function will count how many rows will be retrieved.
     * @param type $where
     * @return type
     */
    private function countNumberRows($where) {
        $query = "SELECT count(*) FROM $this->tablename $where";
        $result = mysql_query($query, $this->dbconnect) or trigger_error("SQL", E_USER_ERROR);
        $query_data = mysql_fetch_row($result);
        return $query_data[0];
    }

    /**
     * Function will filter extra fields from given field array.
     * 
     * @param type $fieldarray
     * @return type
     */
    private function filterExtraFields($fieldarray) {
        $fieldspec = $this->fieldspec;
        foreach ($fieldarray as $field) {
            if (!in_array($field, $fieldspec[$field])) {
                unset($fieldarray[$field]);
            }
        }
        return $fieldarray;
    }

    /**
     * Function will fill data_array with given data.
     * @param type $result
     */
    private function setDataArray($result) {
        while ($row = mysql_fetch_assoc($result)) {
            $this->data_array[] = $row;
        }
        mysql_free_result($result);
    }

    /**
     * Function validates user input by comparing input to table fieldspecs.
     * @param type $fieldarray
     */
    private function validateInsert($fieldarray) {
        $this->errors = array();
        $this->data_unformatted = array();

        foreach ($this->fieldspec as $field => $spec) {
            if (isset($fieldarray[$field])) {
                $value = $fieldarray[$field];
            } else {
                $value = NULL;
            }

            $value = $this->fieldValidation($field, $value, $spec);

            if (strlen((string) $value)) {
                $this->data_unformatted[$field] = $value;
            }
        }
        //var_dump($this->data_unformatted);
        return $this->data_unformatted;
    }

    /**
     * Function validates user input by comparing input to table fieldspecs.
     * @param type $fieldarray
     */
    private function validateUpdate($fieldarray) {
        $this->errors = array();
        $this->data_unformatted = array();

        foreach ($fieldarray as $field => $value) {
            //get specification of the field
            $spec = $this->fieldspec[$field];

            $value = $this->fieldValidation($field, $value, $spec, true);

            if (strlen($value)) {
                //echo "$field : $value<br/>";
                $this->data_unformatted[$field] = $value;
            } else {
                //echo "$field : $value<br/>";
                $this->data_unformatted[$field] = NULL;
            }
        }
        //var_dump($this->data_unformatted);
        return $this->data_unformatted;
    }

    /**
     * Whole validation process is inside the function.
     * @param type $fieldname
     * @param type $fieldvalue
     * @param type $fieldspec
     * @return type
     */
    private function fieldValidation($fieldname, $fieldvalue, $fieldspec, $update = false) {

        //Trim value from extra spaces
        $fieldvalue = trim($fieldvalue);

        if (strlen($fieldvalue) == 0) {
            //Is empty?
            if (isset($fieldspec["required"])) {
                if (isset($fieldspec["default"])) {
                    //$fieldvalue = (int) $fieldspec["default"];
                    $fieldvalue = $fieldspec["default"];
                } else {
                    $this->errors[$fieldname] = "$fieldname cannot be blank";
                }
            }

            if ($fieldspec["type"] == "date") {
                if (!empty($fieldspec["default"])) {
                    if ($fieldspec["default"] == "now") {
                        $fieldvalue = date('Y-m-d H:i:s', time());
                    } elseif ($fieldspec["default"] == "null") {
                        $fieldvalue = "0000-00-00 00:00:00";
                    }
                }
            }

            if ($fieldspec["type"] == "enum") {
                if (isset($fieldspec["default"])) {
                    $fieldvalue = $fieldspec["default"];
                }
            }
        } else { ////////////////////////////////////////////////////////////////////////////////////////
            //Check if size of the value is allowed
            if (isset($fieldspec["size"])) {
                $size = (int) $fieldspec["size"];
                if (strlen($fieldvalue) > $size) {
                    $this->errors[$fieldname] = "$fieldname cannot be > $size characters";
                }
            }

            //Check password attributes
            if (isset($fieldspec["password"])) {
                // passwords must have a 'hash' specification
                if (isset($fieldspec['hash'])) {
                    switch ($fieldspec['hash']) {
                        case 'blowfish':
                            $login = new Login();
                            $fieldvalue = $login->makeHash($fieldvalue);
                            break;
                        case 'md5':
                            $fieldvalue = md5($fieldvalue);
                            break;
                        case 'sha1':
                            $fieldvalue = sha1($fieldvalue);
                            break;
                        default:
                            $this->errors[$fieldname] = "$fieldname: specification for 'hash' is invalid";
                    }
                } else {
                    $this->errors[$fieldname] = "$fieldname: specification for 'hash' is missing";
                }
            }

            //Check format of email
            if (isset($fieldspec["email"])) {
                $pattern = "/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+/";
                if (!preg_match($pattern, $fieldvalue)) {
                    $this->errors[$fieldname] = "$fieldname is not valid address";
                }
            }

            if (isset($fieldspec["type"]) && $fieldspec["type"] == "enum") {
                if (isset($fieldspec["values"])) {
                    $values = $fieldspec["values"];
                    if (!in_array($fieldvalue, $values)) {
                        $this->errors[$fieldname] = "$fieldname: value is invalid";
                    }
                } else {
                    $this->errors[$fieldname] = "$fieldname: specification for 'value' is missing";
                }
            }

            if (isset($fieldspec["unique"])) {
                $where = "`$fieldname`='$fieldvalue'";
                $results = $this->getData($where);
                if (!empty($results)) {
                    $this->errors[$fieldname] = "$fieldname value is already taken";
                }
            }

            if (isset($fieldspec["type"]) && $fieldspec["type"] == "url") {
                if (!filter_var($fieldvalue, FILTER_VALIDATE_URL)) {
                    $this->errors[$fieldname] = "$fieldname value is not valid url-address";
                } 
            }
        }

        return $fieldvalue;
    }

}

?>

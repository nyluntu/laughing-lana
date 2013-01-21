<?php

/**
 * Description of interface
 *
 * @author Turo Nylund
 */
interface DAO {

    public function getData($where);

    public function insertRecord($fieldarray);

    public function updateRecord($fieldarray);

    public function deleteRecord($fieldarray);
}

?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (!file_exists('init.php'))
    die('The initialization file was not found.');

require_once 'init.php';

$request = new Request();


var_dump($request->verb);
var_dump($request->url_elements);
var_dump($request->script_name);

var_dump($_SERVER['QUERY_STRING'])

?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of schools_controller
 *
 * @author apina
 */
class SchoolsController extends AccountsController {

    public function create($smarty, $post) {
        if ($post) {
            $university = new SchoolDao();
            $university->insertRecord($post);
            if (empty($university->errors)) {
                redirect_to(BASE_URL . "admin?menu=schools&action=index");
            } else {
                $errors = $university->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=932");
        }
    }

    public function destroy($id) {
        if ($id) {
            $object = new SchoolDao();
            $fieldarray = array("ID" => $id);
            $object->deleteRecord($fieldarray);
            redirect_to(BASE_URL . "admin?menu=schools&action=index");
        } else {
            redirect_to(BASE_URL . "forward?status=930");
        }
    }

    public function edit($smarty, $id) {
        $object = new SchoolDao();
        $university = $object->findById($id);
        $smarty->assign('university', $university);
    }

    public function index($smarty, $show_page, $where) {
        $object = new SchoolDao();
        $object->sql_from = DB_PREFIX . "schools";
        $object->sql_orderby = "name";
        $object->pageno = $show_page;
        $where = "id <> 0";
        $universities = $object->getData($where);
        $smarty->assign('pagination', $object->lastpage);
        $smarty->assign('universities', $universities);
        $smarty->assign('flashes', Flash::display());
    }

    public function new_action($smarty) {
        $university = new SchoolDao();
        $smarty->assign('form', $university->fieldspec);
    }

    public function show($smarty, $id) {
        $object = new SchoolDao();
        $university = $object->findById($id);
        $smarty->assign('university', $university);
    }

    public function update($smarty, $post) {
        if ($post) {
            $university = new SchoolDao();
            $university->updateRecord($post);
            if (empty($university->errors)) {
                redirect_to(BASE_URL . "admin?menu=schools&action=index");
            } else {
                $errors = $university->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=933");
        }
    }

//put your code here
}

?>

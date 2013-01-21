<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of traineeships_controller
 *
 * @author apina
 */
class TraineeshipsController extends BaseController {

    public function index($smarty, $show_page, $where) {
        $object = new Traineeship();
        $object->sql_from = DB_PREFIX . "practice_event";
        $object->pageno = $show_page;
        $traineeships = $object->getData($where);
        $smarty->assign('pagination', $object->lastpage);
        $smarty->assign('traineeships', $traineeships);
        $smarty->assign('flashes', Flash::display());
        $smarty->assign_by_ref('object', $object);
    }

    public function show($smarty, $id) {
        $object = new Traineeship();
        $traineeship = $object->findById($id);
        $smarty->assign('traineeship', $traineeship);
    }

    public function edit($smarty, $id) {
        $object = new Traineeship();
        $traineeship = $object->findById($id);
        $smarty->assign('traineeship', $traineeship);
    }

    public function new_action($smarty) {
        trigger_error("SQL", E_USER_ERROR);
    }

    public function create($smarty, $post) {
        
    }

    public function update($smarty, $post) {
        if ($post) {
            $traineeship = new Traineeship();
            $traineeship->updateRecord($post);
            if (empty($traineeship->errors)) {
                redirect_to(BASE_URL . "admin?menu=traineeships&action=index");
            } else {
                $errors = $traineeship->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=933");
        }
    }

    public function destroy($id) {
        if ($id) {
            $object = new Traineeship();
            $fieldarray = array("id" => $id);
            $object->deleteRecord($fieldarray);
            redirect_to(BASE_URL . "admin?menu=traineeships&action=index");
        } else {
            redirect_to(BASE_URL . "forward?status=930");
        }
    }

}

?>

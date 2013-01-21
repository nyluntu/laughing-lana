<?php

/**
 * Description of cvss_controller
 *
 * @author apina
 */
class CvsController extends BaseController {

    public function index($smarty, $show_page, $where) {
        $object = new CVModel();
        $object->sql_from = DB_PREFIX . "cv_xml";
        $object->sql_orderby = "LNAME";
        $object->pageno = $show_page;
        $cvs = $object->getData($where);
        $smarty->assign('pagination', pagination($object->lastpage));
        $smarty->assign('cvs', $cvs);
        $smarty->assign('flashes', Flash::display());
        $smarty->assign_by_ref('object', $object);
    }

    public function show($smarty, $id) {
        $object = new CVModel();
        $cv = $object->findById($id);
        $smarty->assign('cv', $cv);
    }

    public function edit($smarty, $id) {
        $object = new CVModel();
        $cv = $object->findById($id);
        $smarty->assign('cv', $cv);
    }

    public function new_action($smarty) {
        $cv = new CVModel();
        $smarty->assign('form', $cv->fieldspec);
    }

    public function create($smarty, $post) {
        if ($post) {
            $cv = new CVModel();
            $cv->insertRecord($post);
            if (empty($cv->errors)) {
                redirect_to(BASE_URL . "admin?menu=cvs&action=index");
            } else {
                $errors = $cv->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=932");
        }
    }

    public function update($smarty, $post) {
        if ($post) {
            $cv = new CVModel();
            $cv->updateRecord($post);
            if (empty($cv->errors)) {
                redirect_to(BASE_URL . "admin?menu=cvs&action=index");
            } else {
                $errors = $cv->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=933");
        }
    }

    public function destroy($id) {
        if ($id) {
            $object = new CVModel();
            $fieldarray = array("id" => $id);
            $object->deleteRecord($fieldarray);
            redirect_to(BASE_URL . "admin?menu=cvs&action=index");
        } else {
            redirect_to(BASE_URL . "forward?status=930");
        }
    }

}
?>


<?php
/**
 * Description of phases_controller
 *
 * @author Turo Nylund
 */
class PhasesController extends BaseController {

    public function index($smarty, $show_page, $where) {
        $object = new Phase();
        $object->sql_from = DB_PREFIX . "status_group";
        $object->sql_orderby = "order";
        $object->pageno = $show_page;
        $phases = $object->getData($where);
        $smarty->assign('pagination', $object->lastpage);
        $smarty->assign('phases', $phases);
        $smarty->assign('flashes', Flash::display());
    }

    public function show($smarty, $id) {
        $object = new Phase();
        $phase = $object->findById($id);
        $smarty->assign('phase', $phase);
    }

    public function edit($smarty, $id) {
        $object = new Phase();
        $phase = $object->findById($id);
        $smarty->assign('phase', $phase);
    }

    public function new_action($smarty) {
        $phase = new Phase();
        $smarty->assign('form', $phase->fieldspec);
    }

    public function create($smarty, $post) {
        if ($post) {
            $phase = new Phase();
            $phase->insertRecord($post);
            if (empty($phase->errors)) {
                redirect_to(BASE_URL . "admin?menu=phases&action=index");
            } else {
                $errors = $phase->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=932");
        }
    }

    public function update($smarty, $post) {
        if ($post) {
            $phase = new Phase();
            $phase->updateRecord($post);
            if (empty($phase->errors)) {
                redirect_to(BASE_URL . "admin?menu=phases&action=index");
            } else {
                $errors = $phase->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=933");
        }
    }

    public function destroy($id) {
        if ($id) {
            $object = new Phase();
            $fieldarray = array("id" => $id);
            $object->deleteRecord($fieldarray);
            redirect_to(BASE_URL . "admin?menu=phases&action=index");
        } else {
            redirect_to(BASE_URL . "forward?status=930");
        }
    }

}

?>

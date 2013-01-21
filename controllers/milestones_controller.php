<?php

/**
 * Description of milestones_controller
 *
 * @author apina
 */
class MilestonesController extends BaseController {

    public function index($smarty, $show_page, $where) {
        $object = new MilestoneModel();
        $object->sql_from = DB_PREFIX . "status_title";
        $object->sql_orderby = "group_id";
        $object->pageno = $show_page;
        $milestones = $object->getData($where);
        $smarty->assign('pagination', $object->lastpage);
        $smarty->assign('milestones', $milestones);
        $smarty->assign('flashes', Flash::display());
    }

    public function show($smarty, $id) {
        $object = new MilestoneModel();
        $milestone = $object->findById($id);
        $smarty->assign('milestone', $milestone);
    }

    public function edit($smarty, $id) {
        $object = new MilestoneModel();
        $milestone = $object->findById($id);
        $smarty->assign('milestone', $milestone);
    }

    public function new_action($smarty) {
        $milestone = new MilestoneModel();
        $smarty->assign('form', $milestone->fieldspec);
    }

    public function create($smarty, $post) {
        if ($post) {
            $milestone = new MilestoneModel();
            $milestone->insertRecord($post);
            if (empty($milestone->errors)) {
                redirect_to(BASE_URL . "admin?menu=milestones&action=index");
            } else {
                $errors = $milestone->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=932");
        }
    }

    public function update($smarty, $post) {
        if ($post) {
            $milestone = new MilestoneModel();
            $milestone->updateRecord($post);
            if (empty($milestone->errors)) {
                redirect_to(BASE_URL . "admin?menu=milestones&action=index");
            } else {
                $errors = $milestone->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=933");
        }
    }

    public function destroy($id) {
        if ($id) {
            $object = new MilestoneModel();
            $fieldarray = array("id" => $id);
            $object->deleteRecord($fieldarray);
            redirect_to(BASE_URL . "admin?menu=milestones&action=index");
        } else {
            redirect_to(BASE_URL . "forward?status=930");
        }
    }

}

?>

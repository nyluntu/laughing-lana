<?php

/**
 * Description of educationlevels_controller
 *
 * @author apina
 */
class EducationLevelsController extends BaseController {

    public function index($smarty, $show_page, $where) {
        $object = new EducationLevelModel();
        $object->sql_from = DB_PREFIX . "education_classification";
        $object->pageno = $show_page;
        $educationlevels = $object->getData($where);
        $smarty->assign('pagination', $object->lastpage);
        $smarty->assign('educationlevels', $educationlevels);
        $smarty->assign('flashes', Flash::display());
    }

    public function show($smarty, $id) {
        $object = new EducationLevelModel();
        $educationlevel = $object->findById($id);
        $smarty->assign('educationlevel', $educationlevel);
    }

    public function edit($smarty, $id) {
        $object = new EducationLevelModel();
        $educationlevel = $object->findById($id);
        $smarty->assign('educationlevel', $educationlevel);
    }

    public function new_action($smarty) {
        $educationlevel = new EducationLevelModel();
        $smarty->assign('form', $educationlevel->fieldspec);
    }

    public function create($smarty, $post) {
        if ($post) {
            $educationlevel = new EducationLevelModel();
            $educationlevel->insertRecord($post);
            if (empty($educationlevel->errors)) {
                redirect_to(BASE_URL . "admin?menu=educationlevels&action=index");
            } else {
                $errors = $educationlevel->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=932");
        }
    }

    public function update($smarty, $post) {
        if ($post) {
            $educationlevel = new EducationLevelModel();
            $educationlevel->updateRecord($post);
            if (empty($educationlevel->errors)) {
                redirect_to(BASE_URL . "admin?menu=educationlevels&action=index");
            } else {
                $errors = $educationlevel->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=933");
        }
    }

    public function destroy($id) {
        if ($id) {
            $object = new EducationLevelModel();
            $fieldarray = array("id" => $id);
            $object->deleteRecord($fieldarray);
            redirect_to(BASE_URL . "admin?menu=educationlevels&action=index");
        } else {
            redirect_to(BASE_URL . "forward?status=930");
        }
    }

}

?>

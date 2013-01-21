<?php

/**
 * Description of languagelevels_controller
 *
 * @author Turo Nylund
 */
class LanguageLevelsController extends BaseController {

    public function index($smarty, $show_page, $where) {
        $object = new LanguageLevelModel();
        $object->sql_from = DB_PREFIX . "language_levels";
        $object->pageno = $show_page;
        $languagelevels = $object->getData($where);
        $smarty->assign('pagination', $object->lastpage);
        $smarty->assign('languagelevels', $languagelevels);
        $smarty->assign('flashes', Flash::display());
    }

    public function show($smarty, $id) {
        $object = new LanguageLevelModel();
        $languagelevel = $object->findById($id);
        $smarty->assign('languagelevel', $languagelevel);
    }

    public function edit($smarty, $id) {
        $object = new LanguageLevelModel();
        $languagelevel = $object->findById($id);
        $smarty->assign('languagelevel', $languagelevel);
    }

    public function new_action($smarty) {
        $languagelevel = new LanguageLevelModel();
        $smarty->assign('form', $languagelevel->fieldspec);
    }

    public function create($smarty, $post) {
        if ($post) {
            $languagelevel = new LanguageLevelModel();
            $languagelevel->insertRecord($post);
            if (empty($languagelevel->errors)) {
                redirect_to(BASE_URL . "admin?menu=languagelevels&action=index");
            } else {
                $errors = $languagelevel->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=932");
        }
    }

    public function update($smarty, $post) {
        if ($post) {
            $languagelevel = new LanguageLevelModel();
            $languagelevel->updateRecord($post);
            if (empty($languagelevel->errors)) {
                redirect_to(BASE_URL . "admin?menu=languagelevels&action=index");
            } else {
                $errors = $languagelevel->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=933");
        }
    }

    public function destroy($id) {
        if ($id) {
            $object = new LanguageLevelModel();
            $fieldarray = array("id" => $id);
            $object->deleteRecord($fieldarray);
            redirect_to(BASE_URL . "admin?menu=languagelevels&action=index");
        } else {
            redirect_to(BASE_URL . "forward?status=930");
        }
    }

}

?>

<?php

/**
 * Description of links_controller
 *
 * @author apina
 */
class LinksController extends BaseController {

    public function index($smarty, $show_page, $where) {
        $object = new LinkModel();
        $object->sql_from = DB_PREFIX . "country_links";
        $object->pageno = $show_page;
        $links = $object->getData($where);
        $smarty->assign('pagination', $object->lastpage);
        $smarty->assign('links', $links);
        $smarty->assign('flashes', Flash::display());
    }

    public function show($smarty, $id) {
        $object = new LinkModel();
        $link = $object->findById($id);
        $smarty->assign('link', $link);
    }

    public function edit($smarty, $id) {
        $object = new LinkModel();
        $link = $object->findById($id);
        $smarty->assign('link', $link);
    }

    public function new_action($smarty) {
        $link = new LinkModel();
        $smarty->assign('form', $link->fieldspec);
    }

    public function create($smarty, $post) {
        if ($post) {
            $link = new LinkModel();
            $link->insertRecord($post);
            if (empty($link->errors)) {
                redirect_to(BASE_URL . "admin?menu=links&action=index");
            } else {
                $errors = $link->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=932");
        }
    }

    public function update($smarty, $post) {
        if ($post) {
            $link = new LinkModel();
            $link->updateRecord($post);
            if (empty($link->errors)) {
                redirect_to(BASE_URL . "admin?menu=links&action=index");
            } else {
                $errors = $link->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=933");
        }
    }

    public function destroy($id) {
        if ($id) {
            $object = new LinkModel();
            $fieldarray = array("id" => $id);
            $object->deleteRecord($fieldarray);
            redirect_to(BASE_URL . "admin?menu=links&action=index");
        } else {
            redirect_to(BASE_URL . "forward?status=930");
        }
    }

}

?>

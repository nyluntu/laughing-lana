<?php

/**
 * Description of students_controller
 *
 * @author Turo Nylund
 */
class StudentsController extends BaseController {

    public function index($smarty, $show_page, $where) {
        $object = new Account();
        $object->sql_from = DB_PREFIX . "accounts";
        $object->pageno = $show_page;
        $where = "role=1";
        $accounts = $object->getData($where);
        $smarty->assign('pagination', $object->lastpage);
        $smarty->assign('accounts', $accounts);
        $smarty->assign('flashes', Flash::display());
    }

    public function show($smarty, $id) {
        $object = new Account();
        $account = $object->findById($id);
        $smarty->assign('account', $account);
    }

    public function edit($smarty, $id) {
        $object = new Account();
        $account = $object->findById($id);
        $smarty->assign('account', $account);
    }

    public function new_action($smarty) {
        $account = new Account();
        $smarty->assign('form', $account->fieldspec);
    }

    public function create($smarty, $post) {
        if ($post) {
            $account = new Account();
            $account->insertRecord($post);
            if (empty($account->errors)) {
                redirect_to(BASE_URL . "admin?menu=accounts&action=index");
            } else {
                $errors = $account->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=932");
        }
    }

    public function update($smarty, $post) {
        if ($post) {
            $account = new Account();
            $account->updateRecord($post);
            if (empty($account->errors)) {
                redirect_to(BASE_URL . "admin?menu=accounts&action=index");
            } else {
                $errors = $account->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=933");
        }
    }

    public function destroy($id) {
        if ($id) {
            $object = new Account();
            $fieldarray = array("id" => $id);
            $object->deleteRecord($fieldarray);
            redirect_to(BASE_URL . "admin?menu=accounts&action=index");
        } else {
            redirect_to(BASE_URL . "forward?status=930");
        }
    }

}

?>

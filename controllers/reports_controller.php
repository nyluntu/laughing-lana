<?php

/**
 * Description of reports_controller
 *
 * @author Turo Nylund
 */
class ReportsController extends BaseController {

    public function index($smarty, $show_page, $where) {
        $object = new ReportModel();
        $object->sql_from = DB_PREFIX . "report_title";
        $object->sql_orderby = "group_id";
        $object->pageno = $show_page;
        $reports = $object->getData($where);
        $smarty->assign('pagination', $object->lastpage);
        $smarty->assign('reports', $reports);
        $smarty->assign('flashes', Flash::display());
    }

    public function show($smarty, $id) {
        $object = new ReportModel();
        $report = $object->findById($id);
        $smarty->assign('report', $report);
    }

    public function edit($smarty, $id) {
        $object = new ReportModel();
        $report = $object->findById($id);
        $smarty->assign('report', $report);
    }

    public function new_action($smarty) {
        $report = new ReportModel();
        $smarty->assign('form', $report->fieldspec);
    }

    public function create($smarty, $post) {
        if ($post) {
            $report = new ReportModel();
            $report->insertRecord($post);
            if (empty($report->errors)) {
                redirect_to(BASE_URL . "admin?menu=reports&action=index");
            } else {
                $errors = $report->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=932");
        }
    }

    public function update($smarty, $post) {
        if ($post) {
            $report = new ReportModel();
            $report->updateRecord($post);
            if (empty($report->errors)) {
                redirect_to(BASE_URL . "admin?menu=reports&action=index");
            } else {
                $errors = $report->errors;
                $smarty->assign("errors", $errors);
            }
        } else {
            redirect_to(BASE_URL . "forward?status=933");
        }
    }

    public function destroy($id) {
        if ($id) {
            $object = new ReportModel();
            $fieldarray = array("id" => $id);
            $object->deleteRecord($fieldarray);
            redirect_to(BASE_URL . "admin?menu=reports&action=index");
        } else {
            redirect_to(BASE_URL . "forward?status=930");
        }
    }

}

?>

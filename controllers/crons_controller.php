<?php

/**
 * Description of maintenances_controller
 *
 * @author apina
 */
class CronsController extends BaseController {

    public function execute($smarty, $post = NULL, $id = NULL, $show_page = NULL, $where = NULL) {
        parent::execute($smarty, $post, $id, $show_page, $where);
        switch ($this->action) {
            case 'account':
                $this->cron_accounts();
                break;
            default:
                return NULL;
                break;
        }
    }

    public function create($smarty, $post) {
        throw new Exception("Method is not yet implement.");
    }

    public function destroy($id) {
        throw new Exception("Method is not yet implement.");
    }

    public function edit($smarty, $id) {
        throw new Exception("Method is not yet implement.");
    }

    public function index($smarty, $show_page, $where) {
        $smarty->assign('flashes', Flash::display());
        return;
    }

    public function new_action($smarty) {
        throw new Exception("Method is not yet implement.");
    }

    public function show($smarty, $id) {
        throw new Exception("Method is not yet implement.");
    }

    public function update($smarty, $post) {
        throw new Exception("Method is not yet implement.");
    }

    public function cron_accounts() {
        global $db;
        $sql = "SELECT email FROM " . DB_PREFIX . "accounts 
                WHERE (datediff(last_login, now()) < -365 AND last_login IS NOT NULL) 
                OR (datediff(created, now()) < -30 AND last_login IS NULL)
                OR active = 3";
        $arrayItems = $db->QueryArray($sql);
        $document = new Document();

        foreach ($arrayItems as $arrayItem) {
            $document->deleteFilesByOwnerId(get_account_id_by_email($arrayItem["email"]));
        }

        $sql = "DELETE FROM " . DB_PREFIX . "accounts 
                WHERE (datediff(last_login, now()) < -365 AND last_login IS NOT NULL) 
                OR (datediff(created, now()) < -30 AND last_login IS NULL)
                OR active = 3";
        Flash::add("Cron was executed succesfully");;
        redirect_to(BASE_URL . "admin?menu=crons&action=index");
    }

}

?>

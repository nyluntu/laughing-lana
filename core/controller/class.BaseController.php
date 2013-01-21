<?php

/**
 * Description of class
 *
 * @author Turo Nylund
 */
abstract class BaseController {

    public $action;

    public function __construct($action) {
        $this->action = $action;
    }

    public function execute($smarty, $post = NULL, $id = NULL, $show_page = NULL, $where = NULL) {
        switch ($this->action) {
            case 'index':
                $this->index($smarty, $show_page, $where);
                break;
            case 'show':
                $this->show($smarty, $id);
                break;
            case 'edit':
                $this->edit($smarty, $id);
                break;
            case 'new':
                $this->new_action($smarty);
                break;
            case 'create':
                $this->create($smarty, $post);
                break;
            case 'update':
                $this->update($smarty, $post);
                break;
            case 'destroy':
                $this->destroy($id);
                break;
            default:
                return NULL;
                break;
        }
    }

    public abstract function index($smarty, $show_page, $where);

    public abstract function show($smarty, $id);

    public abstract function edit($smarty, $id);

    public abstract function new_action($smarty);

    public abstract function create($smarty, $post);

    public abstract function update($smarty, $post);

    public abstract function destroy($id);
}

?>

<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/view/admin/AdminView.php';

class AdminController extends Controller{
    protected function create() {
	
    }

    protected function index() {
	$view = new AdminView();
	$adminList = MysqlAdapter::getInstance()->getUser('SELECT * FROM user WHERE use_id !=3 AND use_administrator = 1');
	$view->assign('adminList', $adminList);
	$admin = MysqlAdapter::getInstance()->getUser('SELECT * FROM user WHERE use_id = 1');
	$view->assign('admin', $admin);
	$view->display();
    }

    protected function init() {
	
    }

    protected function show() {
	
    }
}

?>

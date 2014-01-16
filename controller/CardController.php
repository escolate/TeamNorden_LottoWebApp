<?php

class CardController extends Controller{
    protected function create() {
	
    }

    protected function index() {
	
    }

    protected function init() {
	include_once $_SERVER['DOCUMENT_ROOT'] . '/view/card/CardInitView.php';
        $view = new CardInitView();
        
        $view->display();
    }

    protected function show() {
	include_once $_SERVER['DOCUMENT_ROOT'] . '/view/card/CardShowView.php';
        $view = new CardShowView();
        
        $card = MysqlAdapter::getInstance()->getCard($this->resourceId);
        $view->assign('card', $card);
        
        $user = MysqlAdapter::getInstance()->getUser_($card->getCar_cre_id());
        $view->assign('create', $user->getUse_firstname().' '.$user->getUse_lastname());
        
        $user = MysqlAdapter::getInstance()->getUser_($card->getCar_mod_id());
        $view->assign('mod', $user->getUse_firstname().' '.$user->getUse_lastname());
        
        $view->display();
    }
}
?>

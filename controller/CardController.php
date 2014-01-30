<?php

class CardController extends Controller {

    protected function create() {
        if (isset($_POST['action']) && $_POST['action'] == 'delete') {
            foreach ($_POST['carid'] as $id) {
                $card = MysqlAdapter::getInstance()->getCards($id);
                $card->setCar_del(1);
                MysqlAdapter::getInstance()->saveCards($card);
            }
            header("Location: /card/", 301);
            exit();
        } else {
            if(isset($_POST['id']) && $_POST['id'] > 0) {
                $card = MysqlAdapter::getInstance()->getCards($_POST['id']);
            }
            else {
                $card = new Cards();
                $card->setCar_id($_POST['id']);
                $card->setRow1(new Rows());
                $card->setRow2(new Rows());
                $card->setRow3(new Rows());
            }
            $card->setCar_serialnumber($_POST['serialnumber']);
            
            foreach ($_POST as $key => $val) {
                if (preg_match('/^row[0-9]+nr[0-9]+$/', $key) && is_numeric($val)) {
                    $str = str_replace('row', '', $key);
                    $arr = explode('nr', $str);
                    $card->{'getRow'.$arr[0]}()->{'setRow_nr'.$arr[1]}($val);
                }
            }
            $id = MysqlAdapter::getInstance()->saveCards($card);

            header("Location: /card/" . $id, 301);
            exit();
        }
    }

    protected function index() {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/view/card/CardView.php';
        $view = new CardView();
        $view->assign('cards', MysqlAdapter::getInstance()->getCardList());
        $view->display();
    }

    protected function init() {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/view/card/CardInitView.php';
        $view = new CardInitView();

        $card = MysqlAdapter::getInstance()->getCards($this->resourceId);
        $view->assign('card', $card);
        $view->assign('id', $this->resourceId);

        $view->display();
    }

    protected function show() {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/view/card/CardShowView.php';
        $view = new CardShowView();

        $card = MysqlAdapter::getInstance()->getCards($this->resourceId);
        $view->assign('card', $card);

        $user = MysqlAdapter::getInstance()->getUser_($card->getCar_cre_id());
        $view->assign('create', $user->getUse_firstname() . ' ' . $user->getUse_lastname());

        $user = MysqlAdapter::getInstance()->getUser_($card->getCar_mod_id());
        $view->assign('mod', $user->getUse_firstname() . ' ' . $user->getUse_lastname());

        $view->display();
    }

}

?>

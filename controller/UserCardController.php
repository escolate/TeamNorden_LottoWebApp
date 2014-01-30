<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserCardController
 *
 * @author tscheurer
 */
class UserCardController extends Controller {

    protected function create() {
        $cards = array();
        $user = MysqlAdapter::getInstance()->getUser_($_POST['user']);

        switch ($_POST['action']) {
            case 'delete':
                //Delete Card
                foreach ($_POST['car_ser'] as $id) {
                    $arr = explode(',', $id);
                    $emc = new Eventmembercard();
                    $emc->setUser($user);
                    $emc->setCard(MysqlAdapter::getInstance()->getCards($arr[0]));
                    $emc->saveSeries(MysqlAdapter::getInstance()->getSeries($arr[1]));
                    MysqlAdapter::getInstance()->deleteUserCard($emc);
                }
                $this->show();
                break;
            case 'add':
                //Add Item
                foreach ($_POST['card'] as $id) {
                    $emc = new Eventmembercard();
                    $emc->setUser($user);
                    $emc->setCard(MysqlAdapter::getInstance()->getCards($id));
                    $emc->saveSeries(MysqlAdapter::getInstance()->getSeries($_POST['series']));
                    MysqlAdapter::getInstance()->addUserCard($emc);
                }
                $this->init();
                break;
        }
//        $this->show();
    }

    protected function index() {
        
    }

    protected function init() {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/view/usercard/UserCardInitView.php';
        $view = new UserCardInitView();

        $user = MysqlAdapter::getInstance()->getUser_($this->resourceId);
        $view->assign('user', $user);

        $events = MysqlAdapter::getInstance()->getEventList(0, true);
        $view->assign('eventlist', $events);

        if (!isset($_GET['event'])) {
            $_GET['event'] = $events[0]->getEvt_id();
        }

        $series = MysqlAdapter::getInstance()->getEventSeries($_GET['event']);
        $view->assign('series', $series);

        if (!isset($_GET['series'])) {
            $_GET['series'] = $series[0]->getSer_id();
        }
        $view->assign('cards', MysqlAdapter::getInstance()->getEventCards($_GET['series']));

        $view->display();
    }

    protected function show() {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/view/usercard/UserCardShowView.php';
        $view = new UserCardShowView();

        $user = MysqlAdapter::getInstance()->getUser_($this->resourceId);
        $view->assign('user', $user);
        $view->assign('usercards', MysqlAdapter::getInstance()->getUserCards($user->getUse_id()));

        $view->display();
    }

//put your code here
}

?>

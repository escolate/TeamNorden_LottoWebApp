<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WinnerController
 *
 * @author tscheurer
 */
class WinnerController extends Controller {

    protected function create() {
        switch ($_POST['action']) {
            case 'save':
                $win_id = $_POST['win_id'];
                $winner = MysqlAdapter::getInstance()->getWinner($win_id);
                $winner->setWin_del(0);
                $winner->setWin_prize($_POST['win_prize']);
                MysqlAdapter::getInstance()->saveWinner($winner);
                if ($winner->getWin_notificated() == '') {
                    //Send Mail
                    echo "mail";
                    MysqlAdapter::getInstance()->setWinnerNotification($win_id);
                }
                header("Location: /winner/" . $winner->getWin_id(), TRUE, 303);
                exit();
                break;
            case 'add':
                $ser_id = $_POST['ser_id'];
                $row_id = $_POST['row_id'];
                $use_id = $_POST['use_id'];
                $win_id = $_POST['win_id'];
                if (is_numeric($row_id) && is_numeric($ser_id) && is_numeric($use_id)) {
                    $winner = new Winner();
                    if(is_numeric($win_id)&& $win_id > 0) {
                        $winner->setWin_id($win_id);
                    }
                    $winner->setSeries(MysqlAdapter::getInstance()->getSeries($ser_id));
                    $winner->setUser(MysqlAdapter::getInstance()->getUser_($use_id));
                    $winner->setRow_id($row_id);
                    MysqlAdapter::getInstance()->saveWinner($winner);
                }
                header("Location: /winner/" . $winner->getWin_id(), TRUE, 303);
                exit();
                break;
            case 'cancel':
                $win_id = $_POST['win_id'];
                $winner = MysqlAdapter::getInstance()->getWinner($win_id);
                $winner->setWin_del('1');
                MysqlAdapter::getInstance()->saveWinner($winner);
                header("Location: /winner", TRUE, 303);
                exit();
                break;
        }
    }

    protected function index() {
        include_once 'view/winner/WinnerView.php';
        $view = new WinnerView();
        $list = MysqlAdapter::getInstance()->getWinnerList();
        $view->assign('list', $list);
        $view->display();
    }

    protected function init() {
        
    }

    protected function show() {
        include_once 'view/winner/WinnerShowView.php';
        $view = new WinnerShowView();

        $winner = MysqlAdapter::getInstance()->getWinner($this->resourceId);
        $view->assign('winner', $winner);
        // Get winner's numbers
        $view->assign('numberList', MysqlAdapter::getInstance()->getNumberList($winner->getSeries()->getSer_id()));

        $view->display();
    }

}

?>

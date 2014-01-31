<?php

include_once './view/event/EventView.php';
include_once './view/event/EventShowView.php';
include_once './view/event/EventAddUserView.php';
include_once './view/event/EventInitView.php';

class EventController extends Controller {

    protected function create() {
        $submit = $_POST['submit'];
        switch ($submit) {
            case "backToEvent": // back to event
                header("Location: /veranstaltung/$this->resourceId", TRUE, 303);
                break;
            case "backToEvents": // back to all eventS!!!
                header("Location: /veranstaltung/", TRUE, 303);
                break;
            case "createEvent": // create event
                $evt_name = trim($_POST['evt_name']);
                $evt_day = $_POST['day'];
                $evt_month = $_POST['month'];
                $evt_year = $_POST['year'];
                $evt_location = trim($_POST['evt_location']);
                $evt_city = trim($_POST['evt_city']);
                $evt_zip = trim($_POST['evt_zip']);
                // Set data to event object
                $event = new Event();
                $event->setEvt_name($evt_name);
                $event->setEvt_datetime($evt_year . "-" . $evt_month . "-" . $evt_day);
                $event->setEvt_location($evt_location);
                $event->setEvt_city($evt_city);
                $event->setEvt_zip($evt_zip);
                // Give event object to database adapter
                $eventId = MysqlAdapter::getInstance()->saveEvent($event);
                // Also create the first series
                $seriesId = MysqlAdapter::getInstance()->saveSeries($eventId);
                // Set old cards to the new series
//                MysqlAdapter::getInstance()->recycleCards($seriesId); --> Nichts zu recyceln da noch keine Runde gespielt

                // Jump to the event site
                header("Location: /veranstaltung/", TRUE, 303);
                break;
            case "editEvent":
                $evt_id = trim($_POST['evt_id']);
                $evt_name = trim($_POST['evt_name']);
                $evt_day = $_POST['day'];
                $evt_month = $_POST['month'];
                $evt_year = $_POST['year'];
                $evt_location = trim($_POST['evt_location']);
                $evt_city = trim($_POST['evt_city']);
                $evt_zip = trim($_POST['evt_zip']);
                // Set data to event object
                $event = new Event();
                $event->setEvt_id($evt_id);
                $event->setEvt_name($evt_name);
                $event->setEvt_datetime($evt_year . "-" . $evt_month . "-" . $evt_day);
                $event->setEvt_location($evt_location);
                $event->setEvt_city($evt_city);
                $event->setEvt_zip($evt_zip);
                // Give event object to database adapter
                $eventId = MysqlAdapter::getInstance()->updateEvent($event);
                // Jump to the event site
                header("Location: /veranstaltung/$evt_id-$evt_name", TRUE, 303);
                break;
            case "deleteEvent": // delete event
                $eventIds = $_POST['eventIds'];
                if (count($eventIds)) {
                    foreach ($eventIds as $eventId) {
                        MysqlAdapter::getInstance()->deleteEvent($eventId);
                    }
                }
                header("Location: {$_SERVER['HTTP_REFERER']}", TRUE, 303);
                break;
            case "addUserToEvent": // add user to event
                $userIds = $_POST['userIds'];
                if (count($userIds)) {
                    foreach ($userIds as $userId) {
                        MysqlAdapter::getInstance()->addEventmember($userId, $this->resourceId);
                    }
                }
                header("Location: {$_SERVER['HTTP_REFERER']}", TRUE, 303);
                break;
            case "removeUserFromEvent": // remove user from event
                $userIds = $_POST['userIds'];
                if (count($userIds)) {
                    foreach ($userIds as $userId) {
                        MysqlAdapter::getInstance()->removeUser($userId, $this->resourceId);
                    }
                }
                header("Location: {$_SERVER['HTTP_REFERER']}", TRUE, 303);
                break;
            case "saveNumber"; // save number for a series
                $number = trim($_POST['number']);
                $eve_id = $_POST['eve_id'];
                $stat = false;
                if (preg_match("/^\d+$/", $number)) {
                    $seriesId = $_POST['seriesId'];
                    $stat = MysqlAdapter::getInstance()->saveNumber($number, $seriesId);
                }
                $err = ($stat) ? '' : '?err=1';
                header("Location: /veranstaltung/{$eve_id}{$err}", TRUE, 303);
                break;
            case "deleteNumber": // delete number from series
                $seriesId = $_POST['seriesId'];
                $numberIds = $_POST['numberIds'];
                if (count($numberIds)) {
                    foreach ($numberIds as $numberId) {
                        MysqlAdapter::getInstance()->deleteNumber($numberId, $seriesId);
                    }
                }
                header("Location: {$_SERVER['HTTP_REFERER']}", TRUE, 303);
                break;
            case "closeSeries": // close series
                $seriesId = MysqlAdapter::getInstance()->saveSeries($this->resourceId);
                // Set old cards to the new series
                if (!MysqlAdapter::getInstance()->recycleCards($seriesId)) {
                    exit("Error");
                }
                header("Location: {$_SERVER['HTTP_REFERER']}", TRUE, 303);
                break;
            case "deleteSeries": // delete series from event
                $seriesIds = $_POST['seriesIds'];
                if (count($seriesIds)) {
                    foreach ($seriesIds as $seriesId) {
                        MysqlAdapter::getInstance()->deleteSeries($seriesId);
                    }
                }
                header("Location: {$_SERVER['HTTP_REFERER']}", TRUE, 303);
                break;
            case "editSeries": // go to SeriesController.php
                $seriesIds = $_POST['seriesIds'];
                if (count($seriesIds) == 1) {
                    $eventId = $this->resourceId;
                    $seriesNames = $_POST['seriesNames'];
                    header("Location: /series/?seriesId={$seriesIds[0]}&eventId=$eventId&seriesName=$seriesNames[0]", TRUE, 303);
                } else {
                    header("Location: {$_SERVER['HTTP_REFERER']}", TRUE, 303);
                }
                break;
            default: // when nothing is clicked
                header("Location: {$_SERVER['HTTP_REFERER']}", TRUE, 303);
                break;
        }

    }

    protected function index() {
        $view = new EventView();
        $eventList = MysqlAdapter::getInstance()->getEventList();
        $view->assign('eventList', $eventList);
        $eventCreatorList = array();
        foreach ($eventList as $object) {
            $eventCreatorList[] = MysqlAdapter::getInstance()->getUser_($object->getEvt_cre_id());
        }
        $view->assign('eventCreatorList', $eventCreatorList);
        $view->display();
    }

    protected function init() {
        if (preg_match("@/add/([0-9]+)$@", $_SERVER['REQUEST_URI'])) {
            $view = new EventAddUserView();
            $userList = MysqlAdapter::getInstance()->getUserList();
            $eventmemberList = MysqlAdapter::getInstance()->getEventmemberList($this->resourceId);
            $event = MysqlAdapter::getInstance()->getEvent($this->resourceId);
            $view->assign('user', $userList);
            $view->assign('eventmember', $eventmemberList);
            $view->assign('event', $event);
            $view->display();
        } else {
            $view = new EventInitView();
            $event = MysqlAdapter::getInstance()->getEvent($this->resourceId);
            $view->assign('event', $event);
            $view->display();
        }
    }

    protected function show() {
        // Event show
        $view = new EventShowView();
        $event = MysqlAdapter::getInstance()->getEvent($this->resourceId);
        $view->assign('event', $event);
        // Event user and creator show
        $eventCre = MysqlAdapter::getInstance()->getUser_($event->getEvt_cre_id());
        $eventMod = MysqlAdapter::getInstance()->getUser_($event->getEvt_mod_id());
        $view->assign('eventCre', $eventCre);
        $view->assign('eventMod', $eventMod);
        // Event members
        $eventmemberList = MysqlAdapter::getInstance()->getEventmemberList($this->resourceId);
        $eventmemberNameList = array();
        if ($eventmemberList) {
            foreach ($eventmemberList as $object) {
                $eventmemberNameList[] = MysqlAdapter::getInstance()->getUser_($object->getUse_id());
            }
        }
        $view->assign('eventmemberNameList', $eventmemberNameList);
        // Series list
        $seriesList = MysqlAdapter::getInstance()->getSeriesList($this->resourceId);
        $view->assign('seriesList', $seriesList);
        if (!$seriesList[0]) {
            $serId = 0;
        } else {
            $serId = $seriesList[0]->getSer_id();
        }
        // Numbers list
        $numberList = NULL;
        $newestSeries = MysqlAdapter::getInstance()->getNewestSeries($this->resourceId);
        if ($newestSeries) {
            $numberList = MysqlAdapter::getInstance()->getNumberList($newestSeries->getSer_id());
        }
        $view->assign('numberList', $numberList);
        //Also give the newest series id to the view
        $view->assign('newestSeries', $newestSeries);

        $view->assign('emcs', MysqlAdapter::getInstance()->getPlayingUsers($newestSeries->getSer_id()));

        $winner = MysqlAdapter::getInstance()->findWinner($newestSeries->getSer_id());
        if (count($winner)) {
            $winarr = array();
            foreach ($winner as $arr) {
                $winner = new Winner();
                $winner->setUser(MysqlAdapter::getInstance()->getUser_($arr['use_id']));
                $winner->setCard(MysqlAdapter::getInstance()->getCards($arr['car_id']));
                $winner->setSeries(MysqlAdapter::getInstance()->getSeries($newestSeries->getSer_id()));
                $winner->setRow_id($arr['row_id']);
                $winner->setWin_id($arr['win_id']);
                $winarr[] = $winner;
            }
            $view->assign('winner', $winarr);
        }

        // Display the event
        $view->display();
    }

}

?>

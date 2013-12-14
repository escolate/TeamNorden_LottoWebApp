<?php
if (!isset($_GET['action'])) {
    exit();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/MysqlAdapter.php';

$action = $_GET['action'];


header('Content-Type: text/plain; charset=UTF-8');

switch ($action) {
    case 'zip':
        locationToZip($_GET['zip']);
        break;
}

exit();

/**
 * Output location to ZIP
 * @param int $zip
 */
function locationToZip($zip) {
    if (is_numeric($zip)) {
        echo MysqlAdapter::getInstance()->getLocation($zip);
    }
}

?>

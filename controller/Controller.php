<?php

abstract class Controller {

    /**
     * ID of the URL request
     * @var type 
     */
    protected $resourceId;

    /**
     * Reads collection data from model 
     * and assigns values to dedicated view template
     */
    abstract protected function index();

    /**
     * Reads data of a single resource from model 
     * and assigs values to dedicated view template 
     */
    abstract protected function show();

    /**
     * creates a new empty instance of the resource 
     */
    abstract protected function init();

    /**
     * validates and stores sent user data of a newly created resource
     */
    abstract protected function create();

    public function route() {
	switch ($_SERVER['REQUEST_METHOD']) {
	    case 'GET':
		$matches = array();
		if (preg_match("@^.*/([0-9]+)@", $_SERVER['REQUEST_URI'], $matches)) {
		    $this->resourceId = $matches[1];
		    if (preg_match("@/edit/([0-9]+)@", $_SERVER['REQUEST_URI'])) {
			$this->init();
		    } elseif (preg_match("@/add/([0-9]+)$@", $_SERVER['REQUEST_URI'])) {
			$this->create();
		    } else {
			$this->show();
		    }
		} elseif (preg_match("@/new$@", $_SERVER['REQUEST_URI'])) {
		    $this->init();
		} else {
		    $this->index();
		}
		break;
	    case 'POST':
		$matches = array();
		if (preg_match("@^.*/([0-9]+)@", $_SERVER['REQUEST_URI'], $matches)) {
		    $this->resourceId = $matches[1];
		}
		$this->create();
		break;
	    default:
		break;
	}
    }

    public static function encodeUrl($url) {
	$specialChars = array(
	    "ä" => "ae",
	    "ö" => "oe",
	    "ü" => "ue",
	    "é|ê|è" => "e",
	    "á|â|à" => "a",
	    "ç" => "c"
	);
	foreach ($specialChars as $find => $replace) {
	    $url = preg_replace("/($find)/i", $replace, $url);
	}
	// Replace whitespace chars
	$url = preg_replace('/\s/', '-', $url);
	// Remove all remaining disallowed chars
	$url = preg_replace('/[^a-zA-Z0-9_\-\.]/', '', $url);
	// Replace multiple '-' chars with a single '-'
	$url = preg_replace('/(\-)+/', '-', $url);
	return $url;
    }

}

?>
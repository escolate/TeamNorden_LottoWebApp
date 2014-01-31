<?php

class logView extends View {

    public function display() {
	echo <<<HTML
	<div class="content-box">
    <h1>Verlauf</h1>
    <div class="button-box">
	<a href="#" class="button blue">Alle anzeigen</a>
    </div>
    <div class="list">
	<table>
	    <thead>
		<tr>
		    <th>Aktion</th>
		    <th>Erstellt am</th>
                    <th></th>
		</tr>
	    </thead>
	    <tbody>
HTML;
	/* @var $val Log */
	foreach ($this->vars['logList'] as $val) {
	    $icon = "";

	    if ($val->getLog_level() == Log::WARNING) {
		$icon = '<img src="/images/icons/error.png">';
	    }

	    if ($val->getLog_level() == Log::ERROR) {
		$icon = '<img src="/images/icons/exclamation.png">';
	    }

	    if ($val->getLog_level() == Log::INFORMATIONAL) {
		$icon = '<img src="/images/icons/tick.png">';
	    }

	    if ($val->getLog_level() == Log::NOTICE) {
		$icon = '<img src="/images/icons/information.png">';
	    }

	    echo'<tr>
		    <td><a href="/log/' . $val->getLog_id() . '">' . $val->getLog_action() . '</a></td>
		    <td><a href="/log/' . $val->getLog_id() . '">' . $this->getDate($val->getLog_timestamp()) . " - " . $this->getTime($val->getLog_timestamp()) . '</a></td>
                    <td><a href="/log/' . $val->getLog_id() . '">' . $icon . '</a></td>
		</tr>';
	}
	echo <<<HTML
	    </tbody>
	</table>
    </div>
</div>        
HTML;
    }

}

?>

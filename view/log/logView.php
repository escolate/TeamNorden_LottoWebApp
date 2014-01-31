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
		    <th>Ausgelöst durch</th>
		    <th>Ausgelöst am</th>
		    <th>IP-Adresse</th>
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
		    <td>' . $val->getLog_action() . '</td>
		    <td>'.$val->getUse_id().'</td>
		    <td>' . $this->getDate($val->getLog_timestamp()) . " - " . $this->getTime($val->getLog_timestamp()) . '</td>
		    <td>'.$val->getLog_ip().'</td>
		    <td>' . $icon . '</td>
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

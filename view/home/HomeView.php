<?php

class HomeView extends View {

    public function display() {
	echo <<<HTML
        <div class="content-box">
    <h1>Veranstaltungen</h1>
        <div class="button-box">
	<a href="veranstaltung" class="button blue">Alle anzeigen</a>
	<a href="/veranstaltung/new" class="button green">Erstellen</a>
    </div>
    <div class="list">
	<table>
	    <thead>
		<tr>
		    <th>Name</th>
		    <th>Veranstaltungsdatum</th>
		</tr>
	    </thead>
	    <tbody>
HTML;
	foreach ($this->vars['eventList'] as $object) {
	    echo '<tr>';
	    echo "<td><a href=\"/veranstaltung/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$object->getEvt_name()}</a></td>";
	    echo "<td><a href=\"/veranstaltung/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$this->getDate($object->getEvt_datetime())}</a></td>";
	    echo '</tr>';
	}
	echo <<<HTML
	    </tbody>
	</table>
    </div>
</div>


<div class="content-box">
    <h1>Gewinner</h1>
        <div class="button-box">
	<a href="/gewinner" class="button blue">Alle anzeigen</a>
    </div>
    <div class="list">
	<table>
	    <thead>
		<tr>
		    <th>Name</th>
		    <th>Gewonnen am </th>  
		</tr>
	    </thead>
	    <tbody>
HTML;

	/* @var $object \Winner */
	foreach ($this->vars['winnerList'] as $object) {
	    echo '<tr>';
	    echo "<td><a href=\"/gewinner/{$object->getWin_id()}-\">{$object->getUser()->getUse_firstname()} {$object->getUser()->getUse_lastname()}</a></td>";
	    echo "<td><a href=\"/gewinner/{$object->getWin_id()}-\">{$this->getDate($object->getWin_cre_dat())} - {$this->getTime($object->getWin_cre_dat())}</a></td>";
	    echo '</tr>';
	}

	echo <<<HTML

	    </tbody>
	</table>
    </div>
</div>

<div class="content-box">
    <h1>Benutzer</h1>
    <div class="button-box">
	<a href="/benutzer" class="button blue">Alle anzeigen</a>
	<a href="/benutzer/new" class="button green">Erstellen</a>
    </div>
    <div class="list">
	<table>
	    <thead>
		<tr>
		    <th>Name</th>
		    <th>Erstellt am</th>
		</tr>
	    </thead>
	    <tbody>
HTML;

	foreach ($this->vars['userlist'] as $user) {
	    echo <<<OUT
        <tr>
        <td><a href = "/benutzer/{$user->getUse_id()}-{$user->getUse_firstname()} {$user->getUse_lastname()}">{$user->getUse_firstname()} {$user->getUse_lastname()}</a></td>
        <td><a href = "/benutzer/{$user->getUse_id()}-{$user->getUse_firstname()} {$user->getUse_lastname()}">{$this->getDate($user->getUse_cre_dat()) }</a></td>
        </tr>
OUT;
	}
	echo <<<HTML
	    </tbody>
	</table>
    </div>
</div>


<div class="content-box">
    <h1>Lottokarten</h1>
    <div class="button-box">
	<a href="/karte" class="button blue">Alle anzeigen</a>
	<a href="/karte/new" class="button green">Erstellen</a>
    </div>
    <div class="list">
	<table>
	    <thead>
		<tr>
		    <th>Kartennr.</th>
		    <th>Reihe 1</th>
		    <th>Reihe 2</th>
		    <th>Reihe 3</th>
		    <th>Erstellt am</th>
		</tr>
	    </thead>

	    <tbody>
HTML;

        /* @var $card \Cards */
        foreach ($this->vars['cardList'] as $card) {
            echo "<tr>\r\n";
            echo '
                        <td><a href="/karte/' . $card->getCar_id() . '">' . $card->getCar_serialnumber() . '</a></td>';
            $row = 1;
            for ($line = 1; $line < 4; $line++) {
                echo '<td><a href="/karte/' . $card->getCar_id() . '">';
                for ($row = 1; $row < 6; $row++) {
                    if ($row > 1) {
                        echo ',';
                    }
		    echo $card->{'getRow'.$line}()->{'getRow_nr'.$row}();
                }
                echo "</a></td>";
            }

            echo '<td><a href="/karte/' . $card->getCar_id() . '">' . $card->getCar_cre_dat() . '</a></td>';
            echo "</tr>\r\n";
        }

	echo <<<HTML
	    </tbody>
	</table>
    </div>
</div>

<div class="content-box">
    <h1>Verlauf</h1>
    <div class="button-box">
	<a href="/verlauf" class="button blue">Alle anzeigen</a>
    </div>
    <div class="list">
	<table>
	    <thead>
		<tr>
		<tr>
		    <th>Aktion</th>
		    <th>Ausgelöst am</th>
                    <th></th>
		</tr>
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
		    <td>' . $this->getDate($val->getLog_timestamp()) . " - " . $this->getTime($val->getLog_timestamp()) . '</td>
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


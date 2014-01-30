<?php

class HomeView extends View {

    public function display() {
	echo <<<HTML
        <div class="content-box">
    <h1>Veranstaltungen</h1>
        <div class="button-box">
	<a href="event" class="button blue">Alle anzeigen</a>
	<a href="event/new" class="button green">Erstellen</a>
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
	    echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$object->getEvt_name()}</a></td>";
	    echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$this->getDate($object->getEvt_datetime())}</a></td>";
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
	<a href="winner" class="button blue">Alle anzeigen</a>
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
		echo "<td><a href=\"/winner/{$object->getWin_id()}-\">{$object->getUser()->getUse_firstname()} {$object->getUser()->getUse_lastname()}</a></td>";
		echo "<td><a href=\"/winner/{$object->getWin_id()}-\">{$this->getDate($object->getWin_cre_dat())} - {$this->getTime($object->getWin_cre_dat())}</a></td>";
		echo '</tr>';
        }

        echo <<<HTML

	    </tbody>
	</table>
    </div>
</div>

<div class="content-box">
    <h1>Spieler</h1>
    <div class="button-box">
	<a href="/user" class="button blue">Alle anzeigen</a>
	<a href="/user/new" class="button green">Erstellen</a>
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
        <td><a href = "/user/{$user->getUse_id()}">{$user->getUse_firstname()} {$user->getUse_lastname()}</a></td>
        <td><a href = "/user/{$user->getUse_id()}">{$this->getDate($user->getUse_cre_dat()) }</a></td>
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
	<a href="/card" class="button blue">Alle anzeigen</a>
	<a href="/card/new" class="button green">Erstellen</a>
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

	foreach ($this->vars['cardList'] as $object) {
	    echo '<tr>';
	    echo "<td><a href=\"/card/{$object->getCar_id()}-Cardnr_{$object->getCar_serialnumber()}\">{$object->getCar_serialnumber()}</a></td>";
	    echo "<td><a href=\"/card/{$object->getCar_id()}-Cardnr_{$object->getCar_serialnumber()}\">{$object->getCar_row1_nr1()}, {$object->getCar_row1_nr2()}, {$object->getCar_row1_nr3()}, {$object->getCar_row1_nr4()}, {$object->getCar_row1_nr5()}</a></td>";
	    echo "<td><a href=\"/card/{$object->getCar_id()}-Cardnr_{$object->getCar_serialnumber()}\">{$object->getCar_row2_nr1()}, {$object->getCar_row2_nr2()}, {$object->getCar_row2_nr3()}, {$object->getCar_row2_nr4()}, {$object->getCar_row2_nr5()}</a></td>";
	    echo "<td><a href=\"/card/{$object->getCar_id()}-Cardnr_{$object->getCar_serialnumber()}\">{$object->getCar_row3_nr1()}, {$object->getCar_row3_nr2()}, {$object->getCar_row3_nr3()}, {$object->getCar_row3_nr4()}, {$object->getCar_row3_nr5()}</a></td>";
	    echo "<td><a href=\"/card/{$object->getCar_id()}-Cardnr_{$object->getCar_serialnumber()}\">{$this->getDate($object->getCar_cre_dat())}</a></td>";
	    echo '</tr>';
	}

	echo <<<HTML
	    </tbody>
	</table>
    </div>
</div>

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

            if ($val->getLog_level() <= Log::ERROR) {
                $icon = '<img src="/images/icons/exclamation.png">';
            }

            echo'<tr>
		    <td><a href="/log/' . $val->getLog_id() . '">' . $val->getLog_action() . '</a></td>
		    <td><a href="/log/' . $val->getLog_id() . '">' . $this->getDate($val->getLog_timestamp()) ." - ".$this->getTime($val->getLog_timestamp()). '</a></td>
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


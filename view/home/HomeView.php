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
            echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$this->getDateTime($object->getEvt_datetime())}</a></td>";
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
		    <th>Gewinndatum</th>  
		</tr>
	    </thead>
	    <tbody>
HTML;

        foreach ($this->vars['winnerList'] as $object) {
            echo '<tr>';

            echo "<td><a href=\"/winner/{$object->getWin_id()}-{$object->getWin_firstname()}{$object->getWin_lastname()}\">{$object->getWin_firstname()} {$object->getWin_lastname()}</a></td>";
            echo "<td><a href=\"/winner/{$object->getWin_id()}-{$object->getWin_firstname()}{$object->getWin_lastname()}\">{$this->getDate($object->getWin_cre_dat())}</a></td>";
            echo '</tr>';
        }

        echo <<<HTML
	    </tbody>
	</table>
    </div>
</div>

<div class="content-box">
    <h1>Neuste Spieler</h1>
    <div class="button-box">
	<a href="/user" class="button blue">Alle anzeigen</a>
	<a href="/user/new" class="button green">Erstellen</a>
    </div>
    <div class="list">
	<table>
	    <thead>
		<tr>
		    <th>Name</th>
		    <th>Erstellt</th>
		</tr>
	    </thead>
	    <tbody>
HTML;

        foreach ($this->vars['userlist'] as $user) {
            echo <<<OUT
        <tr>
        <td><a href = "/user/{$user->getUse_id()}">{$user->getUse_firstname()} {$user->getUse_lastname()}</a></td>
        <td><a href = "/user/{$user->getUse_id()}">{$user->getUse_cre_dat()}</a></td>
        </tr>
OUT;
        }
        echo <<<HTML
	    </tbody>
	</table>
    </div>
</div>


<div class="content-box">
    <h1>Neuste Lottokarten</h1>
    <div class="button-box">
	<a href="card" class="button blue">Alle anzeigen</a>
	<a href="new" class="button green">Erstellen</a>
    </div>
    <div class="list">
	<table>
	    <thead>
		<tr>
		    <th>Kartennr.</th>
		    <th>Reihe 1</th>
		    <th>Reihe 2</th>
		    <th>Reihe 3</th>
		    <th>Erstellt</th>
		</tr>
	    </thead>
	    <tbody>
		<tr>
		    <td><a href="#"></a></td>
		    <td><a href="#"></a></td>
		    <td><a href="#"></a></td>
		    <td><a href="#"></a></td>
		    <td><a href="#"></a></td>
		</tr>
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
		    <th>Erstellt</th>
		</tr>
	    </thead>
	    <tbody>
		<tr>
		    <td><a href="#"></a></td>
		    <td><a href="#"></a></td>
		</tr>
	    </tbody>
	</table>
    </div>
</div>
        
HTML;
    }

}


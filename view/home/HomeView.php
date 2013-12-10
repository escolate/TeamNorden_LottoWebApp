<?php

class HomeView extends View {
    public function __construct() {
	
    }
    public function display() {
	echo <<<DASHBOARD
        <div class="content-box">
    <h1>Neuste Veranstaltungen</h1>
    <div class="list">
	<table>
	    <thead>
		<tr>
		    <th>Name</th>
		    <th>Veranstaltungsdatum</th>
		    <th>Erstellt</th>
		    <th>Geändert</th>
		</tr>
	    </thead>
	    <tbody>
DASHBOARD;
	foreach ($this->vars as $value) {
	    foreach ($value as $object) {
		echo '<tr>';
		echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$object->getEvt_name()}</a></td>";
		echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$object->getEvt_datetime()}</a></td>";
		echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$object->getEvt_cre_dat()}, {$object->getEvt_cre_id()}</a></td>";
		echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$object->getEvt_mod_date()}, {$object->getEvt_mod_id()}</a></td>";
		echo '</tr>';
	    }
	}
	echo <<<DASHBOARD
	    </tbody>
	</table>
    </div>
    <div class="dashboard-links">
	<a href="event" class="button blue">Alle anzeigen</a>
	<a href="event/new" class="button green">Erstellen</a>
    </div>

</div>


<div class="content-box">
    <h1>Neuste Gewinner</h1>
    <div class="list">
	<table>
	    <thead>
		<tr>
		    <th>Name</th>
		    <th>Gewonnen</th>
		</tr>
	    </thead>
	    <tbody>
		<tr>
		    <td><a href="#">Marc Jenzer</a></td>
		    <td><a href="#">31.10.2013</a></td>
		</tr>
		<tr>
		    <td><a href="#">Marc Jenzer</a></td>
		    <td><a href="#">31.10.2013</a></td>
		</tr>
		<tr>
		    <td><a href="#">Marc Jenzer</a></td>
		    <td><a href="#">31.10.2013</a></td>
		</tr>
		<tr>
		    <td><a href="#">Marc Jenzer</a></td>
		    <td><a href="#">31.10.2013</a></td>
		</tr>
		<tr>
		    <td><a href="#">Marc Jenzer</a></td>
		    <td><a href="#">31.10.2013</a></td>
		</tr>
	    </tbody>
	</table>
    </div>
    <div class="dashboard-links">
	<a href="index.php?page=list_index" class="button blue">Alle anzeigen</a>
	<a href="index.php?page=create" class="button green">Erstellen</a>
    </div>
</div>
<div class="content-box">
    <h1>Neuste Spieler</h1>
    <div class="list">
	<table>
	    <thead>
		<tr>
		    <th>Name</th>
		    <th>Erstellt</th>
		</tr>
	    </thead>
	    <tbody>
		<tr>
		    <td><a href="#">Florian Wiesner</a></td>
		    <td><a href="#">31.10.2013</a></td>
		</tr>
		<tr>
		    <td><a href="#">Florian Wiesner</a></td>
		    <td><a href="#">31.10.2013</a></td>
		</tr>
		<tr>
		    <td><a href="#">Florian Wiesner</a></td>
		    <td><a href="#">31.10.2013</a></td>
		</tr>
		<tr>
		    <td><a href="#">Florian Wiesner</a></td>
		    <td><a href="#">31.10.2013</a></td>
		</tr>
		<tr>
		    <td><a href="#">Florian Wiesner</a></td>
		    <td><a href="#">31.10.2013</a></td>
		</tr>
	    </tbody>
	</table>
    </div>
    <div class="dashboard-links">
	<a href="index.php?page=list_index" class="button blue">Alle anzeigen</a>
	<a href="index.php?page=create" class="button green">Erstellen</a>
    </div>
</div>
<div class="content-box">
    <h1>Neuste Lottokarten</h1>
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
		    <td><a href="#">34456</a></td>
		    <td><a href="#">01,10,45,87,90</a></td>
		    <td><a href="#">01,10,45,87,90</a></td>
		    <td><a href="#">01,10,45,87,90</a></td>
		    <td><a href="#">31.10.2013</a></td>
		</tr>
	    </tbody>
	</table>
    </div>
    <div class="dashboard-links">
	<a href="card" class="button blue">Alle anzeigen</a>
	<a href="new" class="button green">Erstellen</a>
    </div>
</div>
<div class="content-box">
    <h1>Verlauf</h1>
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
		    <td><a href="#">E-Mail an zakaria@agoulif.com versendet.</a></td>
		    <td><a href="#">31.10.2013</a></td>
		</tr>
		<tr>
		    <td><a href="#">Lottokarte 34503 erstellt.</a></td>
		    <td><a href="#">31.10.2013</a></td>
		</tr>
		<tr>
		    <td><a href="#">Spieler Marc Jenzer erstellt.</a></td>
		    <td><a href="#">31.10.2013</a></td>
		</tr>
		<tr>
		    <td><a href="#">Spieler Tobias Bernet erstellt.</a></td>
		    <td><a href="#">31.10.2013</a></td>
		</tr>
		<tr>
		    <td><a href="#">Event Biergarten und Lotto erstellt.</a></td>
		    <td><a href="#">31.10.2013</a></td>
		</tr>
	    </tbody>
	</table>
    </div>
    <div class="dashboard-links">
	<a href="index.php?page=list_index" class="button blue">Alle anzeigen</a>
    </div>
</div>
        
DASHBOARD;
    }

}


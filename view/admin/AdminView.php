<?php

class AdminView extends View{
    public function display() {
echo <<<ADMIN
<div class="content-box">
    <h1>zakaria.agoulif@gmail.com</h1>
        <form class="forms">
	<label for="event-name" class="wider">E-Mail</label>
	<input type="text" id="event-name" value="zakaria.agoulif">
	<br>
	<label for="event-location" class="wider">Adresse</label>
	<input type="text" id="event-location" value="Rheinstr. 129">
	<br>
	<label for="event-city" class="wider">Kanton</label>
	<input type="text" id="event-city" value="Zürich">
	<br>
	<label for="event-zip" class="wider">Postleitzahl</label>
	<input type="text" id="event-zip" value="8003">
	<br>
	<label for="event-date" class="wider">Datum</label>
	<input type="date" id="event-date" value="31.10.2003">
	<br>
	<input type="submit" value="Speichern">
    </form>
</div>

<div class="content-box">
    <h1>Administratoren</h1>
    <div class="list">
	<form name="events">
	    <table>
		<thead>
		    <tr>
		    <th></th>
		    <th>Name</th>
		    <th>Erstellt</th>
		    <th>Geändert</th>
		    </tr>
		</thead>
		<tfoot>
		    <tr>
			<td><input type="checkbox"></td>
			<td>Alle auswählen</td>
			<td></td>
			<td></td>
		    </tr>
		</tfoot>
		<tbody>
ADMIN;
var_dump($this->vars['adminList']);
	    foreach ($this->vars['adminList'] as $object) {
		echo '<tr>';
		echo '<td><input type="checkbox"></td>';
		echo "<td><a href=\"/event/{$object->getUse_id()}-{$object->getUse_firstname()}_{$object->getUse_lastname()}\">{$object->getUse_firstname()} {$object->getUse_lastname()}</a></td>";
		echo "<td><a href=\"/event/{$object->getUse_id()}-{$object->getUse_firstname()}_{$object->getUse_lastname()}\">{$object->getUse_mod_dat()}, {$object->getUse_mod_id()}</a></td>";
		echo "<td><a href=\"/event/{$object->getUse_id()}-{$object->getUse_firstname()}_{$object->getUse_lastname()}\">{$object->getUse_cre_dat()}, {$object->getUse_cre_id()}</a></td>";
		echo '</tr>';
	    }
	   
	echo <<<ADMIN
		</tbody>
	    </table>
	    <select name="events-action">
		<option value="action">[Aktion]</option>
		<option value="delete">Löschen</option>
	    </select>
	    <input type="submit" value="Ausführen">
	</form>
	<div class="pages">
	    Seite
	    <form>
		<select name="events-action">
		    <option value="delete">1</option>
		    <option value="delete">2</option>
		    <option value="delete">3</option>
		    <option value="delete">4</option>
		    <option value="action" selected>5</option>
		    <option value="delete">6</option>
		    <option value="delete">7</option>
		</select>
	    </form>
	    von 7
	</div>
    </div>
</div>
ADMIN;
    }
}

?>

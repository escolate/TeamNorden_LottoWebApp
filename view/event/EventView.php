<?php

class EventView extends View {

    public function display() {
	echo <<<EVENT
<div class="content-box">
    <h1>Veranstaltungen</h1>
    <div class="list">
	<form name="events">
	    <table>
		<thead>
		    <tr>
		    <th></th>
		    <th>Name</th>
		    <th>Veranstaltungsdatum</th>
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
			<td></td>
		    </tr>
		</tfoot>
		<tbody>
EVENT;
	foreach ($this->vars as $value) {
	    foreach ($value as $object) {
		echo '<tr>';
		echo '<td><input type="checkbox"></td>';
		echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$object->getEvt_name()}</a></td>";
		echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$object->getEvt_datetime()}</a></td>";
		echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$object->getEvt_cre_dat()}, {$object->getEvt_cre_id()}</a></td>";
		echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$object->getEvt_mod_date()}, {$object->getEvt_mod_id()}</a></td>";
		echo '</tr>';
	    }
	}
	echo <<<EVENT
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
EVENT;
    }

}


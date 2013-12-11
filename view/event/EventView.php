<?php

class EventView extends View {
    public function display() {
	echo <<<HTML
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
		    <th>Ersteller</th>
		    <th>Erstellungsdatum</th>
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
HTML;
	
	    foreach ($this->vars['eventList'] as $object) {
		echo '<tr>';
		echo '<td><input type="checkbox"></td>';
		echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$object->getEvt_name()}</a></td>";
		echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$this->getDate($object->getEvt_datetime())}</a></td>";
		echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$object->getUse_cre_firstname()} {$object->getUse_cre_lastname()}</a></td>";
		echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$this->getDateTime($object->getEvt_cre_dat())}</a></td>";
		echo '</tr>';
	    }
	
	echo <<<HTML
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
HTML;
    }

}


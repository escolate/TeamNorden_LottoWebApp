<?php

class EventView extends View {

    public function display() {
	echo <<<HTML
<div class="content-box">
    <h1>Veranstaltungen</h1>
    <div class="button-box">
	<a href="/event/new" class="button green">Erstellen</a>
    </div>
    <div class="list">
	<form action="/event/create" method="post">
	    <table>
		<thead>
		    <tr>
		    <th></th>
		    <th>Name</th>
		    <th>Veranstaltungsdatum</th>  
		    <th>Ersteller</th>
		    <th>Erstellt am</th>
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
	$i = 0;
	foreach ($this->vars['eventList'] as $object) {
	    echo '<tr>';
	    echo '<td><input type="checkbox" name="eventIds[]" value="' . $object->getEvt_id() . '"></td>';
	    echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$object->getEvt_name()}</a></td>";
	    echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$this->getDate($object->getEvt_datetime())}</a></td>";
	    echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\"> {$this->vars['eventCreatorList'][$i]->getUse_firstname()} {$this->vars['eventCreatorList'][$i]->getUse_lastname()}</a></td>";
	    echo "<td><a href=\"/event/{$object->getEvt_id()}-{$object->getEvt_name()}\">{$this->getDate($object->getEvt_cre_dat())} - {$this->getTime($object->getEvt_cre_dat())}</a></td>";
	    echo '</tr>';
	    $i++;
	}

	echo <<<HTML
		</tbody>
	    </table>
	    <select name="submit">
		<option>[Aktion]</option>"
		<option value="deleteEvent">Löschen</option>
	    </select>
	    <button>Ausführen</button>
	</form>
    </div>
</div>
HTML;
    }

}


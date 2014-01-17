<?php

class EventShowView extends View {

    private $seriesCounter;
    private $drawCounter;

    public function display() {
	// Counts the series
	$this->seriesCounter = count($this->vars['seriesList']);
	// Counts the numbers
	$this->drawCounter = count($this->vars['numberList']);

	echo <<<HTML
<div class="content-box">
    <h1>Veranstaltung</h1>
    <div class="button-box">
	<a href="#" class="button grey">Bearbeiten</a>
    </div>
    <div class="event-card">
	<table class="show-table">
	    <tbody>
		<tr>
		<td>Name:</td>
		<td>{$this->vars['event']->getEvt_name()}</td>
		</tr>
		<tr>
		<td>Strasse:</td>
		<td>{$this->vars['event']->getEvt_location()}</td>
		</tr>
		<tr>
		<td>Ort:</td>
		<td>{$this->vars['event']->getEvt_city()}</td>
		</tr>
		<tr>
		<td>PLZ:</td>
		<td>{$this->vars['event']->getEvt_zip()}</td>
		</tr>
		<tr>
		<td>Veranstaltungsdatum:</td>
		<td>{$this->getDateTime($this->vars['event']->getEvt_datetime())}</td>
		</tr>
	    </tbody>
	</table>
    </div>
	    
    <div class="event-card">
	<table class="show-table">
	    <tbody>
		<tr>
		<td>Erstellt:</td>
		<td>{$this->vars['eventCre']->getUse_firstname()} {$this->vars['eventCre']->getUse_firstname()}</td>
		</tr>
		<td>Zuletzt geändert:</td>
		<td>{$this->vars['eventMod']->getUse_firstname()} {$this->vars['eventMod']->getUse_firstname()}</td>
		</tr>
	    </tbody>
	</table>
    </div>
</div>
    
<div class="content-box">
    <h1>Spieler</h1>
    <div class="button-box">
	<a href="/event/add/{$this->vars['event']->getEvt_id()}" class="button yellow">Hinzufügen</a>
    </div>	    
<div class="list">
	<form action="/event/add" method="POST">
	<input type="hidden" value="removeUser" name="form">
	<input type="hidden" value="{$this->vars['event']->getEvt_id()}" name="eventId">
	    <table>
		<thead>
		    <tr>
		    <th></th>
		    <th>Name</th>
		    </tr>
		</thead>
		<tfoot>
		    <tr>
			<td><input type="checkbox"></td>
			<td>Alle auswählen</td>
		    </tr>
		</tfoot>
		<tbody>
HTML;
	if ($this->vars['eventmemberNameList']) {
	    foreach ($this->vars['eventmemberNameList'] as $object) {
		echo '<tr>';
		echo '<td><a href="/user/' . $object->getUse_id() . '">
		    <input type="checkbox" name="userIds[]" value="' . $object->getUse_id() . '">
		      </td>';
		echo "<td>{$object->getUse_firstname()} {$object->getUse_lastname()} </a></td>";
		echo '</tr>';
	    }
	}

	echo <<<HTML
		</tbody>
	    </table>
	    <select name="events-action">
		<option value="action">[Aktion]</option>
		<option value="remove">Entfernen</option>
	    </select>
	    <input type="submit" value="Ausführen">
	</form>
    </div>

    </div>
    

<div class="content-box">
HTML;
	$sTitleCounter = $this->seriesCounter;
	++$sTitleCounter;
	echo "<h1>Serie $sTitleCounter</h1>";
	if ($this->vars['newestSeries']) {
	    $newestSerId = $this->vars['newestSeries']->getSer_id();
	}else{
	    $newestSerId = "";
	}
	echo <<<HTML
    <form action="" method="POST">
	<input type="hidden" name="form" value="closeSeries">
	<input type="hidden" name="eventId" value="{$this->vars['event']->getEvt_id()}">
	<input type="submit" value="Serie $sTitleCounter abschliessen" class="button red">
    </form>
    <form action="/event/create" method="POST">
	<fieldset id="save-number">
	    <legend>Zahl ziehen!</legend>
	    <input type="hidden" name="form" value="saveNumber">
	    <input type="hidden" value="{$this->vars['event']->getEvt_id()}" name="eventId">
	    <input type="hidden" value="{$newestSerId}" name="seriesId">
	    <input type="text" placeholder="Zahl" autocomplete="off" name="number">
	    <input type="submit" value="Ziehen!">
	</fieldset>
    </form>
    <div class="list">
	<form action="/event/create" method="POST">
	<input type="hidden" name="form" value="number">
	<input type="hidden" value="{$newestSerId}" name="seriesId">
	    <table>
		<thead>
		    <tr>
			<th></th>
			<th>Ziehung</th>
			<th>Gezogene Zahl</th>
		    </tr>
		</thead>
		<tfoot>
		    <tr>
			<td><input type="checkbox"></td>
			<td  id="events">Alle auswählen</td>
			<td></td>
		    </tr>
		</tfoot>
		<tbody>
HTML;
	$drawCounter = $this->drawCounter;
	if ($this->vars['numberList']) {
	    foreach ($this->vars['numberList'] as $object) {
		echo '<tr>';
		echo '<td><input type="checkbox" name="numberIds[]" value="' . $object->getNum_id() . '"></td>';
		echo "<td>Ziehung $drawCounter</td>";
		echo "<td>{$object->getNum_num()}</td>";
		echo '</tr>';
		$drawCounter--;
	    }
	} else {
	    echo '<tr>';
	    echo '<td></td>';
	    echo "<td>leer</td>";
	    echo "<td>leer</td>";
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
    </div>
</div>



HTML;
	if (!is_null($this->vars['seriesList']) AND count($this->vars['seriesList']) != 1) {
	    echo <<<HTML
<div class="content-box">
    <h1>Gespielte Serien</h1>
    <div class="list">
	<form name="events">
			    <table>
		<thead>
		    <tr>
			<th></th>
			<th>Seriename</th>
		    </tr>
		</thead>
		<tfoot>
		    <tr>
			<td><input type="checkbox"></td>
			<td>Alle auswählen</td>
		    </tr>
		</tfoot>
		<tbody>
HTML;

	    $seriesCounter = $this->seriesCounter;
	    foreach ($this->vars['seriesList'] as $object) {
		echo '<tr>';
		echo '<td><input type="checkbox"></td>';
		echo "<td><a href=\"/series/{$object->getSer_id()}-Serie $seriesCounter ({$this->vars['event']->getEvt_name()})\">Serie $seriesCounter</a></td>";
		echo '</tr>';
		$seriesCounter--;
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
	    </div>
</div>
HTML;
	}

	echo <<<HTML
		

HTML;
    }

}


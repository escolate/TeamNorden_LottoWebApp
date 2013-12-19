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
		<td>Ort:</td>
		<td>{$this->vars['event']->getEvt_location()}</td>
		</tr>
		<tr>
		<td>Kanton:</td>
		<td>{$this->vars['event']->getEvt_city()}</td>
		</tr>
		<tr>
		<td>Postleitzahl:</td>
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
	<a href="#" class="button yellow">Hinzufügen</a>
    </div>	    
<div class="list">
	<form name="events">
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
		echo '<td><input type="checkbox"></td>';
		echo "<td><a href=\"/user/{$object->getUse_id()}\">{$object->getUse_firstname()} {$object->getUse_lastname()} ({$object->getUse_status()})</a></td>";
		echo '</tr>';
	    }
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
    

<div class="content-box">
HTML;
	$sTitleCounter = $this->seriesCounter;
	++$sTitleCounter;
	echo "<h1>Serie $sTitleCounter</h1>";

	echo <<<HTML
    <div class="button-box">
	<a href="#" class="button red">Serie $sTitleCounter abschliessen</a>
    </div>
    <form >
	<fieldset id="save-number">
	    <legend>Zahl ziehen!</legend>
	    <input type="text" placeholder="Zahl" autocomplete="off">
	    <input type="submit" value="Ziehen!">
	</fieldset>
    </form>
    <div class="list">
	<form name="events">
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
		echo '<td><input type="checkbox"></td>';
		echo "<td><a href=\"/number/{}\">Ziehung $drawCounter</a></td>";
		echo "<td><a href=\"/number/{}\">{$object->getNum_num()}</a></td>";
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
	if (!is_null($this->vars['seriesList'])) {
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

	echo <<<HTML
		

HTML;
    }

}


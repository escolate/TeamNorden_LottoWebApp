<?php

class EventShowView extends View {

    public function display() {
	echo <<<HTML
<div class="content-box">
    <h1>Veranstaltung</h1>
    <div class="button-box">
	<a href="#" class="button grey">Bearbeiten</a>
	<a href="#" class="button red">Veranstaltung stoppen</a>
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
		<td>{$this->getDateTime($this->vars['event']->getEvt_cre_dat())}, {$this->vars['event']->getUse_cre_firstname()} {$this->vars['event']->getUse_cre_lastname()} </td>
		</tr>
		<td>Zuletzt geändert:</td>
		<td>{$this->getDateTime($this->vars['event']->getEvt_mod_date())}, {$this->vars['event']->getUse_mod_firstname()} {$this->vars['event']->getUse_mod_lastname()}</td>
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
	if ($this->vars['eventmemberList']) {
	    foreach ($this->vars['eventmemberList'] as $object) {
		echo '<tr>';
		echo '<td><input type="checkbox"></td>';
		echo "<td><a href=\"/event/{}\">{$object->getUse_firstname()} {$object->getUse_lastname()}</a></td>";
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
    <h1>Serie 7</h1>
    <div class="button-box">
	<a href="#" class="button red">Serie beenden</a>
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
		    <tr>
			<td><input type="checkbox"></td>
			<td><a href="#">Ziehung 22</a></td>
			<td><a href="#">89</a></td>
		    </tr>
		    <tr>
			<td><input type="checkbox"></td>
			<td><a href="#">Ziehung 21</a></td>
			<td><a href="#">45</a></td>
		    </tr>
		    <tr>
			<td><input type="checkbox"></td>
			<td><a href="#">Ziehung 20</a></td>
			<td><a href="#">23</a></td>
		    </tr>
		    <tr>
			<td><input type="checkbox"></td>
			<td><a href="#">Ziehung 19</a></td>
			<td><a href="#">1</a></td>
		    </tr>
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
    <h1>Gespielte Serien</h1>
    <div class="list">
	<form name="events">
	    <table>
		<thead>
		    <tr>
			<th></th>
			<th>Ziehung</th>
		    </tr>
		</thead>
		<tfoot>
		    <tr>
			<td><input type="checkbox"></td>
			<td>Alle auswählen</td>
		    </tr>
		</tfoot>
		<tbody>
		    <tr>
			<td><input type="checkbox"></td>
			<td><a href="#">Serie 5</a></td>
		    </tr>
		    <tr>
			<td><input type="checkbox"></td>
			<td><a href="#">Serie 4</a></td>
		    </tr>
		    <tr>
			<td><input type="checkbox"></td>
			<td><a href="#">Serie 3</a></td>
		    </tr>
		    <tr>
			<td><input type="checkbox"></td>
			<td><a href="#">Serie 2</a></td>
		    </tr>
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


<?php

class EventShowView extends View {

    private $seriesCounter;
    private $drawCounter;

    /**
     *
     * @var array
     */
    private $emcs;

    public function display() {
	// Counts the series
	$this->seriesCounter = count($this->vars['seriesList']);
	// Counts the numbers
	$this->drawCounter = count($this->vars['numberList']);

	$this->emcs = $this->vars['emcs'];

	if (isset($this->vars['winner'])) {
	    /* @var $winner \Winner */
	    foreach ($this->vars['winner'] as $winner) {
		echo '<div class="win">
                        <form method="post" action="/winner">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="ser_id" value="'.$winner->getSeries()->getSer_id().'">
                            <input type="hidden" name="row_id" value="'.$winner->getRow_id().'">
                            <input type="hidden" name="use_id" value="'.$winner->getUser()->getUse_id().'">
                            <input type="hidden" name="win_id" value="'.$winner->getWin_id().'">
                        <div>Gewonnen: <b>'.$winner->getUser()->getUse_firstname().' '.$winner->getUser()->getUse_lastname().'</b>, Karte: <b>'.$winner->getCard()->getCar_serialnumber().'</b></div>
                        <div><input type="submit" value="überprüfen"></div>
                        </form>
                    </div>';
	    }
	}
	echo <<<HTML
<div class="content-box">
    <h1>Veranstaltung</h1>
    <div class="button-box">
	<a href="/event/edit/{$this->vars['event']->getEvt_id()}" class="button grey">Bearbeiten</a>
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
		<td>{$this->getDate($this->vars['event']->getEvt_datetime())}</td>
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
	<a href="/eventmemberscard/" class="button yellow">Jetzt zuweisen</a>
    </div>
<div class="list">
	<form action="/event/add/{$this->vars['event']->getEvt_id()}" method="POST">
HTML;
	if (count($this->emcs)) {
	    echo <<<HTML
	    <table>
		<thead>
		    <tr>
		    <th>Name</th>
		    <th> Spielkarte </th>
		    </tr>
		</thead>
		<tbody>
HTML;

	    /* @var $emc \Eventmembercard */
	    foreach ($this->emcs as $emc) {
		echo '<tr>';
		echo "<td><a href=\"/usercard/{$emc->getUser()->getUse_id()}\">{$emc->getUser()->getUse_firstname()} {$emc->getUser()->getUse_lastname()} </a></td>";
		echo "<td><a href=\"/usercard/{$emc->getUser()->getUse_id()}\">{$emc->getCard()->getCar_serialnumber()}</a></td>";
		echo '</tr>';
	    }


	    echo "</tbody>
	    </table>";
	}else{
	    echo "Weisen Sie den Spielern ihre Karten für Event <b>".$this->vars['event']->getEvt_name()."</b> zu!";
	}
	echo <<<HTML
	</form>
    </div>
</div>

HTML;
	if ($this->emcs) {


	    echo '<div class="content-box">';

	    $sTitleCounter = $this->seriesCounter;
	    if (!$sTitleCounter) {
		$sTitleCounter = 1;
	    }
	    echo "<h1>Serie $sTitleCounter</h1>";
	    $newestSerId = $this->vars['newestSeries']->getSer_id();
	    echo <<<HTML
   
    <form style="text-align: center;" action="/event/{$this->vars['event']->getEvt_id()}" method="POST">
	<button name="submit" value="closeSeries" class="button red"> Serie $sTitleCounter abschliessen </button>
    </form>
    
    <form action="/event/{$this->vars['event']->getEvt_id()}" method="POST">
	<fieldset id="save-number">
	    <legend>Zahl ziehen!</legend>
	    <input type="hidden" value="{$newestSerId}" name="seriesId">
	    <input type="text" placeholder="Zahl" autocomplete="off" name="number">
	    <button name="submit" name="submit" value="saveNumber"> Ziehen! </button>
	</fieldset>
    </form>
    
    <div class="list">
	<form action="/event/{$this->vars['event']->getEvt_id()}" method="POST">
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
	    <select name="submit">
		<option>[Aktion]</option>"
		<option value="deleteNumber">Löschen</option>
	    </select>
	    <button> Ausführen </button>
	</form>
    </div>
</div>
HTML;
	}
	if (!is_null($this->vars['seriesList']) AND count($this->vars['seriesList']) != 1) {
	    echo <<<HTML
<div class="content-box">
    <h1>Gespielte Serien</h1>
    <div class="list">
	<form action="/event/{$this->vars['event']->getEvt_id()}" method="POST">
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

	    $seriesCounter = $this->seriesCounter - 1;
	    unset($this->vars['seriesList'][0]);
	    foreach ($this->vars['seriesList'] as $object) {
		echo '<tr>';
		echo "<td><input type=\"checkbox\" name=\"seriesIds[]\" value=\"{$object->getSer_id()}\"></td>";
		echo "<td><input type=\"hidden\" name=\"seriesNames[]\" value=\"$seriesCounter\">Serie $seriesCounter</td>";
		echo '</tr>';
		$seriesCounter--;
	    }

	    echo <<<HTML
		</tbody>
	    </table>
	    <select name="submit">
		<option>[Aktion]</option>"
		<option value="editSeries">Bearbeiten</option>
		<option value="deleteSeries">Löschen</option>
	    </select>
	    <button>Ausführen</button>
	</form>
	    </div>
</div>
HTML;
	}

	echo <<<HTML
		

HTML;
    }

}


<?php

class EventInitView extends View {

    private $notification = "";
    private $title = "erstellen";
    private $form = "createEvent";
    public function display() {
	if($this->vars['event']->getEvt_id()){
	    $this->title = " bearbeiten";
	    $this->form = "editEvent";
	}
	$eventDate = $this->getDate($this->vars['event']->getEvt_datetime());
	$gebdat = $this->getBirthDateInput($eventDate, true);
	echo <<<HTML
		<div class="content-box">
		    <h1>Veranstaltung {$this->title}</h1>
		    {$this->notification}
		    <div class="list">
		    <form id="userdata" action="/event/new/{$this->vars['event']->getEvt_id()}" method="POST">
			<fieldset>
			    <legend>Veranstaltung</legend>
			    <input type="text" id="evt_name" placeholder="Name der Veranstaltung" name="evt_name" value="{$this->vars['event']->getEvt_name()}"/>
			</fieldset>
			
			<fieldset>
			    <legend>Datum</legend>
			    {$gebdat}
			</fieldset>
			
			<fieldset>
			    <legend>Details</legend>
			    <input type="text" id="evt_location" placeholder="Adresse" name="evt_location" value="{$this->vars['event']->getEvt_location()}"/>
			    <input type="text" id="evt_city" placeholder="Ort" name="evt_city" value="{$this->vars['event']->getEvt_city()}"/>
			    <input type="text" id="evt_zip" placeholder="PLZ" name="evt_zip" value="{$this->vars['event']->getEvt_zip()}"/>
			</fieldset>
			<input type="hidden" name="evt_id" value="{$this->vars['event']->getEvt_id()}">
			<button name="submit" value="{$this->form}">Speichern</button> 
			<button name="submit" value="backToEvent">Abbrechen</button>
		    </form>
		</div>
	    </div>
HTML;
    }

}

?>

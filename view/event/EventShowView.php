<?php

class EventShowView extends View {
   public function display() {
	echo <<<EVENTDETAIL
   <div class="content-box">
    <h1>Veranstaltung</h1>
    <div class="event-card">
	<div class="column1">
	    <p>Name:</p>
	    <p>Ort:</p>
	    <p>Kanton:</p>
	    <p>Postleitzahl:</p>
	    <p>Veranstaltungsdatum:</p>
	</div> 
	<div class="column2">
	    <p>{$this->vars['event'][0]->getEvt_name()}</p>
	    <p>{$this->vars['event'][0]->getEvt_location()}</p>
	    <p>{$this->vars['event'][0]->getEvt_city()}</p>
	    <p>{$this->vars['event'][0]->getEvt_zip()}</p>
	    <p>{$this->getDateTime($this->vars['event'][0]->getEvt_datetime())}</p>	
</div> 
    </div>
    <form>
	<input type="submit" value="Bearbeiten">
    </form>
</div>
EVENTDETAIL;
    }


}


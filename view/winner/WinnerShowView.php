<?php

class WinnerShowView extends View {

    public function display() {

	echo <<<HTML
        <div class="content-box">
    <h1>Gewinn</h1>
    <div class="event-card">
    <table class="show-table">
	    <tbody>
		<tr>
		<td>Gewinner:</td>
		<td>{$this->vars['winner']->getUser()->getUse_firstname()} {$this->vars['winner']->getUser()->getUse_lastname()}</td>
		</tr>
		<tr>
		<td>Event:</td>
		<td>{$this->vars['winner']->getEvent()->getEvt_name()}</td>
		</tr>
		<tr>
		<td>Serie:</td>
		<td>{$this->vars['winner']->getSeries()->getSer_name()}</td>
		</tr>
		<tr>
		<td>Datum und Zeit:</td>
		<td>{$this->getDateTime($this->vars['winner']->getWin_cre_dat())}</td>
		</tr>
		<tr>
		<td>Gezogene Zahlen:</td>
		<td>
		<div class="ball" >1</div> <div class="ball" >3</div> <div class="ball" >14</div>
		<div class="ball" >45</div> <div class="ball winning" >65</div> <div class="ball" >14</div>
		<br>
		<div class="ball winning" >89</div> <div class="ball" >41</div> <div class="ball" >14</div>
		<div class="ball" >44</div> <div class="ball" >39</div> <div class="ball" >14</div>
		<br>
		<div class="ball" >34</div> <div class="ball winning" >42</div> <div class="ball" >14</div>
		<div class="ball" >78</div> <div class="ball" >3</div> <div class="ball" >14</div>
		<br>
		<div class="ball winning" >2</div> <div class="ball" >76</div> <div class="ball" >14</div>
		<div class="ball" >4</div> <div class="ball" >5</div> <div class="ball" >14</div>
		<br>
		<div class="ball" >13</div> <div class="ball winning" >56</div> <div class="ball" >14</div>
		</td>
		</tr>
	    </tbody>
	</table>

	<div>

	</div>
    </div>

    <div class="lotto-card">
	<div class="lotto-number">
	    <span>Nr.</span>
	    <span>998789</span>
	</div>
	<div class="lotto-row">
	    <span>Reihe 1</span>
	    <span class="winning">2</span>
	    <span class="winning">42</span>
	    <span class="winning">56</span>
	    <span class="winning">65</span>
	    <span class="winning">89</span>
	</div>
	<div class="lotto-row">
	    <span>Reihe 2</span>
	    <span>12</span>
	    <span>26</span>
	    <span>82</span>
	    <span>89</span>
	    <span>90</span>
	</div>
	<div class="lotto-row">
	    <span>Reihe 3</span>
	    <span>1</span>
	    <span>4</span>
	    <span>9</span>
	    <span>11</span>
	    <span>56</span>
	</div>
    </div>
</div>
HTML;
    }

}

?>

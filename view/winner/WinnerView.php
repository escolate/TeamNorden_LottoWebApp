<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WinnerView
 *
 * @author tscheurer
 */
class WinnerView extends View {

    public function display() {
        echo <<<WINNER
        <div class="content-box">
    <h1>Gewinn</h1>
    <div class="event-card">
	<div class="column1">
	    <p>Gewinner:</p>
	    <p>Event:</p>
	    <p>Serie:</p>
	    <p>Gewonnen am:</p>
	    <p>Gezogene Zahlen:</p>
	</div> 
	<div class="column2">
	    <p>Zakaria Agoulif (Gönner)</p>
	    <p>Biergarten und Lotto</p>
	    <p>7</p>
	    <p>21. Januar 2012, 17:47 Uhr</p>
	</div> 
	<div>
	    <div class="ball" >1</div> <div class="ball" >3</div> <div class="ball" >14</div>
	    <div class="ball" >45</div> <div class="ball winning" >65</div> <div class="ball" >14</div>
	    <div class="ball winning" >89</div> <div class="ball" >41</div> <div class="ball" >14</div>
	    <div class="ball" >44</div> <div class="ball" >39</div> <div class="ball" >14</div>
	    <div class="ball" >34</div> <div class="ball winning" >42</div> <div class="ball" >14</div>
	    <div class="ball" >78</div> <div class="ball" >3</div> <div class="ball" >14</div>
	    <div class="ball winning" >2</div> <div class="ball" >76</div> <div class="ball" >14</div>
	    <div class="ball" >4</div> <div class="ball" >5</div> <div class="ball" >14</div>
	    <div class="ball" >13</div> <div class="ball winning" >56</div> <div class="ball" >14</div>
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
WINNER;
    }

//put your code here
}

?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserCardShowView
 *
 * @author tscheurer
 */
class UserCardShowView extends View {
    public function display() {
    echo <<<OUT
        <div class="content-box">
    <h1>Benutzer #{$this->user->getUse_id()}</h1>
    <div class="button-box">
	<a href="/user/edit/{$this->user->getUse_id()}" class="button grey">Bearbeiten</a>
    </div>
    <div class="event-card">
	<table class="show-table">
	    <tbody>
		<tr>
		<td>Name:</td>
		<td>{$this->user->getUse_firstname()} {$this->user->getUse_lastname()}</td>
		</tr>
		<tr>
		<td>Adresse:</td>
		<td>{$this->user->getUse_address()}</td>
		</tr>
		
	    </tbody>
	</table>
    </div>
OUT;
    }
}

?>

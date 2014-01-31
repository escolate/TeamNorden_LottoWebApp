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

    /**
     *
     * @var User
     */
    private $user;
    
    public function display() {
        $this->user = $this->vars['user'];
        
        echo <<<OUT
        <div class="content-box">
    <h1>Eventkarten</h1>
    <div class="button-box">
        <a href="/benutzerkarten/edit/{$this->user->getUse_id()}" class="button grey">Hinzufügen</a>
    </div>
    <div class="event-card">
        <p><b>User:</b> {$this->user->getUse_firstname()} {$this->user->getUse_lastname()}</p>
        </div>
        <form name="events" method="post">
        <input type="hidden" name="user" value="{$this->user->getUse_id()}">
        <div class="list">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Datum</th>
                        <th>Event</th>
                        <th>Serie</th>
                        <th>Karte</th>
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
OUT;
        /* @var $card \Eventmembercard */
        foreach ($this->vars['usercards'] as $card) {
            echo '<tr>';
            echo '<td><input type="checkbox" name="car_ser[]" value="'.$card->getCard()->getCar_id().','.$card->getSeries()->getSer_id().'"></td>';
            echo '<td>'.$card->getSeries()->getEvent()->getDate().'</td>';
            echo '<td>'.$card->getSeries()->getEvent()->getEvt_name().'</td>';
            echo '<td>'.$card->getSeries()->getSer_id().'</td>';
            echo '<td>'.$card->getCard()->getCar_serialnumber().'</td>';
            echo '</tr>';
        }
        echo <<<OUT
                </tbody>
            </table>
            <select name="action">
                <option value="">[Aktion]</option> 
                <option value="delete">Löschen</option> 
            </select>
            <input type="submit" value="Ausführen"></input>
        </form>
    </div>
OUT;
    }

}

?>

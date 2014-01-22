<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserView
 *
 * @author tscheurer
 */
class UserView extends View {

    /**
     *
     * @var User
     */
    private $user;

    public function display() {
        echo <<<OUT
        <div class="content-box">
    <h1>Spieler</h1>
    <div class="list">
	<form name="events">
	    <table>
		<thead>
		    <tr>
		    <th></th>
		    <th>Name</th>
		    <th>Strasse</th>  
		    <th>Ort</th>
		    <th>Geburtstag</th>
                    <th>Admin</th>
		    </tr>
		</thead>
		<tfoot>
		    <tr>
			<td><input type="checkbox"></td>
			<td>Alle auswählen</td>
			<td></td>
			<td></td>
			<td></td>
                        <td></td>
		    </tr>
		</tfoot>
		<tbody>
OUT;
        foreach ($this->vars['user'] as $user) {
            $this->user = $user;
            echo '
                <tr>
                    <td><input type="checkbox"></td>
                    <td><a href="/user/' . $this->user->getUse_id() . '">' . $this->user->getUse_lastname() . ' ' . $this->user->getUse_firstname() . '</a></td>
                    <td><a href="/user/' . $this->user->getUse_id() . '">' . $this->user->getUse_address() . '</a></td>
                    <td><a href="/user/' . $this->user->getUse_id() . '">' . $this->user->getUse_zip() . ' ' . $this->user->getUse_city() . '</a></td>
                    <td><a href="/user/' . $this->user->getUse_id() . '">' . $this->user->getUse_birth() . '</a></td>
                    <td><a href="/user/' . $this->user->getUse_id() . '">' . ($this->user->getUse_administrator() ? '<img alt="Ja" src="/images/icons/tick.png">' : '') . '</a></td>
                </tr>';
        }
        echo <<<OUT
                                    </tbody>
	    </table>
	    <select name="events-action">
		<option>[Aktion]</option>"
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
OUT;
    }

//put your code here
}

?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserCardInitView
 *
 * @author tscheurer
 */
class UserCardInitView extends View {

    /**
     *
     * @var User
     */
    private $user;

    public function display() {
        $this->user = $this->vars['user'];

        echo <<<OUT
    <div class="content-box">
    <h1>Eventkarten zuweisen</h1>
    <div class="event-card">
        <p><b>User:</b> {$this->user->getUse_firstname()} {$this->user->getUse_lastname()}</p>
    </div>
    <div class="event-card">
        <form class="filter" method="get">
        <p><b>Event:</b>
        <select name="event">
OUT;
        /* @var $ev \Event */
        foreach ($this->vars['eventlist'] as $ev) {
            echo '<option' . ($ev->getEvt_id() == $_GET['event'] ? ' SELECTED' : '') . ' value="' . $ev->getEvt_id() . '">' . $ev->getDate() . ' - ' . $ev->getEvt_name() . '</option>';
        }

        echo <<<OUT
        </select><b>Serie:</b>
        <select name="series">
OUT;
        /* @var $ser \Series */
        $i = count($this->vars['series']);
        foreach ($this->vars['series'] as $ser) {
            echo '<option' . ($ser->getSer_id() == $_GET['series'] ? ' SELECTED' : '') . ' value="' . $ser->getSer_id() . '">' . $i-- . '</option>';
        }

        echo <<<OUT
        </select></p>
        </form>
        
        <form method="post">
        <input type="submit" value="Speichern">
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="series" value="{$_GET['series']}">
        <input type="hidden" name="user" value="{$this->user->getUse_id()}">
        </div>
        <div class="list">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Karte</th>
                    <th>Spieler</th>
                </tr>
            </thead>
            <tbody>
OUT;
        /* @var $card \Eventmembercard */
        foreach ($this->vars['cards'] as $card) {
            echo "<tr>";
            echo '<td><input '.(($card->getUser() instanceof \User) ? 'disabled' : '').' name="card[]" value="'.$card->getCard()->getCar_id().'" type="checkbox" value=""></td>';
            echo "<td>{$card->getCard()->getCar_serialnumber()}</td>";
            if ($card->getUser() instanceof \User) {
                echo "<td>{$card->getUser()->getUse_firstname()} {$card->getUser()->getUse_lastname()}</td>";
            }
            else {
                echo "<td></td>";
            }
            echo "</tr>";
        }
        echo <<<OUT
            </tbody>
        </table>
        <input type="submit" value="Speichern">
        </form>
        </div>
            <select name="action">
                <option value="">[Aktion]</option> 
                <option value="delete">Löschen</option> 
            </select>
            <input type="submit" value="Ausführen"></input>
    </div>
OUT;
    }

}

?>

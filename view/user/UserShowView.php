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
class UserShowView extends View {

    /**
     *
     * @var User
     */
    private $user;
    private $notification = "";

    public function display() {
        if (isset($this->vars['user']) && $this->vars['user'] instanceof User) {
            $this->user = $this->vars['user'];
            $boxtitle = "Benutzer bearbeiten";
        } else {
            $this->user = new User();
            $boxtitle = "Neuer Benutzer anlegen";
        }

        if (isset($this->vars['notify'])) {
            $this->notification = '<div class="red">' . $this->vars['notify'] . '</div>';
        }

        $gebdat = $this->getBirthDateInput($this->user->getUse_birth());
        $isAdmin = ($this->user->getUse_administrator() ? 'checked' : '');
        $admin = $this->user->getUse_administrator() ? '<img alt="Ja" title="Ja" src="/images/icons/tick.png">' : '';
        $statusList = $this->getStatusList();

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
		<tr>
		<td>Ort:</td>
		<td>{$this->user->getUse_zip()} {$this->user->getUse_city()}</td>
		</tr>
                <tr>
		<td></td>
		<td></td>
		</tr>
		<tr>
                </tr>
                <tr>
		<td>Geburtsdatum:</td>
		<td>{$this->user->getUse_birth()}</td>
		</tr>
		<tr>
                </tr>
                <tr>
		<td></td>
		<td></td>
		</tr>
		<tr>
		<td>E-Mail:</td>
		<td>{$this->user->getUse_email()}</td>
		</tr>
		<tr>
		<td>Tel:</td>
		<td>{$this->formatPhone($this->user->getUse_phone())}</td>
		</tr>
                <tr>
		<td>Mobile:</td>
		<td>{$this->formatPhone($this->user->getUse_mobile())}</td>
		</tr>
                <tr>
		<td></td>
		<td></td>
		</tr>
		<tr>
		<td>Status:</td>
		<td>{$this->user->getUse_status()}</td>
		</tr>
	    </tbody>
	</table>
    </div>
                
    <div class="event-card">
	<table class="show-table">
	    <tbody>
		<tr>
		<td>Administrator:</td>
		<td>{$admin}</td>
		</tr>
		<td>Letzte anmeldung:</td>
		<td>{$this->user->getUse_lastlogin()}</td>
		</tr>
	    </tbody>
	</table>
    </div>
	    
    <div class="event-card">
	<table class="show-table">
	    <tbody>
		<tr>
		<td>Erstellt:</td>
		<td>{$this->user->getUse_cre_dat()}</td>
		</tr>
		<td>Zuletzt geändert:</td>
		<td>{$this->user->getUse_mod_dat()}</td>
		</tr>
	    </tbody>
	</table>
    </div>
</div>
<div class="content-box">
    <h1>Spielkarten</h1>
                <div class="button-box">
	<a href="/user/edit/{$this->user->getUse_id()}" class="button grey">Bearbeiten</a>
    </div>
    <div class="event-card">
	<table class="show-table">
	    <tbody>
		<tr>
                    <th>Datum</th>
                    <th>Event</th>
                    <th>Serie</th>
                    <th>Karte</th>
		</tr>
OUT;
        foreach (MysqlAdapter::getInstance()->getUserCards($this->user->getUse_id()) as $arr) {
            echo "<tr>
                <td>{$arr[0]}</td>
                <td>{$arr[1]}</td>
                <td>{$arr[2]}</td>
                <td>{$arr[3]}</td>
                </tr>";
        }
        echo <<<OUT
	    </tbody>
	</table>
    </div>
</div>
<div class="content-box">
    <h1>Gewinne</h1>
                <div class="button-box">
	<a href="/user/edit/{$this->user->getUse_id()}" class="button grey">Bearbeiten</a>
        <a href="/user/edit/{$this->user->getUse_id()}" class="button grey">Benachrichtigen</a>
    </div>
    <div class="event-card">
	<table class="show-table">
	    <tbody>
		<tr>
                    <th>Datum</th>
                    <th>Event</th>
                    <th>Gewinn</th>
		</tr>
OUT;
        foreach (MysqlAdapter::getInstance()->getUserWins($this->user->getUse_id()) as $arr) {
            echo "<tr>
                <td>{$arr[0]}</td>
                <td>{$arr[1]}</td>
                <td>{$arr[2]}</td>
                </tr>";
        }
        echo <<<OUT
	    </tbody>
	</table>
    </div>
</div>
OUT;
    }

    private function getBirthDateInput($bd) {
        $d = '';
        $m = '';
        $y = '';

        if (!empty($bd)) {
            $arr = explode(".", $bd);
            $d = $arr[0];
            $m = $arr[1];
            $y = $arr[2];
        }

        $out = "";
        $out .= '<select id="day" name="day"><option>Tag</option>';
        for ($i = 1; $i <= 31; $i++) {
            if ($i == $d) {
                $checked = 'selected';
            } else {
                $checked = '';
            }
            $out .= '<option ' . $checked . ' value="' . $i . '">' . str_pad($i, 2, '0', STR_PAD_LEFT) . '</option>';
        }
        $out .= '</select>';

        $out .= '<select id="month" name="month"><option>Monat</option>';
        for ($i = 1; $i <= 12; $i++) {
            if ($i == $m) {
                $checked = 'selected';
            } else {
                $checked = '';
            }
            $out .= '<option ' . $checked . ' value="' . $i . '">' . str_pad($i, 2, '0', STR_PAD_LEFT) . '</option>';
        }
        $out .= '</select>';

        $out .= '<select id="year" name="year"><option>Jahr</option>';
        for ($i = date("Y"); $i >= date("Y") - 100; $i--) {
            if ($i == $y) {
                $checked = 'selected';
            } else {
                $checked = '';
            }
            $out .= '<option ' . $checked . ' value="' . $i . '">' . $i . '</option>';
        }
        $out .= '</select>';

        return $out;
    }

    private function getStatusList() {
        $str = '';
        foreach (MysqlAdapter::getInstance()->getStatusList() as $val) {
            $str .= '<option value="' . $val . '" />';
        }
        return $str;
    }

}

?>

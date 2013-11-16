<?php
$days = array(1 => "Montag", 2 => "Dienstag", 3 => "Mittwoch", 4 => "Donnerstag", 5 => "Freitag", 6 => "Samstag", 7 => "Sonntag");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>LottoApp</title>
    </head>

    <body>
        <div id="bg">
            <div id="header">
                <div id="date"><?php echo date("d.m.Y H:m") . " Uhr"; ?></div>
                <div id="user">zaki@gmail.com | logout</div>
            </div>
            <div id="logo"><h1>Musikverein Lotto</h1></div>
            <div id="notifications">"Biergarten & Lotto" wird gerade gespielt. <a href="/">Hier klicken um in das Spiel zu gelangen.</a></div>
            <div id="breadcrumbs"><a href="/">Start</a> &gt; Veranstaltung</div>
            <div id="content">
                <h2>"Biergarten & Lotto" wird gerade gespielt...</h2>
                <div class="frame">
                    <div>
                        <h3>Serie 6</h3>
                        <form><input id="zahl_ziehung" type="text" name="zahl"> <input type="submit" value="Zahl speichern"> </form>

                        <table>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Gezogene Zahl</th>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Ziehung 7</td>
                                <td>16</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Ziehung 6</td>
                                <td>45</td>
                            </tr>
                        </table>

                        <form class="action">
                            <select name="cars">
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="fiat">Fiat</option>
                                <option value="audi">Audi</option>
                            </select>
                            <input type="submit" value="Ausführen">
                        </form>

                    </div>
                    <div>
                        <h3>Gespielte Serien</h3>
                        <table>
                            <tr>
                                <th></th>
                                <th>Gespielte Serien</th>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Serie 5</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Serie 4</td>
                            </tr>
                        </table>

                        <form class="action">
                            <select name="cars">
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="fiat">Fiat</option>
                                <option value="audi">Audi</option>
                            </select>
                            <input type="submit" value="Ausführen">
                        </form>
                    </div>
                    <div>
                        <h3>Spieler</h3>
                        <table>
                            <tr>
                                <th></th>
                                <th>Gewinner</th>
                            </tr>
                            <tr class="error">
                                <td><input type="checkbox"></td>
                                <td>Zakaria Agulif (Gewonnen!)</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Serie 4</td>
                            </tr>
                        </table>

                        <form class="action">
                            <select name="cars">
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="fiat">Fiat</option>
                                <option value="audi">Audi</option>
                            </select>
                            <input type="submit" value="Ausführen">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
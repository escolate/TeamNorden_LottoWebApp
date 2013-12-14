<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ErrorView
 *
 * @author tscheurer
 */
class ErrorView extends View {
    public function display() {
        echo <<<ERROR
            <div id="error_404">404:Not Found</div>
            <p id="error_404_msg">Es tut uns leid, das hätte nicht passieren sollen...</p>
        <img alt="404" src="/images/404.png">
ERROR;
    }    
}

?>

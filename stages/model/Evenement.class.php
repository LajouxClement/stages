<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Evenement
 *
 * @author Guillaume
 */
class Evenement {
    //put your code here
    private $noEvt;
    private $libEvt;
    
    function __construct($noEvt, $libEvt) {
        $this->noEvt = $noEvt;
        $this->libEvt = $libEvt;
    }
    
    function getNoEvt() {
        return $this->noEvt;
    }

    function getLibEvt() {
        return $this->libEvt;
    }

}

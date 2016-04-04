<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vignoble
 *
 * @author Sozza Marc <marc.sozza at gmail.com>
 */
class vignoble {
    //put your code here
    private $idVignoble;
    private $nomVignoble;
    private $region;
    
    function __construct($idVignoble, $nomVignoble, $region) {
        $this->idVignoble = $idVignoble;
        $this->nomVignoble = $nomVignoble;
        $this->region = $region;
    }

    function getIdVignoble() {
        return $this->idVignoble;
    }

    function getNomVignoble() {
        return $this->nomVignoble;
    }

    function getRegion() {
        return $this->region;
    }

    function setIdVignoble($idVignoble) {
        $this->idVignoble = $idVignoble;
    }

    function setNomVignoble($nomVignoble) {
        $this->nomVignoble = $nomVignoble;
    }

    function setRegion($region) {
        $this->region = $region;
    }


}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TypeDroit
 *
 * @author Sozza Marc <marc.sozza at gmail.com>
 */
class TypeDroit {
    //put your code here
    private $idDroit;
    private $labelDroit;
    
    function __construct($idDroit, $labelDroit) {
        $this->idDroit = $idDroit;
        $this->labelDroit = $labelDroit;
    }

    function getIdDroit() {
        return $this->idDroit;
    }

    function getLabelDroit() {
        return $this->labelDroit;
    }

    function setIdDroit($idDroit) {
        $this->idDroit = $idDroit;
    }

    function setLabelDroit($labelDroit) {
        $this->labelDroit = $labelDroit;
    }


}

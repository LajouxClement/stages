<?php

/**
 * Description of Stage
 *
 * @author Marc
 */
class Stage {

    //put your code here
    private $noStage;
    private $noEdutd; //FK etudiant
    private $noEnc; //FK encadrant
    private $soutenance; // ??? what is it ?
    private $tauxEncadrement; //? what is it ?

    function __construct($noStage, $noEdutd, $noEnc, $soutenance, $tauxEncadrement) {
        $this->noStage = $noStage;
        $this->noEdutd = $noEdutd;
        $this->noEnc = $noEnc;
        $this->soutenance = $soutenance;
        $this->tauxEncadrement = $tauxEncadrement;
    }

    function getNoStage() {
        return $this->noStage;
    }

    function getNoEdutd() {
        return $this->noEdutd;
    }

    function getNoEnc() {
        return $this->noEnc;
    }

    function getSoutenance() {
        return $this->soutenance;
    }

    function getTauxEncadrement() {
        return $this->tauxEncadrement;
    }

}

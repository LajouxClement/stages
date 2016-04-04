<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Encadrant
 *
 * @author Clément
 */
class Encadrant {

    //put your code here
    private $noEnc;
    private $nomEnc;
    private $prenomEnc;
    private $emailEnc;
    private $expCom;
    private $inactif;
    private $encadrement;
    
    function __construct($noEnc, $nomEnc, $prenomEnc, $emailEnc, $expCom, $inactif, $encadrement) {
        $this->noEnc = $noEnc;
        $this->nomEnc = $nomEnc;
        $this->prenomEnc = $prenomEnc;
        $this->emailEnc = $emailEnc;
        $this->expCom = $expCom;
        $this->inactif = $inactif;
        $this->encadrement = $encadrement;
    }

    function getNoEnc() {
        return $this->noEnc;
    }

    function getNomEnc() {
        return $this->nomEnc;
    }

    function getPrenomEnc() {
        return $this->prenomEnc;
    }

    function getEmailEnc() {
        return $this->emailEnc;
    }

    function getExpCom() {
        return $this->expCom;
    }

    function getInactif() {
        return $this->inactif;
    }

    function getEncadrement() {
        return $this->encadrement;
    }

}
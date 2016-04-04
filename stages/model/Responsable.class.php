<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Responsable
 *
 * @author Marc
 */
class Responsable {

    private $noResp;
    private $nomResp;
    private $prenomResp;
    private $civiliteResp;
    private $loginResp;
    private $passResp;

    public function __construct($noResp, $nomResp, $prenomResp, $civiliteResp, $loginResp, $passResp)
    {
        $this->noResp = $noResp;
        $this->nomResp = $nomResp;
        $this->prenomResp = $prenomResp;
        $this->civiliteResp = $civiliteResp;
        $this->loginResp = $loginResp;
        $this->passResp = $passResp;
    }

    public function getNoResp()
    {
        return $this->noResp;
    }

    public function getNomResp()
    {
        return $this->nomResp;
    }

    public function getPrenomResp()
    {
        return $this->prenomResp;
    }

    public function getCiviliteResp()
    {
        return $this->civiliteResp;
    }

    public function getLoginResp()
    {
        return $this->loginResp;
    }

    public function getPassResp()
    {
        return $this->passResp;
    }

}

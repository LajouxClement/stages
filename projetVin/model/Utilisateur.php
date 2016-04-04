<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utilisateur
 *
 * @author Sozza Marc <marc.sozza at gmail.com>
 */
class Utilisateur {
    //put your code here
    private $idUser;
    private $idDroit;
    private $nomUser;
    private $prenomUser;
    private $mailUser;
    private $mdpUser;
    private $photoUser;
    
    function __construct($idUser, $idDroit, $nomUser, $prenomUser, $mailUser, $mdpUser, $photoUser) {
        $this->idUser = $idUser;
        $this->idDroit = $idDroit;
        $this->nomUser = $nomUser;
        $this->prenomUser = $prenomUser;
        $this->mailUser = $mailUser;
        $this->mdpUser = $mdpUser;
        $this->photoUser = $photoUser;
    }
    
    function getIdUser() {
        return $this->idUser;
    }

    function getIdDroit() {
        return $this->idDroit;
    }

    function getNomUser() {
        return $this->nomUser;
    }

    function getPrenomUser() {
        return $this->prenomUser;
    }

    function getMailUser() {
        return $this->mailUser;
    }

    function getMdpUser() {
        return $this->mdpUser;
    }

    function getPhotoUser() {
        return $this->photoUser;
    }

    function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    function setIdDroit($idDroit) {
        $this->idDroit = $idDroit;
    }

    function setNomUser($nomUser) {
        $this->nomUser = $nomUser;
    }

    function setPrenomUser($prenomUser) {
        $this->prenomUser = $prenomUser;
    }

    function setMailUser($mailUser) {
        $this->mailUser = $mailUser;
    }

    function setMdpUser($mdpUser) {
        $this->mdpUser = $mdpUser;
    }

    function setPhotoUser($photoUser) {
        $this->photoUser = $photoUser;
    }



}

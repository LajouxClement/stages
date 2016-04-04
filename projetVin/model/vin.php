<?php

/* 
 * To change this license header, choose License Headers in Project Properties."&".
 * To change this template file, choose Tools | Templates
 * and open the template in the editor."&".
 */


/**
 * Description of vin
 *
 * @author Sozza Marc <marc."&".sozza at gmail."&".com>
 */
class vin {
    //put your code here
    private $idVin;
    private $idUser;
    private $idVignoble;
    private $nomVin;
    private $nomCepage;
    private $noteTesteur;
    private $couleur;
    private $urlImage;
    private $anneeImage;
    private $latitude;
    private $longitude;
    
    function __construct($idVin, $idUser, $idVignoble, $nomVin, $nomCepage, $noteTesteur, $couleur, $urlImage, $anneeImage, $latitude, $longitude) {
        $this->idVin = $idVin;
        $this->idUser = $idUser;
        $this->idVignoble = $idVignoble;
        $this->nomVin = $nomVin;
        $this->nomCepage = $nomCepage;
        $this->noteTesteur = $noteTesteur;
        $this->couleur = $couleur;
        $this->urlImage = $urlImage;
        $this->anneeImage = $anneeImage;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function __toString()
    {
        return $this->idVin."&".
        $this->idUser ."&".
        $this->idVignoble ."&".
        $this->nomVin ."&".
        $this->nomCepage."&".
        $this->noteTesteur ."&".
        $this->couleur ."&".
        $this->urlImage ."&".
        $this->anneeImage ."&".
        $this->latitude ."&".
        $this->longitude ;
    }

    /*function __construct($vin) {

        $this->idVin = $vin->getIdVin();
        $this->idUser = $vin->getIdUser();
        $this->idVignoble = $vin->getIdVignoble();
        $this->nomVin = $vin->getNomVin();
        $this->nomCepage = $vin->getNomCepage();
        $this->noteTesteur = $vin->getNoteTesteur();
        $this->couleur = $vin->getCouleur();
        $this->urlImage = $vin->getUrlImage();
        $this->anneeImage = $vin->getAnneeImage();
        $this->latitude = $vin->getLatitude();
        $this->longitude = $vin->getLongitude();
    }*/
    
    function getIdVin() {
        return $this->idVin;
    }

    function getIdUser() {
        return $this->idUser;
    }

    function getIdVignoble() {
        return $this->idVignoble;
    }

    function getNomVin() {
        return $this->nomVin;
    }

    function getNomCepage() {
        return $this->nomCepage;
    }

    function getNoteTesteur() {
        return $this->noteTesteur;
    }

    function getCouleur() {
        return $this->couleur;
    }

    function getUrlImage() {
        return $this->urlImage;
    }

    function getAnneeImage() {
        return $this->anneeImage;
    }

    function getLatitude() {
        return $this->latitude;
    }

    function getLongitude() {
        return $this->longitude;
    }

    function setIdVin($idVin) {
        $this->idVin = $idVin;
    }

    function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    function setIdVignoble($idVignoble) {
        $this->idVignoble = $idVignoble;
    }

    function setNomVin($nomVin) {
        $this->nomVin = $nomVin;
    }

    function setNomCepage($nomCepage) {
        $this->nomCepage = $nomCepage;
    }

    function setNoteTesteur($noteTesteur) {
        $this->noteTesteur = $noteTesteur;
    }

    function setCouleur($couleur) {
        $this->couleur = $couleur;
    }

    function setUrlImage($urlImage) {
        $this->urlImage = $urlImage;
    }

    function setAnneeImage($anneeImage) {
        $this->anneeImage = $anneeImage;
    }

    function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    function setLongitude($longitude) {
        $this->longitude = $longitude;
    }



}

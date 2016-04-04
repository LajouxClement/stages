<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$_SESSION["droit"] = $_POST["droit"];
$_SESSION["identifiant"] = $_POST["identifiant"];
$_SESSION["idUser"] = $_POST["idUser"];

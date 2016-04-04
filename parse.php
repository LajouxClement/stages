<?php
header("Access-Control-Allow-Origin: *");
session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once(__DIR__ . '/dao/connection/AbstractDAORead.php');
include_once(__DIR__ . '/dao/connection/AbstractDAOReadWrite.php');
include_once(__DIR__ . '/dao/connection/Connection.php');
include_once(__DIR__ . '/include/configBDD.php');
include_once(__DIR__ . '/include/autoload.php');

    if (!empty($_GET['page']) && file_exists('api/' . $_GET['page'] . '.php')) {

        include_once(__DIR__ . '/api/' . $_GET['page'] . '.php');
    } else {
        echo '<meta http-equiv="refresh" content="0.0001;url=accueil">';
    }



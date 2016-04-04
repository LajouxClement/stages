<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function __autoload($class_name){
    try {
        if (file_exists(__DIR__ . '/../model/' . $class_name . '.php')) {
            include(__DIR__ . '/../model/' . $class_name . '.php');
        }
        if (file_exists(__DIR__ . '/../dao/objects/' . $class_name . '.php')) {
            include(__DIR__ . '/../dao/objects/' . $class_name . '.php');
        }
    } catch (Exception $ex) {
        echo "Erreur lors du chargement de la page " . $ex->getMessage();
    }
    
}
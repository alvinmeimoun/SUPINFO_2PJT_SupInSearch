<?php

//Chargement automatique des classes PHP
function __autoload($className) {
    if (file_exists(__DIR__ . '/classes/entities/' . $className . '.class.php')) {
        require_once __DIR__ . '/classes/entities/' . $className . '.class.php';
        return true;
    } else if (file_exists(__DIR__ . '/classes/manager/' . $className . '.class.php')) {
        require_once __DIR__ . '/classes/manager/' . $className . '.class.php';
        return true;
    } else {
        return false;
    }
}

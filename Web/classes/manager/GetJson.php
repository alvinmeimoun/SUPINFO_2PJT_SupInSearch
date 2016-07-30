<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Antonin
 * Date: 21/04/14
 * Time: 15:45
 * To change this template use File | Settings | File Templates.
 */

// FICHIER TEST  ( inutile pour le projet c'est juste un rappel des methodes utilisées)

$json = file_get_contents("json/essai.json");

$parsed_json = json_decode($json);
var_dump(json_decode($json));

/*$date = $parsed_json-
$terms = $parsed_json->{'response'}->{'termsofService'};*/
?>
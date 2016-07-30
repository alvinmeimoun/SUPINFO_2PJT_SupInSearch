<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Antonin
 * Date: 24/04/14
 * Time: 18:17
 * To change this template use File | Settings | File Templates.
 */



class GetJsonManager implements JsonManager{

	public function __construct() // or any other method
    {
        
    }

    // Methode qui permet de récupérer tous les résultats et les mettre dans un Array
    public function findAllWebsite($server_url, $keyword)
    {

        //$json =  file_get_contents("json/essai.json"); // json de test

        // On récupère le JSON via l'url de recherche

		$call_url = $server_url."/api/website/search?req=".$keyword;

	    $json = file_get_contents($call_url);

        // On parse le JSON pour pouvoir le mettre dans un array d'objets Website
        $parsed_json = json_decode($json);

        $list = $parsed_json->results;

        $nb = count($parsed_json->results);

        $result = array();

        // On créé notre array d'objets Website en récupérant leurs attributs dans le JSON
        $i = 1;
        if ($nb > 0)
        {
            foreach ($list as $site)

            {
                // On instancie notre objet
                $newWebsite = new Website($site->{"title"},$site->{"description"},$site->{"url"});
                // On l'insère dans l'array d'objets.
                array_push($result,$newWebsite);

            }
        }
        // On retourne notre array d'objets.
        return $result;
    }

    // Méthode qui permet de compter le nombre de resultats pour élaborer l'affichage.
    public function CountNumberResults($server_url, $keyword)
    {	
        // On récupère le JSON
        //$json = file_get_contents("json/essai.json"); // Json de test

		$call_url = $server_url."/api/website/search?req=".$keyword;

		$json = file_get_contents($call_url);

        $parsed_json = json_decode($json);

        $nbresults = count($parsed_json->results);
        // On retourne le nombre de résultats
        return $nbresults;
    }



}

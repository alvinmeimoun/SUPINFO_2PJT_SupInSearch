<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Antonin
 * Date: 24/04/14
 * Time: 18:18
 * To change this template use File | Settings | File Templates.
 */

interface JsonManager {


    public function findAllWebsite($server_url, $keyword);

    //public function findWebsiteByTitle($title);

    public function CountNumberResults($server_url, $keyword);



}

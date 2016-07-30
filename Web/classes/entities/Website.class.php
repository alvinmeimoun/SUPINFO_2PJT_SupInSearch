<?php

/**
 * Created by JetBrains PhpStorm.
 * User: Antonin
 * Date: 24/04/14
 * Time: 11:46
 * To change this template use File | Settings | File Templates.
 */

 class Website {

     public $_title;
     public $_description;
     public $_link;

     public function __construct($_title, $_description, $_link)
     {
         $this->_title = $_title;
         $this->_description = $_description;
         $this->_link = $_link;
     }


     public function setDescription($description)
     {
         $this->_description = $description;
     }

     public function getDescription()
     {
         return $this->_description;
     }

     public function setLink($link)
     {
         $this->_link = $link;
     }

     public function getLink()
     {
         return $this->_link;
     }

     public function setTitle($title)
     {
         $this->_title = $title;
     }

     public function getTitle()
     {
         return $this->_title;
     }




}
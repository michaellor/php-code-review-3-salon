<?php

    class Stylist
    {
        private $stylist_name;
        private $id;

        function __construct($stylist_name, $id)
        {
            $this->stylist_name = $stylist_name;
            $this->id = $id;
        }

        function setName($stylist_name)
        {
            $this->stylist_name = $stylist_name;
        }

        function getName()
        {
            return $this->stylist_name;
        }

      }
?>

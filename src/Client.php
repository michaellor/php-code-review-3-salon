<?php
class Client
{
    private $client_name;
    private $stylist_id;
    private $id;


    function __construct($client_name, $stylist_id, $id = NULL)
    {
        $this->client_name = $client_name;
        $this->stylist_id = $stylist_id;
        $this->id = $id;
    }

    function setName($client_name)
    {
        $this->client_name = $client_name;
    }

    function getName()
    {
        return $this->client_name;
    }

    function getStylistId()
    {
        return $this->stylist_id;
    }

    function getId()
    {
        return $this->id;
    }


  }
?>

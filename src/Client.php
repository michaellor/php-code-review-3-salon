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

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO clients (client_name, stylist_id) VALUES ('{$this->getName()}', {$this->getStylistId()});");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");

        $clients = array();
        foreach($returned_clients as $client)
        {
            $client_name = $client['client_name'];
            $stylist_id = $client['stylist_id'];
            $id = $client['id'];
            $new_client = new Client($client_name, $stylist_id, $id);
            array_push($clients, $new_client);
        }
        return $clients;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM clients;");
    }
  }
?>

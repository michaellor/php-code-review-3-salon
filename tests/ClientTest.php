<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class ClientTest extends PHPUnit_Framework_TestCase
    {

        // protected function tearDown()
        // {
        //     Client::deleteAll();
        // }

        function test_getName()
        {
            //Arrange
            $name = "John";
            $stylist_id = 1;
            $id = 1;
            $new_client = new Client($name, $stylist_id, $id);

            //Act
            $result = $new_client->getName($name, $stylist_id, $id);

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Assert
            $name = "John";
            $stylist_id = 1;
            $id = 1;
            $new_client = new Client($name, $stylist_id, $id);

            //Act
            $result = $new_client->getId($name, $stylist_id, $id);

            //Assert
            $this->assertEquals(1, $result);
        }

    }

?>

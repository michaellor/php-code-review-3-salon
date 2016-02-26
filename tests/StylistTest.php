<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class StylistTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Victoria";
            $id = NULL;
            $new_stylist = new Stylist($name, $id);

            //Act
            $result = $new_stylist->getName($name);

            //Assert
            $this->assertEquals("Victoria", $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Victoria";
            $id = 1;
            $new_stylist = new Stylist($name, $id);

            //Act
            $result = $new_stylist->getId($id);

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Victoria";
            $new_stylist = new Stylist($name);

            //Act
            $new_stylist->save();

            //Assert
            $result = Stylist::getAll();
            $this->assertEquals($new_stylist, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Victoria";
            $id = 1;
            $new_stylist = new Stylist($name, $id);
            $new_stylist->save();
            $name2 = "Lise";
            $id = 2;
            $new_stylist2 = new Stylist($name2, $id);
            $new_stylist2->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$new_stylist, $new_stylist2], $result);
        }

        function test_getClient()
        {
            //Arrange
            $name = "Victoria";
            $id = 1;
            $new_stylist = new Stylist($name, $id);
            $new_stylist->save();

            $client_name = "Willy";
            $stylist_id = $new_stylist->getId();
            $id = 1;
            $new_client = new Client($client_name, $stylist_id, $id);
            $new_client->save();

            //Act
            $result = $new_stylist->getClient($new_client);

            //Assert
            $this->assertEquals([$new_client], $result);
        }



    }

?>

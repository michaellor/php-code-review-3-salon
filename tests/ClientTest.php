<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class ClientTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Client::deleteAll();
            Stylist::deleteAll();
        }

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

        function test_save()
        {
            //Assert
            $stylist_name = "Victoria";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $name = "John";
            $stylist_id = $test_stylist->getId();
            $new_client = new Client($name, $stylist_id, $id);

            //Act
            $new_client->save();

            //Assert
            $result = Client::getAll();
            $this->assertEquals($new_client, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "John";
            $name2 = "Jill";
            $stylist_id = 1;
            $id = 1;
            $new_client = new Client($name, $stylist_id, $id);
            $new_client->save();
            $new_client2 = new Client($name2, $stylist_id, $id);
            $new_client2->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$new_client,$new_client2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "John";
            $stylist_id = 1;
            $id = 1;
            $new_client = new Client($name, $stylist_id, $id);
            $new_client->save();

            //Act
            Client::deleteAll();
            $result = Client::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $stylist_name = "Victoria";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $name = "John";
            $stylist_id = $test_stylist->getId();
            $new_client = new Client($name, $stylist_id, $id);
            $new_client->save();

            $name2 = "Sylvie";
            $new_client2 = new Client($name2, $stylist_id, $id);
            $new_client2->save();

            //Act
            $result = Client::find($new_client->getId());

            //Assert
            $this->assertEquals($new_client, $result);
        }

        function test_delete()
        {
            //Arrange
            $stylist_name = "Victoria";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $name = "John";
            $stylist_id = $test_stylist->getId();
            $id = 1;
            $new_client = new Client($name, $stylist_id, $id);
            $new_client->save();

            $name2 = "Sylvie";
            $id = 2;
            $new_client2 = new Client($name2, $stylist_id, $id);
            $new_client2->save();

            //Act
            $new_client2->delete();
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$new_client], $result);
        }
    }

?>

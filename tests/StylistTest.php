<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class StylistTest extends PHPUnit_Framework_TestCase
    {

        // protected function tearDown()
        // {
        //     Stylist:deleteAll();
        // }

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

        function test_getAll()
        {
            //Arrange
            $name = "Victoria";
            $id = 1;
            $new_stylist = new Stylist($name, $id);

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$new_stylist], $result);
        }

        // function save()
        // {
        //     //Arrange
        //     $name = "Victoria";
        //     $id = 1;
        //     $new_stylist = new Stylist($name, $id);
        //
        //     //Act
        //     $new_stylist->save();
        //
        //     //Assert
        //     $result = Stylist::getAll();
        // }


    }

?>

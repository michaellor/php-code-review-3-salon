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


    }

?>

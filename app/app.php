<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function () use ($app){
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/stylist/{id}", function () use ($app){
        return $app['twig']->render('stylist.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/stylist/{id}/edit", function () use ($app){
        return $app['twig']->render('stylist_edit.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/stylist", function () use ($app){
        $new_stylist = new Stylist($_POST['stylist_name']);
        $new_stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->delete("/{id}", function($id) use ($app){
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    return $app;


?>

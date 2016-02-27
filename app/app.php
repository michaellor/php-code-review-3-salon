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

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    //Landing page
    $app->get("/", function () use ($app){
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    //Page listing stylists
    $app->get("/stylists", function () use ($app){
        return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/stylists", function () use ($app){
        $new_stylist = new Stylist($_POST['stylist_name']);
        $new_stylist->save();
        return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/stylists/{id}", function ($id) use ($app) {
        $stylist = Stylist::find($id);
        $current_client = $stylist->getClient();
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $current_client));
    });

    $app->patch("/stylists/{id}/edit_client/{cliend_id}", function ($id, $client_id) use ($app) {
        $stylist = Stylist::find($id);
        $client_name = $_POST['client_name'];
        $client = Client::find($client_id);
        $client->update($client_name);
        $current_client = $stylist->getClient();
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $current_client));
    });

    // 
    // $app->get("/stylist/{id}/edit/{client_id}", function ($id, $client_id) use ($app) {
    //         $stylist = Stylist::find($id);
    //         $client = Client::find($client_id);
    //         return $app['twig']->render('client_edit.html.twig', array('stylist' => $stylist, 'client' => $client
    //         ));
    //     });
    //
    // $app->post("/stylists/{id}", function ($id) use ($app) {
    //     $stylist = Stylist::find($id);
    //     $new_client = new Client($_POST['client_name'], $id);
    //     $new_client->save();
    //     return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist,  'clients' => $stylist->getClient()));
    // });

    $app->delete("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        $current_clients = $stylist->getClient();
        return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll(), 'clients' => $current_clients));
    });

    $app->delete("/stylists/{id}/delete/{client_id}", function($id, $client_id) use ($app) {
        $stylist = Stylist::find($id);
        $client = Client::find($client_id);
        $client->delete();
        $current_clients = $stylist->getClient();
        return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' => $current_clients));
    });

    return $app;


?>

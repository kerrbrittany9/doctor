<?php
  date_default_timezone_set('America/Los_Angeles');
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Patient.php";
  require_once __DIR__."/../src/Doctor.php";

  $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=doctor';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' =>__DIR__.'/../views'
    ));
    //
    // use Symfony\Component\HttpFoundation\Request;
    // Request::enableHttpMethodParameterOverride();


    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('doctors' => Doctor::getAll()));
    });

    $app->get("/doctors", function() use ($app) {
      return $app['twig']->render('doctors.html.twig', array('doctors' => Doctor::getAll()));
    });

    $app->get("/patients", function() use ($app) {
      return $app['twig']->render('patients.html.twig', array('patients' => Patient::getAll()));
  });

    return $app;
?>

<?php
    date_default_timezone_set("America/Los_Angeles");

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/hangman.php";

    session_start();
    if (empty($_SESSION['game'])) {
        $_SESSION['game'] = "";
    }

    $app = new Silex\Application();

    $app["debug"] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), ['twig.path' => __DIR__.'/../views']);

    $app->get("/", function() use ($app) {
        $new_game = new Game("butts");
        $new_game->save();
        return $app["twig"]->render("new_game.html.twig");
    });

    $app->get("/guess", function() use ($app) {
        return $app["twig"]->render("home.html.twig");
    });

    $app->post("/hangman", function() use ($app) {
        $user_guess = strtolower($_POST['guess']);
        $game = Game::getGame();
        $result = $game->check($user_guess);
        $game->save();
        if ($result) {
            $result = $game->spaceify();
        } else {
            $result = "Wrong.";
        }
        return $app["twig"]->render("hangman.html.twig", ["result" => $result]);
    });



    return $app;
?>

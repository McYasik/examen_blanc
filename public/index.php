<?php

session_start();

use App\Http\Controllers\Controller;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LivreController;

require dirname(__DIR__) . "/vendor/autoload.php";

define("VIEW", dirname(__DIR__) . "/ressources/views/");
define("URL", str_replace('public/index.php', '', (isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

$indexController = new IndexController();
$livreController = new LivreController();
$controller = new Controller();

if(isset($_GET['page']))
    {

        if (empty($_GET['page']))
        {
                $indexController->index();
        }
        else
        {
            $url = htmlspecialchars(filter_var($_GET['page'], FILTER_SANITIZE_URL));
            $url_explode = explode("/", $url);

            if (isset($url_explode[0]) && ($url_explode[0] === "ma_liste"))
            {
                if (!isset($url_explode[1]))
                {
                    $livreController->index(); 
                }
                else if (isset($url_explode[1]) &&($url_explode[1] === "edit"))
                {
                    $livreController->edit($url_explode[2]);
                }
                else if (isset($url_explode[1]) &&($url_explode[1] === "update"))
                {
                    $livreController->update($url_explode[2]);
                }
                else if(isset($url_explode[1]) && ($url_explode[1] === "delete"))
                {
                    $livreController->delete($url_explode[2]);
                }
                else
                {
                    $controller->PageError();
                }
            }
            else if(isset($url_explode[0]) && ($url_explode[0] === "add"))
            {
                $livreController->create();
            }
            else if(isset($url_explode[0]) && ($url_explode[0] === "store"))
            {
                $livreController->store();
            }
            else
            {
                $controller->PageError();
            }

        }
    }